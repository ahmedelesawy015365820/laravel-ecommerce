<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCouponRequest;
use App\Models\ProductCopon;
use App\Repositery\Coupon\ProductCouponInterfaceRepositry;

class ProductCouponController extends Controller
{

    protected $Productcoupon;


    function __construct(ProductCouponInterfaceRepositry $Productcoupon){

        $this->Productcoupon = $Productcoupon;

        $this->middleware('permission:coupon-list', ['only' => ['index']]);
        $this->middleware('permission:coupon-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->Productcoupon->index($request);
    }


    public function create()
    {
        return $this->Productcoupon->create();
    }


    public function store(ProductCouponRequest $request)
    {
        return $this->Productcoupon->store($request);
    }

    public function edit(ProductCopon $product_coupon)
    {
        return $this->Productcoupon->edit($product_coupon);
    }


    public function update(ProductCouponRequest $request,ProductCopon $product_coupon)
    {
        return $this->Productcoupon->update($request,$product_coupon);
    }

    public function destroy(Request $request)
    {
        return $this->Productcoupon->destroy($request);
    }
}
