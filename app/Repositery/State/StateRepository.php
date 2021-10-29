<?php

namespace App\Repositery\State;

use App\Models\Category;
use App\Models\Country;
use App\Models\State;

class StateRepository implements StateInterfaceRepositry{

    public function index($request){

        $states = State::when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        $countries = Country::all();

        return view('dashboard.state.index',compact('states','countries'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */


    public function store($request){

        State::create([
            'name' => $request->name,
            'status' => $request->status,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('admin.state.index')->with('success',"Successfully Added");

    }//************end store */

    public function update($request, $state){

        $state->update([
            'name' => $request->name,
            'status' => $request->status,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('admin.state.index')->with('success',"Successfully Update");


    }//************end update */

    public function destroy($state){

        $state = State::findOrFail($state->id);

        $state->delete();

        return redirect()->route('admin.state.index')->with('success',"Successfully Delete");

    }//************end destroy */
}
