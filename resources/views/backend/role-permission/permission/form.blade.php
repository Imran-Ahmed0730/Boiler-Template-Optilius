@extends('backend.master')
@section('title')
    @isset($item) Edit @else Add @endisset Permission
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item) Edit @else Add @endisset Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Permissions
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @isset($item) Edit @else Add @endisset
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header d-flex align-items-center">
                            <div class="card-title">Permission Information</div>
                            <a href="{{route('admin.permission.index')}}" class="btn btn-primary ms-auto"><i class="fa fa-list me-2"></i>View Permissions</a>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form action="@isset($item){{route('admin.permission.update')}}@else{{route('admin.permission.store')}}@endisset" method="post" enctype="multipart/form-data">
                            @csrf<!--begin::Body-->
                            <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                            <div class="card-body">

                                <div class="mb-3"> <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" placeholder="Enter permission name" class="form-control
                                            @error('name') is-invalid @enderror"
                                           value="@isset($item){{$item->name}}@else{{old('name')}}@endisset"
                                           id="name" aria-describedby="name" required>
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <fieldset class="mb-3">
                                    <legend class="col-form-label ">Status</legend>
                                    <div class="">
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status1" value="1" @isset($item){{$item->status == 1 ? 'checked':''}}@else checked @endisset> <label class="form-check-label" for="status1">
                                                Show
                                            </label> </div>
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status0" value="0" @isset($item){{$item->status == 0 ? 'checked':''}} @endisset> <label class="form-check-label" for="status0">
                                                Hide
                                            </label> </div>
                                    </div>
                                </fieldset>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

