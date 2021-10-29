<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileCustomerRequest;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
{


    public function profile()
    {

        return view('frontend.customer.profile');

    }

    public function remove_profile_image()
    {
        $user = auth()->guard('customer')->user();

        Storage::disk('user')->delete( $user->customer_image );

        $user->customer_image = '';
        $user->save();

        return redirect()->route('frontend.customer.profile');
    }

    public function update_profile(ProfileCustomerRequest $request)
    {

        $user = auth()->guard('customer')->user();
        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;


        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $data['password'] = bcrypt($request->password);
        }

        if(request()->hasFile('customer_image')){

            $image = $request->customer_image;

            $name = $image->getClientOriginalName();
            $image->storeAs($user->username, $name,'user');

            $data['customer_image'] = $user->username ."/".$name;

        }

        $user->update($data);

        toast('Profile updated', 'success');
        return back();

    }

    public function dashboard()
    {

        return view('frontend.customer.dashboard');

    }

    public function addresses()
    {

        return view('frontend.customer.addresses');
    }

    public function orders()
    {

        return view('frontend.customer.orders');

    }

}
