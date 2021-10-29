<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositery\Role\RoleInterfaceRepositry;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    protected $role;


    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(RoleInterfaceRepositry $role){

        $this->role = $role;

        $this->middleware('permission:Permission-list', ['only' => ['index']]);
        $this->middleware('permission:Permission-show', ['only' => ['show']]);
        $this->middleware('permission:Permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:Permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Permission-delete', ['only' => ['destroy']]);

    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function index(Request $request)
    {

        return $this->role->index($request);
    }

    /*** Show the form for creating a new resource.** @return \Illuminate\Http\Response*/
    public function create()
    {

        return $this->role->create();
    }

    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request* @return \Illuminate\Http\Response*/

    public function store(RoleRequest $request)
    {

        return $this->role->store($request);

    }

    /*** Display the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function show($id)
    {
        return $this->role->show($id);
    }

    /*** Show the form for editing the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function edit($id)
    {

        return $this->role->edit($id);
    }

    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/
    public function update(RoleRequest $request, Role $role)
    {

        return $this->role->update($request, $role);

    }

    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy(Request $request)
    {
        return $this->role->destroy($request);
    }
}

