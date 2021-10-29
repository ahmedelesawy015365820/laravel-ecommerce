<?php

namespace App\Repositery\ShippingCompany;

use App\Models\Country;
use App\Models\ProductCopon;
use App\Models\ShippingCompany;

class ShippingCompanyRepository implements ShippingCompanyInterfaceRepositry{

    public function index($request){

        $shippingcompanies = ShippingCompany::withCount('country')->when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.shippingcompany.index',compact('shippingcompanies'));

    }//************end index */

    public function create(){

        $countries = Country::all();

        return view('dashboard.shippingcompany.add',compact('countries'));

    }//************end create */

    public function store($request){

        if ($request->validated()) {
            $shipping_company = ShippingCompany::create($request->except('countries', '_token'));
            $shipping_company->country()->attach($request->countries);

            return redirect()->route('admin.shippingcompany.index')->with('success',"Successfully Added");
        }else{
            return redirect()->route('admin.shippingcompany.index')->with('error',"error Added");
        }

    }//************end store */

    public function edit($shippingcompany){
        $countries = Country::all();
        return view('dashboard.shippingcompany.edit',compact('countries','shippingcompany'));

    }//************end edit */

    public function update($request, $shippingcompany){

        if ($request->validated()) {
            $shippingcompany->update($request->except('countries', '_token'));
            $shippingcompany->country()->sync($request->countries);

            return redirect()->route('admin.shippingcompany.index')->with('success',"Successfully Updated");
        }else{
            return redirect()->route('admin.shippingcompany.index')->with('error',"error Updated");
        }


    }//************end update */

    public function destroy($shippingcompany){

        $shipping = ShippingCompany::findOrFail($shippingcompany->id);

        $shipping->delete();

        return redirect()->route('admin.shippingcompany.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
