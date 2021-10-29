<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositery\Product\ProductInterfaceRepositry;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;


    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(ProductInterfaceRepositry $product){

        $this->product = $product;

        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->product->index($request);
    }

    public function create()
    {
        return $this->product->create();
    }

    public function store(ProductRequest $request)
    {
        return $this->product->store($request);
    }

    public function edit(Product $product)
    {
        return $this->product->edit($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        return $this->product->update($request,$product);
    }

    public function destroy(Request $request)
    {
        return $this->product->destroy($request);
    }
}
