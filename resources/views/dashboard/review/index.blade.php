@extends('layouts.master')
@section('title')
Review
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list Review</span>
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
                    <div class="col-md-12 row align-items-center justify-content-end">
                        <form class="form-inline" action="{{ route('admin.review.index') }}" method="GET">
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
                                <th >#</th>
                                <th class="wd-10p border-bottom-0">Name</th>
                                <th class="wd-10p border-bottom-0" >Message</th>
                                <th class="wd-10p border-bottom-0">Rating</th>
                                <th class="wd-10p border-bottom-0">Product</th>
                                <th class="wd-10p border-bottom-0">Status</th>
                                <th class="wd-10p border-bottom-0">Created at</th>
                                <th class="wd-10p border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ProductReviews as $key => $ProductReview)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $ProductReview->name }}<br>
                                        {{ $ProductReview->email }}<br>
                                        <small>{!! $ProductReview->customer_id != '' ? $ProductReview->customers->full_name : '' !!}</small>
                                    </td>
                                    <td>
                                        {{ $ProductReview->title }}
                                    </td>
                                    <td><span class="badge badge-success">{{ $ProductReview->rating }}</span></td>
                                    <td>{{ $ProductReview->products->name }}</td>
                                    <td>{{ $ProductReview->status() }}</td>
                                    <td>{{ $ProductReview->created_at }}</td>
                                    <td>
                                        @can('review-show')
                                        <a class="btn btn-success btn-sm" style="margin-bottom: 5px"
                                        href="{{ route('admin.review.show', $ProductReview->id) }}"
                                        >
                                        show
                                        <i class="typcn typcn-document-text"></i>
                                        </a>
                                        @endcan
                                        @can('review-edit')
                                            <a href="{{ route('admin.review.edit', $ProductReview->id) }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                >
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan
                                        @can('review-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-user_id=""
                                                data-username=""
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $ProductReview->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal delete -->
                                    <div class="modal" id="modaldemo-{{ $ProductReview->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.review.destroy', 'test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>Sure Delete</p><br>
                                                        <input type="hidden" value="{{ $ProductReview->id }}" name="id" id="user_id">
                                                        <input class="form-control" value="{{ $ProductReview->name }}" name="username" id="username" type="text" readonly>
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
                                <th class="text-center" colspan="7">no-data-found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $ProductReviews->appends( request()->query() )->links() !!}
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
