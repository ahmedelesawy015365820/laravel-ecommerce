<?php

namespace App\Repositery\Coupon;

use App\Models\ProductCopon;

class ProductCouponRepository implements ProductCouponInterfaceRepositry{

    public function index($request){

        $ProductCoupons = ProductCopon::when($request->search,function ($q) use ($request){

            return $q->where('code','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.productcoupon.index',compact('ProductCoupons'));

    }//************end index */

    public function create(){

        return view('dashboard.productcoupon.add');

    }//************end create */

    public function store($request){

        $product_coupon = ProductCopon::create( $request->validated() );

        return redirect()->route('admin.product_coupon.index')->with('success',"Successfully Added");

    }//************end store */

    public function edit($product_coupon){

        return view('dashboard.productcoupon.edit',compact('product_coupon'));

    }//************end edit */

    public function update($request, $product_category){

        $product_category->update($request->validated());

        return redirect()->route('admin.product_coupon.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($request){

        $product_coupon = ProductCopon::findOrFail($request->id);

        $product_coupon->delete();

        return redirect()->route('admin.product_coupon.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
