<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingCompanyRequest;
use App\Repositery\ShippingCompany\ShippingCompanyInterfaceRepositry;

class ShippingCompanyController extends Controller
{

    protected $shippingcompany;


    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(ShippingCompanyInterfaceRepositry $shippingcompany){

        $this->shippingcompany = $shippingcompany;

        $this->middleware('permission:shipping-list', ['only' => ['index']]);
        $this->middleware('permission:shipping-create', ['only' => ['create','store']]);
        $this->middleware('permission:shipping-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:shipping-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->shippingcompany->index($request);
    }

    public function create()
    {
        return $this->shippingcompany->create();
    }

    public function store(ShippingCompanyRequest $request)
    {
        return $this->shippingcompany->store($request);
    }

    public function edit(ShippingCompany $shippingcompany)
    {
        return $this->shippingcompany->edit($shippingcompany);
    }

    public function update(ShippingCompanyRequest $request, ShippingCompany $shippingcompany)
    {
        return $this->shippingcompany->update($request, $shippingcompany);
    }

    public function destroy(ShippingCompany $shippingcompany)
    {
        return $this->shippingcompany->destroy($shippingcompany);
    }
}
