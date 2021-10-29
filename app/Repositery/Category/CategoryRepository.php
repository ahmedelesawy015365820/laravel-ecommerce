<?php

namespace App\Repositery\Category;

use App\Models\Category;

class CategoryRepository implements CategoryInterfaceRepositry{

    public function index($request){

        $categories = Category::when($request->search,function ($q) use ($request){

            return $q
                    ->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.category.index',compact('categories'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */


    public function store($request){

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.category.index')->with('success',"Successfully Added");

    }//************end store */

    public function update($request, $Category){

        $Category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.category.index')->with('success',"Successfully Update");


    }//************end update */

    public function destroy($request){

        $category = Category::findOrFail($request->id);

        $category->delete();

        return redirect()->route('admin.category.index')->with('success',"Successfully Delete");

    }//************end destroy */
}
