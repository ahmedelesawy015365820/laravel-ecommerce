<?php

namespace App\Repositery\User;

use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserRepositry implements UserInterfaceRepositry {

    public function index($request)
    {

        $data = User::when($request->search,function ($q) use ($request){

            return $q->where('id','!=','1')
                    ->where('first_name','like',"%". $request->search ."%")
                    ->orWhere('last_name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(5);

        return view('dashboard.users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);

    }//*****end index

    public function create(){

        $roles = FacadesDB::table('roles')->where('name','!=','SuperAdmin')->get();

        return view('dashboard.users.add',compact('roles'));

    }//*****end create

    public function store($request)
    {

        $input = $request->all();

        if(!$request->hasFile('image')){

            $input['image'] = '6.jpg';

        }else{

            $image = $request->image;

            // picture move
            $name = $image->getClientOriginalName();
            $image->storeAs($request->email, $name,'profile');

            $input['image'] = $request->email.'/'.$image;

        }

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $user->assignRole($request->input('roles_name'));

        return redirect()->route('admin.users.index')->with('success',trans('site.success'));

    }//*****end store

    public function edit($id)
    {

        $user = User::find($id);

        $roles = FacadesDB::table('roles')->where('name','!=','SuperAdmin')->get();

        $userRole = $user->roles->pluck('name','name')->all();

        return view('dashboard.users.edit',compact('user','roles','userRole'));

    }//*****end edit

    public function update($request, $user)
    {

        $user = User::find($user->id);
        $input = $request->all();

        if ($request->hasFile('image') && $user->image != '6.jpg'){

            Storage::disk('profile')->delete( $user->image );

            $image = $request->image;

            // picture move
            $name = $image->getClientOriginalName();
            $image->storeAs($user->email, $name,'profile');

            $input['image'] = $request->email.'/'.$image;

        }

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($user->id);

        $user->update($input);

        FacadesDB::table('model_has_roles')->where('model_id',$user->id)->delete();

        $user->assignRole($request->input('roles_name'));

        return redirect()->route('admin.users.index')->with('success',trans('site.success'));

    }//*****end update

    public function destroy($request)
    {

        $user = User::find($request->user_id);

        if($user->image != '6.jpg')
            Storage::disk('profile')->delete( $user->image );

        $user->delete();

        return redirect()->route('admin.users.index')->with('success',trans('site.true-delete'));

    }//*****end destroy

}
