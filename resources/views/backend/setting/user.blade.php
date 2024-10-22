@extends('backend.master')
@section('title')
    Edit User Setting
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">User Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">
            @include('backend.include.setting_menu')
            <!-- /.navbar -->
            <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
                @csrf<!--begin::Body-->
                <div class="row mt-3 g-4">
                    <div class="col-md-12">
                        <div class="col-md-12"> <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">User Settings</div>
                                </div> <!--end::Header--> <!--begin::Form-->

                                <div class="card-body">
                                    <div class="mb-3"> <label for="free_delivery_above" class="form-label">Free delivery above</label>
                                        <input type="number" name="free_delivery_above" placeholder="Enter free delivery amount minimum limit" class="form-control @error('free_delivery_above') is-invalid @enderror" value="{{getSetting('free_delivery_above')}}" min="0" id="free_delivery_above" aria-describedby="free_delivery_above">
                                        @error('free_delivery_above')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3"> <label for="user_verification" class="form-label">User verification</label>
                                        <select name="user_verification" class="form-control @error('user_verification') is-invalid @enderror"
                                                id="user_verification" aria-describedby="user_verification" required>
                                            <option value="0" {{getSetting('user_verification' == '0' ? 'selected' : '')}}>Off</option>
                                            <option value="1" {{getSetting('user_verification' == '1' ? 'selected' : '')}}>Email verification</option>
                                            <option value="2" {{getSetting('user_verification' == '2' ? 'selected' : '')}}>Phone verification</option>
                                        </select>
                                        @error('user_verification')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3"> <label for="user_verification" class="form-label">Guest account</label>
                                        <select name="guest_account" class="form-control @error('guest_account') is-invalid @enderror"
                                                id="guest_account" aria-describedby="guest_account" required>
                                            <option value="0" selected>Off</option>
                                            <option value="1" {{getSetting('guest_account' == '1' ? 'selected' : '')}}>On</option>
                                        </select>
                                        @error('user_verification')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div> <!--end::Body--> <!--begin::Footer-->
                                <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                            </div>
                        </div><!--end::Quick Example-->

                    </div>


                </div>
            </form>
        </div>

    </div>
@endsection
