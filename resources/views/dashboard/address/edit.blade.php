@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />

@endsection
@section('title')
Edit Address
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Edit Address</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.customer_address.index') }}">back</a>
                    </div>
                </div><br>
                <form class="parsley-style-1"
                    id="selectForm2"
                    autocomplete="off"
                    name="selectForm2"
                    action="{{route('admin.customer_address.update',$customerAddress->id)}}"
                    method="POST"
                    >

                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="user_id">Customer</label>
                                <input type="text" class="form-control typeahead" name="customer_name"  value="{{ old('customer_name', $customerAddress->customer->full_name) }}" placeholder="Start typing something to search customer..." autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{ old('customer_id', $customerAddress->customer_id) }}" readonly>
                                @error('customer_id')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="address_title">Address title</label>
                                <input type="text" name="address_title" value="{{ old('address_title',$customerAddress->address_title) }}" class="form-control">
                                @error('address_title')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="default_address">Default address</label>
                                <select name="default_address" class="form-control">
                                    <option value="0" {{ old('default_address', $customerAddress->default_address) == '0' ? 'selected' : null }}>No</option>
                                    <option value="1" {{ old('default_address', $customerAddress->default_address) == '1' ? 'selected' : null }}>Yes</option>
                                </select>
                                @error('default_address')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $customerAddress->first_name) }}" class="form-control">
                                @error('first_name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $customerAddress->last_name) }}" class="form-control">
                                @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ old('email',$customerAddress->email) }}" class="form-control">
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" value="{{ old('mobile',$customerAddress->mobile) }}" class="form-control">
                                @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <select name="country_id" id="country_id"  class="form-control">
                                    <option value=""> --- </option>
                                    @forelse($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id',$customerAddress->country_id) == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('country_id')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="state_id">State</label>
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="{{ $customerAddress->state_id }}" selected>{{ $customerAddress->state->name }}</option>
                                </select>
                                @error('state_id')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="{{ $customerAddress->city_id }}" selected>{{ $customerAddress->city->name }}</option>
                                </select>
                                @error('city_id')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" value="{{ old('address',$customerAddress->address) }}" class="form-control">
                                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input type="text" name="address2" value="{{ old('address2',$customerAddress->address2) }}" class="form-control">
                                @error('address2')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="zip_code">ZIP code</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code',$customerAddress->zip_code) }}" class="form-control">
                                @error('zip_code')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="po_box">P.O.Box</label>
                                <input type="text" name="po_box" value="{{ old('po_box',$customerAddress->po_box) }}" class="form-control">
                                @error('po_box')<div class="text-danger">{{ $message }}</div>@enderror
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
    $(function(){

        $('select[name="country_id"]').change(function (e) {

            let id = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{route('admin.state')}}/" + id ,
                dataType: "json",
                success: function (response) {
                    $('select[name="state_id"]').empty();
                    $('select[name="city_id"]').empty();
                    $('select[name="state_id"]').append('<option selected disabled >Choose...</option>');

                    $.each(response.state, function (index, value) {

                        let html = `<option value='${value.id}'>${value.name}</option>`;

                        $('select[name="state_id"]').append(html);

                    });
                }
            });

        });

    });
</script>

<script>
    $(function(){

        $('select[name="state_id"]').change(function (e) {

            let id = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{route('admin.city')}}/" + id ,
                dataType: "json",
                success: function (response) {
                    $('select[name="city_id"]').empty();
                    $('select[name="city_id"]').append('<option selected disabled >Choose...</option>');
                    
                    $.each(response.city, function (index, value) {

                        let html = `<option value='${value.id}'>${value.name}</option>`;

                        $('select[name="city_id"]').append(html);

                    });
                }
            });

        });

    });
</script>

@endsection
