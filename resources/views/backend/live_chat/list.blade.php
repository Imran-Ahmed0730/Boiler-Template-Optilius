@extends('backend.master')
@section('title')
    View Chat List
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
                    <h1 class="mb-0">View Chat List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Live Chats
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
                            <h3 class="card-title mb-0">View Live Chat List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Assigned To</th>
                                    <th style="width: 40px">Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $key => $item)
                                    <tr class="align-middle">
                                        <td>{{++$key}}.</td>
                                        <td>{{$item->user->name ?? ''}}</td>
                                        <td>
                                            <a href="mailto:{{$item->user->email ?? ''}}">{{$item->user->email ?? ''}}</a>
                                        </td>
                                        <td>
                                            {{$item->phone ?? ''}}
                                        </td>
                                        <td>
                                            {{$item->assigned_to != null ? $item->staff->name ?? 'N/A':'None'}}
                                            <!-- Button trigger modal -->
                                            @can('Live Chat Assignment')
                                                <small class="cursor-pointer text-decoration-underline text-primary assign_btn" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Click to @if($item->assigned_to != null) Change  @else Add  @endif
                                                </small>
                                            @endcan
                                        </td>
                                        <td>
                                            <span class="p-2 badge text-bg-{{$item->status == 1 ? 'success': 'danger'}}">{{$item->status == 1 ? 'Active':'Closed'}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @can('Live Chat View')
                                                <a href="{{route('admin.live-chat.chat', $item->id)}}" class="btn btn-primary me-2" title="Chat"><i class="fa fa-comments"></i></a>
                                                @endcan
                                                @if($item->status == 1)
                                                    @can('Live Chat Close')
                                                        <a href="{{route('admin.live-chat.close', $item->id)}}" title="Close" class="btn btn-danger me-2" id="close-button"
                                                           data-url="{{ route('admin.live-chat.close', $item->id) }}"><i class="fa fa-lock"></i></a>
                                                    @endcan
                                                @else
                                                    @can('Live Chat Open')
                                                        <a href="{{route('admin.live-chat.open', $item->id)}}" title="Open" class="btn btn-success me-2">
                                                            <i class="fa fa-lock-open"></i></a>
                                                    @endcan
                                                @endif


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <!-- Modal -->
                        @can('Live Chat Assignment')
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assign to Staff</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('admin.live-chat.assign')}}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                                <input type="hidden" name="id" id="id" value="">
                                                <div class="form-group mb-3"><label for="staff_id" class="form-control-label">Assigned To </label><select name="staff_id"
                                                                                                                    id="staff_id"
                                                                                                                    class="form-control" required>
                                                            <option value="">Select Staff</option>
                                                            <option value="0">None</option>
                                                            @foreach($staffs as $staff)
                                                                <option value="{{$staff->user_id}}">{{$staff->name}}</option>
                                                            @endforeach
                                                        </select></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endcan
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
        $(document).ready(function () {
            $('#close-button').on('click', function (event) {
                event.preventDefault(); // Prevent the default action (i.e., navigating to the route)
                var url = $(this).data('url'); // Get the route URL from the data attribute

                // Display the SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to close this support ticket?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, close it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, redirect to the URL
                        window.location.href = url;
                    }
                });
            });
        });

    </script>
    <script>
        $('.assign_btn').click(function () {
            var support_id = $(this).data('id');
            $('#id').val(support_id);
        })
    </script>

@endpush
