<?php

namespace App\Repositery\PaymentMethod;

use App\Models\PaymenyMethod;

class PaymentMethodRepository implements PaymentMethodInterfaceRepositry{

    public function index($request){

        $paymentmethods = PaymenyMethod::when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.paymentmethod.index',compact('paymentmethods'));

    }//************end index */

    public function create(){

        return view('dashboard.paymentmethod.add');

    }//************end create */

    public function store($request){

        if ($request->validated()) {
            $payment_method = PaymenyMethod::create($request->validated());

            return redirect()->route('admin.payment_method.index')->with('success',"Successfully Added");
        }else{
            return redirect()->route('admin.payment_method.index')->with('error',"error Added");
        }

    }//************end store */

    public function edit($payment_method){

        return view('dashboard.paymentmethod.edit',compact('payment_method'));

    }//************end edit */

    public function update($request, $payment_method){

        if ($request->validated()) {
            $payment_method->update($request->validated());

            return redirect()->route('admin.payment_method.index')->with('success',"Successfully Updated");
        }else{
            return redirect()->route('admin.payment_method.index')->with('error',"error Updated");
        }


    }//************end update */

    public function destroy($payment_method){

        $shipping = PaymenyMethod::findOrFail($payment_method->id);

        $shipping->delete();

        return redirect()->route('admin.payment_method.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
