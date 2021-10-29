<?php

namespace App\Repositery\Customer;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ProductCategory;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class CustomerRepository implements CustomerInterfaceRepositry{

    public function index($request){

        $customers = Customer::when($request->search,function ($q) use ($request){

            return $q
                    ->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.customer.index',compact('customers'));


    }//************end index */

    public function create(){

        return view('dashboard.customer.add');

    }//************end create */

    public function store($request){

        if(request()->hasFile('customer_image')){

            $image = $request->customer_image->hashName();

            // picture move
            $img = Image::make(request()->customer_image)->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();

                })->save(public_path('assets/img/customers/'. $image));

        }else{
            $image = '5.jpg';
        }

        $input['email_verified_at'] = now();

        Customer::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'username'      => $request->username,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'status'        => $request->status,
            'password'      => bcrypt($request->password),
            'customer_image'    => $image,
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.customer.index')->with('success',"Successfully Added");

    }//************end store */

    public function edit($customer){

        return view('dashboard.customer.edit',compact('customer'));

    }//************end edit */

    public function update($request, $customer){

        $input = [];

        if(request()->hasFile('customer_image')){

            Storage::disk('customer')->delete( $customer->customer_image );

            $image = $request->customer_image->hashName();

            // picture move
            $img = Image::make(request()->customer_image)->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();

                })->save(public_path('assets/img/customers/'. $image));

            $input['customer_image'] = $image;

        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['status'] = $request->status;
        if($request->password){
            $input['password'] = bcrypt($request->password);
        }

        $customer->update($input);

        return redirect()->route('admin.customer.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($request){

        $customer = Customer::findOrFail($request->id);

        if($customer->customer_image != '5.jpg'){

            Storage::disk('customer')->delete( $customer->customer_image );

        }

        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success',"Successfully Deleted");


    }//************end destroy */
}
