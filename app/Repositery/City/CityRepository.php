<?php

namespace App\Repositery\City;

use App\Models\Category;
use App\Models\City;
use App\Models\State;

class CityRepository implements CityInterfaceRepositry{

    public function index($request){

        $cities = City::with('state')->when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        $states = State::all();

        return view('dashboard.city.index',compact('cities','states'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */


    public function store($request){

        City::create([
            'name' => $request->name,
            'status' => $request->status,
            'state_id' => $request->state_id,
        ]);

        return redirect()->route('admin.city.index')->with('success',"Successfully Added");

    }//************end store */

    public function update($request, $city){

        $city->update([
            'name' => $request->name,
            'status' => $request->status,
            'state_id' => $request->state_id,
        ]);

        return redirect()->route('admin.city.index')->with('success',"Successfully Update");


    }//************end update */

    public function destroy($state){

        $state = City::findOrFail($state->id);

        $state->delete();

        return redirect()->route('admin.city.index')->with('success',"Successfully Delete");

    }//************end destroy */
}
