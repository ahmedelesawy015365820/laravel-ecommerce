@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@endsection

@section('title')
Show Admin
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> Admin</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Show Admins</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@include('layouts.alerts.success')
@include('layouts.alerts.errors')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.index') }}">back</a>
                    </div>
                </div><br>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>First : <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper"
                                value="{{Auth::user()->first_name}}"
                                name="first_name"
                                required
                                type="text"
                                readonly
                                >
                        </div>

                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>Last : <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                value="{{Auth::user()->last_name}}"
                                data-parsley-class-handler="#lnWrapper"
                                name="last_name"
                                required
                                type="text"
                                readonly
                            >
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>E-mail: <span class="tx-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm mg-b-20" readonly value="{{Auth::user()->email}}" readonly>
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <img src="{{URL::asset('assets/img/faces/'. Auth::user()->image)}}"
                            alt="profile"
                            width="100px"
                            class="img-thumbnail"
                            id="output"
                            >
                        </div>
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
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

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
