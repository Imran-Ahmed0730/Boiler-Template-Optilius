@extends('backend.master')
@section('title')
    View Country
@endsection
@push('css')
    <!-- DataTables CSS and Bootstrap 5 Integration -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">View Country</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Country
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
                            <h3 class="card-title mb-0">View Country</h3>
                            @can('Country Add')
                                <a href="{{route('admin.country.create')}}" data-bs-toggle="tooltip" title="Add Country" class="btn btn-primary ms-auto">
                                    <i class="fa fa-plus me-2"></i> Add Country
                                </a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Currency</th>
                                    <th>Conversion Rate (BDT)</th>
                                    <th>Language</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $key => $item)
                                    <tr class="align-middle">
                                        <td>{{$key+1}}.</td>
                                        <td>
                                            <span class="flag-icon flag-icon-{{Str::lower($item->iso2)}}"></span>
                                        </td>
                                        <td>{{Str::title($item->name)}}</td>
                                        <td>{{$item->currency_name}} ({{$item->currency}} {{$item->currency_symbol}})</td>
                                        <td>1 {{$item->currency}} = {{$item->conversion_rate_to_tk}} TK</td>
                                        <td>{{$item->language}}</td>
                                        <td>
                                            @can('Country Status Change')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-switch" type="checkbox" role="switch"
                                                           data-module="country" data-id="{{ $item->id }}"
                                                        {{ $item->status == 1 ? 'checked' : '' }}>                                                <label class="form-check-label" for="status"></label>
                                                </div>
                                            @else
                                                <span class="p-2 badge text-bg-{{$item->status == 1 ? 'success': 'danger'}}">{{$item->status == 1 ? 'Active':'Inactive'}}</span>
                                            @endcan
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @can('Country Update')
                                                    <a href="{{route('admin.country.edit', $item->id)}}" title="Edit" class="btn btn-primary me-2"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('Country Delete')
                                                    <form action="{{route('admin.country.delete')}}" method="post">
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
