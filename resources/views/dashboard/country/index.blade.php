@extends('layouts.master')
@section('title')
Country
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list  Country</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@include('layouts.alerts.success')
@include('layouts.alerts.errors')

@if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>@lang('site.error')</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-xl-3 col-md-4 row">
                        <div class="form-inline">
                            @can('Category-create')
                                <a
                                    data-effect="effect-scale"
                                    data-toggle="modal"
                                    href="#create"
                                    class="btn btn-sm btn-primary  mx-sm-3 mb-2"
                                    style="color:white"
                                >
                                <i class="fas fa-plus"></i>&nbsp; add
                                </a>
                            @endcan
                        </div>
                    </div>

                    <!--start Modal create -->
                    <div class="modal" id="create">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Create</h6><button aria-label="Close" class="close"
                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('admin.country.store' ) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input class="form-control"  name="name" id="name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                        <button type="submit" class="btn btn-danger">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!--end Modal create -->

                    <div class="col-xl-4 col-md-4 row align-items-center justify-content-end">
                        <form class="form-inline" action="{{ route('admin.country.index') }}" method="GET">
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
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">Status</th>
                                <th class="wd-10p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($countries as $key => $country)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->status() }}</td>
                                    <td>
                                        @can('Category-edit')
                                            <a  href="#update-{{ $country->id }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                data-effect="effect-scale"
                                                data-toggle="modal"
                                            >
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan
                                        @can('Category-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $country->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal Update -->
                                    <div class="modal" id="update-{{ $country->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Update</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.country.update',$country->id ) }}" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">name</label>
                                                            <input class="form-control" value="{{ $country->name }}" name="name" id="name" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="status" class="form-control">
                                                                <option value="1" {{ $country->status == 1 ? 'selected' : null }}>Active</option>
                                                                <option value="0" {{ $country->status == 0 ? 'selected' : null }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">back</button>
                                                        <button type="submit" class="btn btn-danger">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!--end Modal Update -->

                                <!--start Modal delete -->
                                <div class="modal" id="modaldemo-{{ $country->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('admin.country.destroy', $country->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p>Sure Delete</p><br>
                                                    <input class="form-control" value="{{ $country->name }}" name="username" id="username" type="text" readonly>
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
                                <th class="text-center" colspan="3">no-data-found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $countries->appends( request()->query() )->links() !!}
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
