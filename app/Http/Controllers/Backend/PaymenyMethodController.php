<?php

namespace App\Http\Controllers\Backend;

use App\Models\PaymenyMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Repositery\PaymentMethod\PaymentMethodInterfaceRepositry;

class PaymenyMethodController extends Controller
{

    protected $method;


    function __construct(PaymentMethodInterfaceRepositry $method){

        $this->method = $method;

        // $this->middleware('permission:paymentmethod-list', ['only' => ['index']]);
        // $this->middleware('permission:paymentmethod-create', ['only' => ['create','store']]);
        // $this->middleware('permission:paymentmethod-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:paymentmethod-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->method->index($request);
    }


    public function create()
    {
        return $this->method->create();
    }


    public function store(PaymentMethodRequest $request)
    {
        return $this->method->store($request);
    }

    public function edit(PaymenyMethod $payment_method)
    {
        return $this->method->edit($payment_method);
    }


    public function update(PaymentMethodRequest $request,PaymenyMethod $payment_method)
    {
        return $this->method->update($request,$payment_method);
    }

    public function destroy(PaymenyMethod $payment_method)
    {
        return $this->method->destroy($payment_method);
    }
}
