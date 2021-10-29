<?php

namespace App\Repositery\ProductCategory;


interface ProductCategoryInterfaceRepositry {

    public function index($request);

    public function create();

    public function store($request);

    public function edit($ProductCategory);

    public function update($request, $product_category);

    public function destroy($request);

}
