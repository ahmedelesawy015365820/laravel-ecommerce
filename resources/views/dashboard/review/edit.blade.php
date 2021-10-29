@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />

<style>
    #code {
        text-transform: uppercase;
    }
</style>
@endsection
@section('title')
Review
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Review</span>
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
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.review.update', $review)}}"
                    method="POST"
                    >
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name', $review->name) }}" class="form-control">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" value="{{ old('email', $review->email) }}" class="form-control">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="rating">Rating</label>
                            <select name="rating" class="form-control">
                                <option value="1" {{ old('rating', $review->rating) == '1' ? 'selected' : null }}>1</option>
                                <option value="2" {{ old('rating', $review->rating) == '2' ? 'selected' : null }}>2</option>
                                <option value="3" {{ old('rating', $review->rating) == '3' ? 'selected' : null }}>3</option>
                                <option value="4" {{ old('rating', $review->rating) == '4' ? 'selected' : null }}>4</option>
                                <option value="5" {{ old('rating', $review->rating) == '5' ? 'selected' : null }}>5</option>
                            </select>
                            @error('rating')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label for="product_id">Product</label>
                            <input type="text" value="{{ $review->products->name }}" class="form-control" readonly>
                            <input type="hidden" name="product_id" value="{{ $review->product_id }}" class="form-control" readonly>
                            @error('product_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <label for="user_id">Customer</label>
                            <input type="text" value="{{ $review->customer_id != '' ? $review->customers->fullname : '' }}" class="form-control" readonly>
                            <input type="hidden" name="customer_id" value="{{ $review->customer_id ?? '' }}" class="form-control" readonly>
                            @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $review->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $review->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ $review->title }}" class="form-control">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control">{{ $review->message }}</textarea>
                            @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">Update</button>
                    </div>
                </form>
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
