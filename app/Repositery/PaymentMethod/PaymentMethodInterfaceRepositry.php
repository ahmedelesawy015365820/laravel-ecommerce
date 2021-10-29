<?php

namespace App\Repositery\PaymentMethod;


interface PaymentMethodInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($payment_method);

    public function update($request, $payment_method);

    public function destroy($payment_method);

}
