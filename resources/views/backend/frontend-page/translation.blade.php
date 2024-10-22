@extends('backend.master')
@section('title')
    View Translations
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
                    <h1 class="mb-0">View Translations</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a>Frontend Page</a></li>
                        <li class="breadcrumb-item" >
                            Translations
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
                            <h3 class="card-title mb-0">View Translations of {{Str::title($page->title)}}</h3>
                            @can('Static Translation Key Add')
                            <a href="{{route('admin.static-translation.create')}}" data-bs-toggle="tooltip" title="Add Page" class="btn btn-primary ms-auto">
                                <i class="fa fa-plus me-2"></i> Add Translation
                            </a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Keyword</th>
                                    @foreach(json_decode(getSetting('site_language')) as $language)
                                        <th>{{getLangaugeByCode($language)}}</th>
                                    @endforeach
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 0; @endphp
                               @if($items != null)
                                   @foreach($items as $key => $item_group)
                                       <tr class="align-middle">
                                           <td>{{++$counter}}.</td>
                                           <td>{{$key}}</td>
                                           @foreach($item_group as $item)
                                               <td>{{$item->value}}</td>
                                           @endforeach
                                           <td>
                                               @can('Static Translation Update')
                                                   <a href="{{route('admin.static-translation.edit', $key)}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                               @endcan
                                           </td>
                                       </tr>
                                   @endforeach
                               @else
                                   <td colspan="{{count(json_decode(getSetting('site_language')))+3}}" class="text-muted text-center">No Word Added</td>
                               @endif
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
    <script>
        $('.content-btn').click(function () {
            var content = $(this).data('content');  // Get content from data attribute
            $('#contentModal .modal-body').html(content);  // Set content inside modal
        });
    </script>

@endpush
