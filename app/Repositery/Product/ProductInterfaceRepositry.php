<?php

namespace App\Repositery\Product;


interface ProductInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($product);

    public function update($request, $product);

    public function destroy($request);

}
