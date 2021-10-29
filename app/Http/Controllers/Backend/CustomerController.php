<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Repositery\Customer\CustomerInterfaceRepositry;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customer;


    function __construct(CustomerInterfaceRepositry $customer){

        $this->customer = $customer;

        $this->middleware('permission:customer-list', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->customer->index($request);
    }


    public function create()
    {
        return $this->customer->create();
    }

    public function store(CustomerRequest $request)
    {
        return $this->customer->store($request);
    }

    public function edit(Customer $customer)
    {
        return $this->customer->edit($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        return $this->customer->update($request, $customer);
    }

    public function destroy(Request $request)
    {
        return $this->customer->destroy($request);
    }

}
