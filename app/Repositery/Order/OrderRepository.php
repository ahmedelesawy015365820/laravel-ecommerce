<?php

namespace App\Repositery\Order;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Notifications\Backend\order\OrderNotifiction;
use App\Service\MyFatooraService;

class OrderRepository implements OrderInterfaceRepositry{

    private $MyFatoora;

    public function __construct(MyFatooraService $MyFatoora)
    {
        $this->MyFatoora = $MyFatoora;
    }

    public function index($request){

        $Orders = Order::query()->when($request->search,function ($q) use ($request){

            return $q->where('code','like',"%". $request->search ."%");

        })->when($request->status,function ($q) use ($request){

            return $q->where('order_status','like',"%". $request->status ."%");

        })->orderBy('id','ASC')->paginate(10);

        $status_arrays = [
            '0' => 'New order',
            '1' => 'Paid',
            '2' => 'Under process',
            '3' => 'Finished',
            '4' => 'Rejected',
            '5' => 'Canceled',
            '6' => 'Refund requested',
            '7' => 'Returned order',
            '8' => 'Refunded',
        ];

        return view('dashboard.order.index',compact('Orders','status_arrays'));

    }//************end index */


    public function show($order){

        $order_status_array = [
            '0' => 'New order',
            '1' => 'Paid',
            '2' => 'Under process',
            '3' => 'Finished',
            '4' => 'Rejected',
            '5' => 'Canceled',
            '6' => 'Refund requested',
            '7' => 'Returned order',
            '8' => 'Refunded',
        ];

        $key = array_search($order->order_status, array_keys($order_status_array));
        $new_status= [];
        foreach ($order_status_array as $k => $v) {
            if($key < $k){
                $new_status[$k] = $v;
            }
        }

        return view('dashboard.order.show', compact('order', 'new_status'));

    }//************end edit */

    public function update($request, $order){

        $customer = Customer::find($order->customer_id);

        if ($request->order_status == Order::REFUNDED){

            $data = [
                "KeyType"=> "invoiceid",
                "Key" => $order->transactions->where('transaction', Order::PAYMENT_COMPLETED)->first()->transaction_number,
                "RefundChargeOnCustomer" => false,
                "ServiceChargeOnCustomer"=> false,
                "Amount"=> $order->total,
                "Comment"=> "Test Api",
                "AmountDeductedFromSupplier"=> 0
            ];

            $refund = $this->MyFatoora->RefundPayment($data);

            if ($refund['IsSuccess']) {
                $order->update(['order_status' => Order::REFUNDED]);
                $order->transactions()->create([
                    'transaction' => OrderTransaction::REFUNDED,
                    'transaction_number' => $refund['Data']['RefundId'],
                    'payment_result' => 'success'
                ]);

                $customer->notify(new OrderNotifiction($order));

                return back()->with(['success' => 'Refunded updated successfully' ]);

            }

        } else {

            $order->update(['order_status'=> $request->order_status]);

            $order->transactions()->create([
                'transaction' => $request->order_status,
                'transaction_number'=> null,
                'payment_result'=> null,
            ]);

            $customer->notify(new OrderNotifiction($order));

            return redirect()->back()->with('success',"Successfully Updated");

        }

    }//************end update */

    public function destroy($order){

        $Address = Order::findOrFail($order->id);

        $Address->delete();

        return redirect()->route('admin.order.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
