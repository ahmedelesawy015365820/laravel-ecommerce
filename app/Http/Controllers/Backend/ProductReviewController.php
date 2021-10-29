<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewRequest;
use App\Models\ProductReview;
use App\Repositery\Review\ProductReviewInterfaceRepositry;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    protected $review;


    function __construct(ProductReviewInterfaceRepositry $review){

        $this->review = $review;

        $this->middleware('permission:review-list', ['only' => ['index']]);
        $this->middleware('permission:review-show', ['only' => ['show']]);
        $this->middleware('permission:review-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:review-delete', ['only' => ['destroy']]);

    }


    public function index(Request $request)
    {
        return $this->review->index($request);
    }

    public function show(ProductReview $review)
    {
        return $this->review->show($review);
    }

    public function edit(ProductReview $review)
    {
        return $this->review->edit($review);
    }

    public function update(ProductReviewRequest $request, ProductReview $review)
    {
        return $this->review->update($request,$review);
    }

    public function destroy(Request $request)
    {
        return $this->review->destroy($request);
    }
}
