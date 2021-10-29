@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@endsection
@section('title')
    Add Sub Category
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Add Sub Category</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.product-categories.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.product-categories.store','test')}}"
                    method="POST"
                    enctype="multipart/form-data"
                    >

                    {{csrf_field()}}

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="parsley-input col-md-3" id="fnWrapper">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">---</option>
                                    @forelse($Categories as $Category)
                                    <option value="{{ $Category->id }}" {{ old('category_id') == $Category->id ? 'selected' : null }}>{{ $Category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>image : <span class="tx-danger">*</span></label>
                                <input
                                    class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper"
                                    name="cover"
                                    type="file"
                                    accept=".jpg, .png, image/jpeg, image/png"
                                    onchange="loadFile(event)"
                                    >
                                <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                @error('cover')<span class="text-danger">{{ $message }}</span>@enderror

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <img src="{{URL::asset('assets/img/faces/6.jpg')}}"
                                    alt="profile"
                                    width="100px"
                                    class="img-thumbnail"
                                    id="output"
                                    >
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">add</button>
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
