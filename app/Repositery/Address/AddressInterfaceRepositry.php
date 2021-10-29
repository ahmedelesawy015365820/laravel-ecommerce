<?php

namespace App\Repositery\Address;


interface AddressInterfaceRepositry {

    public function index($request);

    // public function create();

    // public function store($request);

    public function edit($customerAddress);

    public function update($request, $customerAddress);

    public function destroy($customerAddress);

}
