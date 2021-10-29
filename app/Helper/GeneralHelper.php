<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function getNumbers()
{

    $subtotal = Cart::instance('default')->subtotal();
    $discount = session()->has('coupon') ? round(session()->get('coupon')['discount']) : 0.00;
    $discount_code = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $subtotal_after_discount = $subtotal - $discount;

    $tax = config('cart.tax') / 100;
    $taxText = config('cart.tax') . '%';

    $productTaxes = round($subtotal_after_discount * $tax, 2);
    $newSubTotal = $subtotal_after_discount + $productTaxes;

    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shipping_code = session()->has('shipping') ? session()->get('shipping')['code'] : null;

    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;

    return collect([
        'subtotal' => $subtotal,
        'tax' => $productTaxes,
        'taxText' => $taxText,
        'productTaxes' => $productTaxes,
        'newSubTotal' => $newSubTotal,
        'discount' => $discount,
        'discount_code' => $discount_code,
        'shipping' => $shipping,
        'shipping_code' => $shipping_code,
        'total' => $total,
    ]);
}
