@extends('layouts.master')
@section('title')
Tag
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Admins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                list  Tag</span>
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
                            @can('tag-create')
                                <a
                                    data-effect="effect-scale"
                                    data-toggle="modal"
                                    href="#create"
                                    class="btn btn-sm btn-primary  mx-sm-3 mb-2"
                                    style="color:white"
                                >
                                <i class="fas fa-plus"></i>&nbsp; Add
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
                                <form action="{{ route('admin.tag.store' ) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input class="form-control"  name="name" id="name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">status</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="">--</option>
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
                        <form class="form-inline" action="{{ route('admin.tag.index') }}" method="GET">
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
                                <td class="wd-15p border-bottom-0">Products count</td>
                                <th class="wd-10p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $key => $tag)

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->status() }}</td>
                                    <td>{{ $tag->products_count }}</td>
                                    <td>
                                        @can('tag-edit')
                                            <a  href="#update-{{ $tag->id }}"
                                                class="btn btn-sm btn-info"
                                                title="edit"
                                                data-effect="effect-scale"
                                                data-toggle="modal"
                                            >
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan
                                        @can('tag-delete')
                                            <a class="modal-effect btn btn-sm btn-danger"
                                                data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="#modaldemo-{{ $tag->id }}"
                                                title="delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>

                                <!--start Modal Update -->
                                    <div class="modal" id="update-{{ $tag->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Update</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.tag.update',$tag->id ) }}" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">name</label>
                                                            <input class="form-control"  name="name" id="name" type="text" value="{{$tag->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">status</label>
                                                            <select name="status" class="form-control" id="status">
                                                                <option value="">--</option>
                                                                <option value="1" {{$tag->status == 1 ? 'selected': ''}}>Active</option>
                                                                <option value="0" {{$tag->status == 0 ? 'selected': ''}}>Inactive</option>
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
                                <div class="modal" id="modaldemo-{{ $tag->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close"
                                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('admin.tag.destroy', 'test') }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p>Sure Delete</p><br>
                                                    <input type="hidden" value="{{ $tag->id }}" name="id" id="user_id">
                                                    <input class="form-control" value="{{ $tag->name }}" name="username" id="username" type="text" readonly>
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

                {!! $tags->appends( request()->query() )->links() !!}
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
