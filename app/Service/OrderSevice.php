<?php

namespace App\Service;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderSevice
{

    public function createOrder ($request)
    {

        $order = Order::create([
            'ref_id' => 'ORD-' . Str::random(15),
            'customer_id' => Auth::guard('customer')->user()->id,
            'customer_address_id' => $request['customer_address_id'],
            'shipping_company_id' => $request['shipping_company_id'],
            'paymeny_method_id' => $request['payment_method_id'],
            'subtotal' => getNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount' => getNumbers()->get('discount'),
            'shipping' => getNumbers()->get('shipping'),
            'tax' => getNumbers()->get('productTaxes'),
            'total' => getNumbers()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);

        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }

        $order->transactions()->create([
            'transaction' => OrderTransaction::NEW_ORDER
        ]);

        return $order;

    }

}
