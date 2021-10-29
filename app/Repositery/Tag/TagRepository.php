<?php

namespace App\Repositery\Tag;

use App\Models\Tag;

class TagRepository implements TagInterfaceRepositry{

    public function index($request){

        $tags = Tag::withCount('products')->when($request->search,function ($q) use ($request){

            return $q
                    ->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.tag.index',compact('tags'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */

    public function store($request){

        Tag::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.tag.index')->with('success',"Successfully Added");

    }//************end store */

    public function update($request, $tag){

        $tag->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.tag.index')->with('success',"Successfully Update");


    }//************end update */

    public function destroy($request){

        $tag = Tag::findOrFail($request->id);

        $tag->delete();

        return redirect()->route('admin.tag.index')->with('success',"Successfully Delete");

    }//************end destroy */
}
