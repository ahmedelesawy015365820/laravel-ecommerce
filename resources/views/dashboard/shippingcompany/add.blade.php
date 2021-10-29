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
    Add Shipping Company
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Add Shipping Company</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.shippingcompany.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.shippingcompany.store')}}"
                    method="POST"
                    >

                    @csrf

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                                @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fast">Fast</label>
                                <select name="fast" class="form-control">
                                    <option value="1" {{ old('fast') == '1' ? 'selected' : null }}>Yes</option>
                                    <option value="0" {{ old('fast') == '0' ? 'selected' : null }}>No</option>
                                </select>
                                @error('fast')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="text" name="cost" value="{{ old('cost') }}" class="form-control">
                                @error('cost')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="status">status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="countries">Countries</label>
                                <select name="countries[]" class="form-control select-multiple-tags" multiple="multiple">
                                    @forelse($countries as $country)
                                        <option value="{{ $country->id }}" {{ in_array($country->id, old('countries', [])) ? 'selected' : null }} >{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('countries')<span class="text-danger">{{ $message }}</span>@enderror
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
