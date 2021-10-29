@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />

@endsection
@section('title')
Show Review
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Show Review</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.review.index') }}">back</a>
                    </div>
                </div><br>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{  $review->name }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" value="{{  $review->email }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="rating">Rating</label>
                            <input type="text" name="text" value="{{  $review->rating }}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label for="product_id">Product</label>
                            <input type="text" value="{{ $review->products->name }}" class="form-control" readonly>
                        </div>
                        <div class="col-4">
                            <label for="user_id">Customer</label>
                            <input type="text" value="{{ $review->customer_id != '' ? $review->customers->fullname : '' }}" class="form-control" readonly>
                        </div>
                        <div class="col-4">
                            <label for="status">Status</label>
                            <input type="text" value=" {{$review->status}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="title">Title</label>
                            <input type="text" name="title" readonly value="{{ $review->title }}" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" readonly>{{ $review->message }}</textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>

<script></script>

@endsection
