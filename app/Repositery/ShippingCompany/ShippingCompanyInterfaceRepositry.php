<?php

namespace App\Repositery\ShippingCompany;


interface ShippingCompanyInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($shippingcompany);

    public function update($request, $shippingcompany);

    public function destroy($shippingcompany);

}
