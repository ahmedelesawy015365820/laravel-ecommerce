<?php

namespace App\Repositery\Review;


interface ProductReviewInterfaceRepositry {

    public function index($request);

    public function show($review);

    public function edit($review);

    public function update($request, $review);

    public function destroy($request);

}
