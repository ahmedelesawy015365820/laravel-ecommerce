<?php

namespace App\Repositery\Address;

use App\Models\Country;
use App\Models\CustomerAddress;

class AddressRepository implements AddressInterfaceRepositry{

    public function index($request){

        $addresses = CustomerAddress::with(['customer','country' => function ($q){

            return $q->select('id','name');

        },'state'=> function ($q){

            return $q->select('id','name');

        },'city'=> function ($q){

            return $q->select('id','name');

        }])->when($request->search,function ($q) use ($request){

            return $q->where('code','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.address.index',compact('addresses'));

    }//************end index */

    // public function create(){

    //     $countries = Country::whereStatus(true)->get();

    //     return view('dashboard.address.add',compact('countries'));

    // }//************end create */

    // public function store($request){

    //     $customerAddress= CustomerAddress::create($request->validated());

    //     return redirect()->route('admin.customer_address.index')->with('success',"Successfully Updated");

    // }//************end store */

    public function edit($customerAddress){

        $countries = Country::whereStatus(true)->get();

        return view('dashboard.address.edit',compact('customerAddress','countries'));

    }//************end edit */

    public function update($request, $customerAddress){

        $customerAddress->update($request->validated());

        return redirect()->route('admin.customer_address.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($customerAddress){

        $Address = CustomerAddress::findOrFail($customerAddress->id);

        $Address->delete();

        return redirect()->route('admin.customer_address.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
