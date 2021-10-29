<?php

namespace App\Repositery\Category;

interface CategoryInterfaceRepositry {

    public function index($request);

    public function store($request);

    public function update($request, $category);

    public function destroy($request);

}
