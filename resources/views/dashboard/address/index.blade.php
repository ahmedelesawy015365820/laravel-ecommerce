@extends('layouts.master')
@section('title')
Address
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list Address</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@include('layouts.alerts.success')
@include('layouts.alerts.errors')

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row justify-content-between">
                    {{-- <div class="col-xl-3 col-xl-3 col-md-4 row">
                        <div class="form-inline">
                            @can('address-create')
                                <a href="{{ route('admin.customer_address.create') }}"
                                class="btn btn-sm btn-primary  mx-sm-3 mb-2"
                                style="color:white">
                                <i class="fas fa-plus"></i>&nbsp; add
                                </a>
                            @endcan
                        </div>
                    </div> --}}
                    <div class=" col-md-12 row align-items-center justify-content-end">
                        <form class="form-inline" action="{{ route('admin.customer_address.index') }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-primary mb-2">search</button>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text"
                                name="search"
                                class="form-control form-control-sm"
                                value="{{ request()->search }}"
                                placeholder="search"
                              >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover"  style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-10p border-bottom-0">Customer</th>
                                <th class="wd-10p border-bottom-0">Title</th>
                                <th class="wd-10p border-bottom-0">Shipping Info</th>
                                <th class="wd-10p border-bottom-0">Location</th>
                                <th class="wd-10p border-bottom-0">Address</th>
                                <th class="wd-10p border-bottom-0">Zip code</th>
                                <th class="wd-10p border-bottom-0">POBox</th>
                                <th class="wd-10p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($addresses as $key => $address)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="{{-- route('admin.customers.show', $address->user_id) --}}">{{ $address->customer->full_name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{-- route('admin.customer_addresses.show', $address->id) --}}">{{ $address->address_title }}</a><br>
                                        <small class="text-gray"><b>{{ $address->defaultAddress() }}</b></small>
                                    </td>
                                    <td>
                                         {{ $address->first_name . ' ' . $address->last_name }}<br>
                                         <b><small >{{ $address->email }}<br/>{{ $address->mobile }}</small></b>
                                    </td>
                                    <td>{{ $address->country->name . ' - ' . $address->state->name .' - ' . $address->city->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>{{ $address->zip_code }}</td>
                                    <td>{{ $address->po_box }}</td>
                                    <td>
                                        @can('address-edit')
                                            <a href="{{ route('admin.customer_address.edit', $address->id) }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                >
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan
                                        @can('address-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-user_id=""
                                                data-username=""
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $address->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal delete -->
                                    <div class="modal" id="modaldemo-{{ $address->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.customer_address.destroy', $address->id) }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>Sure Delete</p><br>
                                                        <input type="hidden" value="{{ $address->id }}" name="id" id="user_id">
                                                        <input class="form-control" value="{{ $address->customer->full_name }}" name="username" id="username" type="text" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">back</button>
                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!--end Modal delete -->

                            @empty
                            <tr>
                                <th class="text-center" colspan="9">no-data-found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $addresses->appends( request()->query() )->links() !!}
            </div>
        </div>
    </div>
    <!--/div-->


</div>


</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

@endsection
