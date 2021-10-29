<?php

namespace App\Repositery\Product;

use App\Models\Media;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class ProductRepository implements ProductInterfaceRepositry{

    public function index($request){

        $Products = Product::with([ 'category' ,'firstMedia'])->when($request->search,function ($q) use ($request){

            return $q->where('name','like',"%". $request->search ."%");

        })->orderBy('id','ASC')->paginate(10);

        return view('dashboard.product.index',compact('Products'));


    }//************end index */

    public function create(){

        $categories = ProductCategory::get();
        $tags = Tag::get();

        return view('dashboard.product.add',compact('categories','tags'));

    }//************end create */

    public function store($request){

        $product = Product::create([
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'featured' => $request->featured,
            'description' => $request->description,
        ]);

        $product->tags()->attach($request->tags);

        $i = 1;

        foreach($request->images as $cover){

            $image = $cover->hashName();
            $file_size = $cover->getSize();
            $file_type = $cover->getMimeType();

            // picture move
            $img = Image::make($cover)->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('assets/img/products/'. $image));

            $product->media()->create([
                'file_name' => $image ,
                'file_size' => $file_size,
                'file_type' => $file_type,
                'file_status' => true,
                'file_sort' => $i,
            ]);

            $i++;
        }

        return redirect()->route('admin.product.index')->with('success',"Successfully Added");

    }//************end store */

    public function edit($product){
        $categories = ProductCategory::get();
        $tags = Tag::get();

        return view('dashboard.product.edit',compact('categories','tags','product'));

    }//************end edit */

    public function update($request, $product){

        $product->update([
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'featured' => $request->featured,
            'description' => $request->description,
        ]);

        $product->tags()->sync($request->tags);

        $i = 1;

        if(!empty($request->images)){

            foreach($product->media as $image){
                Storage::disk('product')->delete($image->file_name);

                $media = Media::findOrFail($image->id)->delete();
            }

            foreach($request->images as $cover){

                $image = $cover->hashName();
                $file_size = $cover->getSize();
                $file_type = $cover->getMimeType();

                // picture move
                $img = Image::make($cover)->resize(500, null, function ($constraint) {

                    $constraint->aspectRatio();

                })->save(public_path('assets/img/products/'. $image));

                $product->media()->create([
                    'file_name' => $image ,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);

                $i++;
            }

        }


        return redirect()->route('admin.product.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($request){

        $product = Product::findOrFail($request->id);

        foreach($product->media as $image){

            Storage::disk('product')->delete($image->file_name);

            $media = Media::findOrFail($image->id)->delete();
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success',"Successfully Deleted");


    }//************end destroy */

}
