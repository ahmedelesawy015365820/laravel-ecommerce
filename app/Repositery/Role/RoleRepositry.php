<?php

namespace App\Repositery\Role;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleRepositry implements RoleInterfaceRepositry {

    public function index($request){

        $roles = Role::paginate(5);

        return view('dashboard.roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);

    }// ******* end index

    public function create(){

        $permission = Permission::get();
        return view('dashboard.roles.create',compact('permission'));

    }// ******* end create

    public function store($request){

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.roles.index')->with('success', trans('site.success'));

    }// ******* end store

    public function show($id){

        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)->get();
        return view('dashboard.roles.show',compact('role','rolePermissions'));

    }// ******* end show

    public function edit($id){

        $role = Role::find($id);
        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id",$id)->
        pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('dashboard.roles.edit',compact('role','permission','rolePermissions'));

    }// ******* end edit

    public function update($request, $role){

        $role = Role::find($role->id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')->with('success','success');

    }// ******* end update

    public function destroy($request){

        DB::table("roles")->where('id', $request->user_id)->delete();
        return redirect()->route('admin.roles.index')->with('success', trans('site.true-delete'));

    }// ******* end destroy
}
