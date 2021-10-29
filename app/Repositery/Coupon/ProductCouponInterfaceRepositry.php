<?php

namespace App\Repositery\Coupon;


interface ProductCouponInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($product_coupon);

    public function update($request, $product_coupon);

    public function destroy($request);

}
