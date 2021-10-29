<?php

namespace App\Http\Controllers\Backend;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\City;
use App\Repositery\State\StateInterfaceRepositry;

class StateController extends Controller
{
    protected $Category;


    function __construct(StateInterfaceRepositry $state){

        $this->state = $state;

        $this->middleware('permission:state-list', ['only' => ['index']]);
        $this->middleware('permission:state-create', ['only' => ['create','store']]);
        $this->middleware('permission:state-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:state-delete', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        return $this->state->index($request);
    }


    public function store(StateRequest $request)
    {
        return $this->state->store($request);
    }

    public function update(StateRequest $request, State $state)
    {
        return $this->state->update($request,$state);
    }

    public function destroy(State $state)
    {
        return $this->state->destroy($state);
    }
}
