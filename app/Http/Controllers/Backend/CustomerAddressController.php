<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddressRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Repositery\Address\AddressInterfaceRepositry;
use Illuminate\Http\Request;


class CustomerAddressController extends Controller
{

    protected $address;

    function __construct(AddressInterfaceRepositry $address){

        $this->address = $address;

        $this->middleware('permission:address-list', ['only' => ['index']]);
        $this->middleware('permission:address-create', ['only' => ['create','store']]);
        $this->middleware('permission:address-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:address-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->address->index($request);
    }

    // public function create()
    // {
    //     return $this->address->create();
    // }

    // public function store(CustomerAddressRequest $request)
    // {
    //     return $this->address->store($request);
    // }

    public function edit(CustomerAddress $customerAddress)
    {
        return $this->address->edit($customerAddress);
    }

    public function update(CustomerAddressRequest $request, CustomerAddress $customerAddress)
    {
        return $this->address->update($request,$customerAddress);
    }

    public function destroy(CustomerAddress $customerAddress)
    {
        return $this->address->destroy($customerAddress);
    }

    public function state($id)
    {
        $state = Country::find($id)->states->where('status',true);

        return response()->json(['state'=> $state]);

    }

    public function city($id)
    {
        $city = State::find($id)->cities->where('status',true);

        return response()->json(['city'=> $city]);

    }

    // public function name($name)
    // {
    //     $customer = Customer::when($name,function ($q) use($name){
    //         return $q->where('first name','like',"%". $name ."%")
    //         ->where('status', true)->
    //         select('id','first_name','last_name');
    //     });

    //     return response()->json(['customer'=> $customer]);

    // }
}

