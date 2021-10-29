<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositery\User\UserInterfaceRepositry;


class UserController extends Controller
{

    protected $user;

    function __construct(UserInterfaceRepositry $user){

        $this->user = $user;

        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }


    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/

    public function index(Request $request)
    {

        return $this->user->index($request);

    }


    public function create(){

        return $this->user->create();

    }


    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request* @return \Illuminate\Http\Response*/

    public function store(UserRequest $request)
    {

        return $this->user->store($request);
    }



    /*** Show the form for editing the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/

    public function edit($id)
    {

        return $this->user->edit($id);
    }



    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/
    public function update(UserRequest $request, User $user)
    {

        return $this->user->update($request, $user);
    }



    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy(Request $request)
    {

        return $this->user->destroy($request);
    }
}
