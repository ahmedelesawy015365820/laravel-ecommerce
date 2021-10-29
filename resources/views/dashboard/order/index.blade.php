@extends('layouts.master')
@section('title')
Orders
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list Orders</span>
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
                    <div class=" col-md-12 row align-items-center justify-content-end">
                        <form class="form-inline" action="{{ route('admin.order.index') }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-primary mb-2">search</button>
                            <div class="form-group mb-2  mx-sm-3 col-4">
                                <select name="status" class="form-control form-control-sm">
                                    <option>--status--</option>
                                    @foreach ($status_arrays as $key => $value)
                                    <option value="{{$key}}"
                                        {{request()->status == $key ? 'selected' : ''}}>
                                        {{$value}}
                                    </option>
                                    @endforeach
                                </select>
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
                                <th class="wd-10p border-bottom-0">Ref ID</th>
                                <th class="wd-10p border-bottom-0">Payment method</th>
                                <th class="wd-10p border-bottom-0">Amount</th>
                                <th class="wd-10p border-bottom-0">Status</th>
                                <th class="wd-10p border-bottom-0">Created date</th>
                                <th class="wd-10p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Orders as $key => $order)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->customer->full_name }}</td>
                                    <td>{{ $order->ref_id }}</td>
                                    <td>{{ $order->payment_method->name}}</td>
                                    <td>{{ $order->currency() . $order->total }}</td>
                                    <td>{!! $order->statusWithLabel() !!}</td>
                                    <td>{{ $order->created_at->format('Y-m-d h:i a') }}</td>
                                    <td>
                                        @can('order-edit')
                                            <a href="{{ route('admin.order.show', $order->id) }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                >
                                                show
                                                <i class="typcn typcn-document-text"></i>
                                            </a>
                                        @endcan
                                        @can('order-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-user_id=""
                                                data-username=""
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $order->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal delete -->
                                    <div class="modal" id="modaldemo-{{ $order->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>Sure Delete</p><br>
                                                        <input type="hidden" value="{{ $order->id }}" name="id" id="order_id">
                                                        <input class="form-control" value="{{ $order->ref_id }}" name="order" id="username" type="text" readonly>
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
                                <th class="text-center" colspan="9">No Data Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $Orders->appends( request()->query() )->links() !!}
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
