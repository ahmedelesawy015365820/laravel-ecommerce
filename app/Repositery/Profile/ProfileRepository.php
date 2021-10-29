<?php

namespace App\Repositery\Profile;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;



class ProfileRepository implements ProfileInterfaceRepositry{

    public function index(){

        return view('dashboard.profile.index');
    }//************end index */

    public function create(){

        return view('dashboard.profile.create');

    }//************end create */


    public function update($request, $profile){

        $user = User::find($profile->id);
        $input = [];

        if ($request->hasFile('image') && $user->image != '6.jpg'){

            Storage::disk('profile')->delete( $user->image );

            $image = $request->image->hashName();

            $img = Image::make(request()->image)->resize(100, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('assets/img/faces/'. $image));

            $input['image'] = $image;

        }

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }

        if($user->email != $request->email){
            $input['email'] = $request->email;
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;

        $user->update($input);

        return redirect()->route('admin.profile.index')->with('success',"Successfully Updated");


    }//************end update */

}
