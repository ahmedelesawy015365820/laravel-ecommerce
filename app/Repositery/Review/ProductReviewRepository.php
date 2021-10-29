<?php

namespace App\Repositery\Review;

use App\Models\ProductReview;

class ProductReviewRepository implements ProductReviewInterfaceRepositry{

    public function index($request){

        $ProductReviews = ProductReview::with(['customers',
            'products' => function ($q){
                return $q->select('id','name');
            }])
            ->when($request->search,function ($q) use ($request){

            return $q->where('code','like',"%". $request->search ."%");

        })->orderBy('id','DESC')->paginate(10);

        return view('dashboard.review.index',compact('ProductReviews'));

    }//************end index */

    public function show($review){

        return view('dashboard.review.show',compact('review'));

    }//************end show */

    public function edit($review){

        return view('dashboard.review.edit',compact('review'));

    }//************end edit */

    public function update($request, $review){

        $review->update($request->validated());

        return redirect()->route('admin.review.index')->with('success',"Successfully Updated");

    }//************end update */

    public function destroy($request){

        $ProductReview = ProductReview::findOrFail($request->id);

        $ProductReview->delete();

        return redirect()->route('admin.review.index')->with('success',"Successfully Deleted");

    }//************end destroy */
}
