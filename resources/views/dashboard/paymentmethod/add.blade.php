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
    Payment Method
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Payment Method</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.payment_method.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.payment_method.store')}}"
                    method="POST"
                    >

                    @csrf

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="code">code</label>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                                @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sandbox">Sandbox</label>
                                <select name="sandbox" class="form-control">
                                    <option value="1" {{ old('sandbox') == '1' ? 'selected' : null }}>Sandbox</option>
                                    <option value="0" {{ old('sandbox') == '0' ? 'selected' : null }}>Live</option>
                                </select>
                                @error('sandbox')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="merchant_email">Merchant Email</label>
                                <input type="text" name="merchant_email" value="{{ old('merchant_email') }}" class="form-control">
                                @error('merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_id">Client ID</label>
                                <input type="text" name="client_id" value="{{ old('client_id') }}" class="form-control">
                                @error('client_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_secret">Client secret</label>
                                <input type="text" name="client_secret" value="{{ old('client_secret') }}" class="form-control">
                                @error('client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sandbox_merchant_email">Sandbox Merchant Email</label>
                                <input type="text" name="sandbox_merchant_email" value="{{ old('sandbox_merchant_email') }}" class="form-control">
                                @error('sandbox_merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sandbox_client_id">Sandbox client id</label>
                                <input type="text" name="sandbox_client_id" value="{{ old('sandbox_client_id') }}" class="form-control">
                                @error('sandbox_client_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sandbox_client_secret">Sandbox client secret</label>
                                <input type="text" name="sandbox_client_secret" value="{{ old('sandbox_client_secret') }}" class="form-control">
                                @error('sandbox_client_secret')<span class="text-danger">{{ $message }}</span>@enderror
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
