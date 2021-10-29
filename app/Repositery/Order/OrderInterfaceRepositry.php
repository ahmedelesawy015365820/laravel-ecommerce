<?php

namespace App\Repositery\Order;


interface OrderInterfaceRepositry {

    public function index($request);

    public function show($order);

    public function update($request, $order);

    public function destroy($order);

}
