<?php

namespace App\Repositery\Country;

use App\Models\Country;

class CountryRepository implements CountryInterfaceRepositry{

    public function index($request){

        $countries = Country::when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.country.index',compact('countries'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */


    public function store($request){

        Country::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.country.index')->with('success',"Successfully Added");

    }//************end store */

    public function update($request, $country){

        $country->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.country.index')->with('success',"Successfully Update");


    }//************end update */

    public function destroy($country){

        $category = Country::findOrFail($country->id);

        $category->delete();

        return redirect()->route('admin.country.index')->with('success',"Successfully Delete");

    }//************end destroy */
}
