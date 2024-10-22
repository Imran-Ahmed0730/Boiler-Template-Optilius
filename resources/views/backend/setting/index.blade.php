@extends('backend.master')
@section('title')
    Edit Site Setting
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Site Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Site
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
                                        <div class="card-title">Site Information</div>
                                    </div> <!--end::Header--> <!--begin::Form-->

                                    <div class="card-body">
                                        <div class="mb-3"> <label for="site_name" class="form-label">Site name</label> <input type="text" name="site_name" placeholder="Enter site name" class="form-control @error('site_name') is-invalid @enderror" value="{{getSetting('site_name')}}" id="site_name" aria-describedby="site_name" required>
                                            @error('site_name')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="business_name" class="form-label">Business name</label> <input type="text" name="business_name" placeholder="Enter business name" class="form-control @error('business_name') is-invalid @enderror" value="{{getSetting('business_name')}}" id="business_name" aria-describedby="business_name" required>
                                            @error('business_name')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="short_bio" class="form-label">Short bio</label> <textarea rows="3" name="short_bio" placeholder="Enter short bio" class="form-control @error('short_bio') is-invalid @enderror" id="short_bio" required>{{getSetting('short_bio')}}</textarea>
                                            @error('short_bio')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="site_url" class="form-label">Site url</label> <input type="url" name="site_url" placeholder="Enter site_url" class="form-control @error('site_url') is-invalid @enderror" value="{{getSetting('site_url')}}" id="site_url" aria-describedby="site_url">
                                            @error('site_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="meta_description" class="form-label">Meta description</label> <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" required>{{getSetting('meta_description')}}</textarea>
                                            @error('meta_description')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div> <!--end::Body--> <!--begin::Footer-->
                                </div>
                            </div><!--end::Quick Example-->
                            @if(Auth::user()->hasRole('Super Admin'))
                            <div class="col-md-12">
                                <div class="card card-primary card-outline mb-4">
                                    <div class="card-header">Developer Information <small></small></div>
                                    <div class="card-body">
                                        <div class="mb-3"> <label for="developed_by" class="form-label">Developed by</label> <input type="text" name="developed_by" placeholder="Enter name of the developer" class="form-control @error('developed_by') is-invalid @enderror" value="{{getSetting('developed_by')}}" id="developed_by" aria-describedby="developed_by" required>
                                            @error('developed_by')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="developed_by_url" class="form-label">Website url</label> <input type="url" placeholder="Enter developer's website's url" name="developed_by_url" value="{{getSetting('developed_by_url')}}" class="form-control @error('developed_by_url') is-invalid @enderror" id="developed_by_url"  required>
                                            @error('developed_by_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-primary ">Update</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>

    </div>
@endsection

