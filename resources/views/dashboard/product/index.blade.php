@extends('layouts.master')
@section('title')
Product
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list Product</span>
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
                    <div class="col-xl-3 col-xl-3 col-md-4 row">
                        <div class="form-inline">
                            @can('product-create')
                                <a href="{{ route('admin.product.create') }}"
                                class="btn btn-sm btn-primary  mx-sm-3 mb-2"
                                style="color:white">
                                <i class="fas fa-plus"></i>&nbsp; add
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 row align-items-center justify-content-end">
                        <form class="form-inline" action="{{ route('admin.product.index') }}" method="GET">
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
                                <th class="wd-20p border-bottom-0">Image</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-20p border-bottom-0">Quantity</th>
                                <th class="wd-20p border-bottom-0">Price</th>
                                <th class="wd-20p border-bottom-0">Tags</th>
                                <th class="wd-15p border-bottom-0">Status</th>
                                <th class="wd-20p border-bottom-0">Feature</th>
                                <th class="wd-15p border-bottom-0">Created at</th>
                                <th class="wd-10p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Products as $key => $Product)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img width="60px" height="60px" src="{{ asset("assets/img/products/{$Product->firstMedia->file_name}")}}" alt="{{ $Product->name }}"></td>
                                    <td>{{ $Product->name }}</td>
                                    <td>{{ $Product->quantity }}</td>
                                    <td>{{ $Product->price }}</td>
                                    <td>{{ $Product->tags->pluck('name')->join(', ') }}</td>
                                    <td>{{ $Product->status() }}</td>
                                    <td>{{ $Product->featuer() }}</td>
                                    <td>{{ $Product->created_at }}</td>
                                    <td>
                                        @can('product-edit')
                                            <a href="{{ route('admin.product.edit', $Product->id) }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                >
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan
                                        @can('product-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $Product->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal delete -->
                                    <div class="modal" id="modaldemo-{{ $Product->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.product.destroy', 'test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>Sure Delete</p><br>
                                                        <input type="hidden" value="{{ $Product->id }}" name="id" id="user_id">
                                                        <input class="form-control" value="{{ $Product->name }}" name="username" id="username" type="text" readonly>
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
                                <th class="text-center" colspan="10">no-data-found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $Products->appends( request()->query() )->onEachSide(1)->links() !!}
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
