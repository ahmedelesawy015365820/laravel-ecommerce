@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@endsection
@section('title')
Update Customer
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Update Customer</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.customer.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.customer.update', $customer->id)}}"
                    method="POST"
                    enctype="multipart/form-data"
                    >

                    @method('PUT')
                    @csrf

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" class="form-control">
                                    @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name',$customer->last_name) }}" class="form-control">
                                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" value="{{ old('username',$customer->username) }}" class="form-control">
                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{ old('email',$customer->email) }}" class="form-control">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" value="{{ old('mobile',$customer->mobile) }}" class="form-control">
                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status',$customer->status) == '1' ? 'selected' : null }}>Active</option>
                                        <option value="0" {{ old('status',$customer->status) == '0' ? 'selected' : null }}>Inactive</option>
                                    </select>
                                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>image : <span class="tx-danger">*</span></label>
                                <input
                                    class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper"
                                    name="customer_image"
                                    type="file"
                                    accept=".jpg, .png, image/jpeg, image/png"
                                    onchange="loadFile(event)"
                                    >
                                <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                @error('customer_image')<span class="text-danger">{{ $message }}</span>@enderror

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <img src="{{asset('assets/img/customers/'. $customer->customer_image)}}"
                                    alt="profile"
                                    onerror="src='{{ asset('assets/img/customers/5.jpg') }}'"
                                    width="100px"
                                    class="img-thumbnail"
                                    id="output"
                                    >
                                </div>
                            </div>

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

<script>
    // jquery image preview

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

</script>

@endsection
