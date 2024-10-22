@extends('backend.master')
@section('title')
    Edit Contact Information
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Contact Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Contact
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
                        <div class="row">

                            <div class="col-md-12"> <!--begin::Quick Example-->
                                <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                    <div class="card-header">
                                        <div class="card-title">Contact Information</div>
                                    </div> <!--end::Header--> <!--begin::Form-->

                                    <div class="card-body">
                                        <div class="mb-3"> <label for="phone" class="form-label">Contact number</label>
                                            <input type="tel" name="phone" placeholder="Enter contact no" class="form-control @error('phone') is-invalid @enderror" value="{{getSetting('phone')}}" id="phone" aria-describedby="phone" required>
                                            @error('phone')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="whatsapp" class="form-label">Whatsapp</label>
                                            <input type="tel" name="whatsapp" placeholder="Enter whatsapp contact no" class="form-control @error('whatsapp') is-invalid @enderror" value="{{getSetting('whatsapp')}}" id="whatsapp" aria-describedby="whatsapp">

                                            @error('whatsapp')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter email address" class="form-control @error('email') is-invalid @enderror" value="{{getSetting('email')}}" id="email" aria-describedby="email" required>

                                            @error('email')
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
                </div>
            </form>
        </div>

    </div>
@endsection
