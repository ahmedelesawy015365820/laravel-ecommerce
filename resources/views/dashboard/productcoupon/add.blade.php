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
    Add Coupon
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Add Coupon</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.product_coupon.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.product_coupon.store')}}"
                    method="POST"
                    >

                    @csrf

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-3" id="fnWrapper">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control">
                                    @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="parsley-input col-md-3" id="fnWrapper">
                                <label for="type">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">---</option>
                                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : null }}>Fixed</option>
                                    <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : null }}>Percentage</option>
                                </select>
                                @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" name="value" value="{{ old('value') }}" class="form-control">
                                    @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="use_times">Use times</label>
                                    <input type="number" name="use_times" value="{{ old('use_times') }}" class="form-control">
                                    @error('use_times')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="start_date">Start date</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ Date('Y-m-d') }}" class="form-control">
                                    @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="expire_date">Expire date</label>
                                    <input type="date" name="expire_date" id="expire_date" value="{{ old('expire_date') }}" class="form-control">
                                    @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="greater_than">Greater than</label>
                                    <input type="number" name="greater_than" value="{{ old('greater_than') }}" class="form-control">
                                    @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                    @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">Add</button>
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
