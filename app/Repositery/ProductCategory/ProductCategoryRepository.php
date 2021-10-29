<?php

namespace App\Repositery\ProductCategory;

use App\Models\Category;
use App\Models\ProductCategory;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class ProductCategoryRepository implements ProductCategoryInterfaceRepositry{

    public function index($request){

        $ProductCategories = ProductCategory::withCount('products')->with([ 'category' => function ($q) {

            return $q->select('name','id');

        }])->when($request->search,function ($q) use ($request){

            return $q
                    ->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.productcategory.index',compact('ProductCategories'))->with('i', ($request->input('page', 1) - 1) * 5);


    }//************end index */

    public function create(){

        $Categories = Category::get();

        return view('dashboard.productcategory.add',compact('Categories'));

    }//************end create */

    public function store($request){


        if(request()->hasFile('cover')){

            $image = $request->cover->hashName();

            // picture move
            $img = Image::make(request()->cover)->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();

                })->save(public_path('assets/img/subcategory/'. $image));

        }

        ProductCategory::create([
            'name' => $request->name,
            'cover' => $image,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.product-categories.index')->with('success',"Successfully Added");

    }//************end store */

    public function edit($ProductCategory){

        $Categories = Category::get();

        return view('dashboard.productcategory.edit',compact('Categories','ProductCategory'));

    }//************end edit */

    public function update($request, $product_category){

        if(request()->hasFile('cover')){

            Storage::disk('subcategory')->delete( $product_category->cover );

            $image = $request->cover;

            // picture move
            $img = Image::make(request()->cover)->resize(500, null, function ($constraint) {

            $constraint->aspectRatio();

            })->save(public_path('assets/img/subcategory/'. $image));

            $product_category->update([
                'name' => $request->name,
                'cover' => $image,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.product-categories.index')->with('success',"Successfully Updated");

        }

        $product_category->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.product-categories.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($request){

        $product_category = ProductCategory::findOrFail($request->id);

        Storage::disk('subcategory')->delete( $product_category->cover );

        $product_category->delete();

        return redirect()->route('admin.product-categories.index')->with('success',"Successfully Deleted");


    }//************end destroy */
}
