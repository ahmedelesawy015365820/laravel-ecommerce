<?php

namespace App\Repositery\Customer;


interface CustomerInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($customer);

    public function update($request, $customer);

    public function destroy($request);

}
