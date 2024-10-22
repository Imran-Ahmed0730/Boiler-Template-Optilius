@extends('backend.master')
@section('title')
    View Role
@endsection
@push('css')
    <!-- DataTables CSS and Bootstrap 5 Integration -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">View Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Roles
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            View
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">View Roles</h3>
                            @can('Role Add')
                            <a href="{{route('admin.role.create')}}" data-bs-toggle="tooltip" title="Add Role" class="btn btn-primary ms-auto">
                                <i class="fa fa-plus me-2"></i> Add Role
                            </a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i= 1; @endphp
                                @foreach($items as $key => $item)
                                    <tr class="align-middle">
                                        @if($item->name == 'Super Admin' || $item->name == 'admin')
                                            @if(!auth()->user()->hasRole('Super Admin'))
                                                @continue
                                            @endif
                                        @endif
                                        <td>{{$i++}}.</td>
                                        <td>{{Str::title($item->name)}}</td>
                                        <td>
                                            <div class="d-flex">
                                                @can('Role Permission Add/Update')
                                                <a href="{{route('admin.role.accessibility.assign', $item->id)}}" title="Add/Edit Permission" class="btn btn-warning me-2"><i class="fa fa-lock"></i></a>
                                                @endcan
                                                @can('Role Update')
                                                <a href="{{route('admin.role.edit', $item->id)}}" title="Edit" class="btn btn-primary me-2"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('Role Delete')
                                                <form action="{{route('admin.role.delete')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <button class="btn btn-danger btn-delete" title="Remove"><i class="fa fa-trash"></i></button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
@push('js')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        })
    </script>
@endpush
