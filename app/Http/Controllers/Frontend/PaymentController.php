<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\ProductCopon;
use App\Models\User;
use App\Notifications\Frontend\Customer\OrderCreateNotifiction;
use App\Service\MyFatooraService;
use App\Service\OrderSevice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Notifications\Frontend\Customer\OrderThanksNotifiction;


class PaymentController extends Controller
{

    private $myFatoora;

    public function __construct(MyFatooraService $myFatoora)
    {

        $this->myFatoora = $myFatoora;

    }

    public function checkout_now(Request $request)
    {
        $order = (new OrderSevice)->createOrder($request->except('_token','submit'));

        $data = [
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => $order->total,
            'CustomerName'       => auth()->guard('customer')->user()->full_name,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => auth()->guard('customer')->user()->email,
            'CallBackUrl'        => $this->myFatoora->getReturnUrl($order->id),
            'ErrorUrl'           => $this->myFatoora->getCancelUrl($order->id)
        ];

        $response = $this->myFatoora->sendPayment($data);

        if ($response['IsSuccess']) {
            return  redirect($response['Data']['InvoiceURL']);
        }

        toast("Please come back later", 'error');
        return redirect()->route('frontend.index');
    }

    public function cancel($order_id)
    {

        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);
        });

        toast('You have cancelled your order payment', 'error');
        return redirect()->route('frontend.index');

    }

    public function completed($order_id)
    {

        $order = Order::find($order_id);

        $data = [
            'Key'     => request()->paymentId,
            'KeyType' => 'paymentId'
        ];

        $response = $this->myFatoora->successPayment($data);

        if ($response['IsSuccess']) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);

            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $response['Data']['InvoiceId'],
                'payment_result' => 'success'
            ]);

            if (session()->has('coupon')) {
                $coupon = ProductCopon::whereCode(session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }

            Cart::instance('default')->destroy();

            session()->forget([
                'coupon',
                'shipping',
                'customer_address'
            ]);

            User::all()->each(function ($admin) use($order){

                $admin->notify( new OrderCreateNotifiction($order));

            });


            $data = $order->toArray();
            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;

            $pdf = PDF::loadView('layouts.invoice', $data);

            $file = base_path('storage/app/files/' .$data['ref_id'] .'.pdf');

            $saveFile = $pdf->save($file);

            $customer = Customer::find($order->customer->id);

            $customer->notify( new OrderThanksNotifiction($order,$file));



            toast('Your recent payment is successful with reference code: ' . $response['Data']['InvoiceTransactions'][0]['TransactionId'], 'success');
            return redirect()->route('frontend.index');
        }

        toast('You have cancelled your order payment!', 'error');
        return redirect()->route('frontend.index');

    }

    public function webhook($order_id = null, $env = null)
    {

    }
}


