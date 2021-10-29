<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Repositery\ProductCategory\ProductCategoryInterfaceRepositry;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class ProductCategoryController extends Controller
{

    protected $ProductCategory;


    function __construct(ProductCategoryInterfaceRepositry $ProductCategory){

        $this->ProductCategory = $ProductCategory;

        $this->middleware('permission:product-categories-list', ['only' => ['index']]);
        $this->middleware('permission:product-categories-show', ['only' => ['show']]);
        $this->middleware('permission:product-categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-categories-delete', ['only' => ['destroy']]);

    }


    public function index(Request $request)
    {

        return $this->ProductCategory->index($request);
    }


    public function create()
    {

        return $this->ProductCategory->create();
    }


    public function store(ProductCategoryRequest $request)
    {

        return $this->ProductCategory->store($request);

    }


    public function edit(ProductCategory $ProductCategory)
    {

        return $this->ProductCategory->edit($ProductCategory);
    }


    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        return $this->ProductCategory->update($request,$product_category);
    }


    public function destroy(Request $request)
    {

        return $this->ProductCategory->destroy($request);
    }
}
