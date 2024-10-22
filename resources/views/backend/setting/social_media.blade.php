@extends('backend.master')
@section('title')
    Edit Social Media Setting
@endsection

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Social Media Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Social Media
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
                            <div class="col-md-12">
                                <div class="card card-primary card-outline mb-4">
                                    <div class="card-header">Social Media Information <small>(optional all)</small></div>
                                    <div class="card-body">
                                        <div class="mb-3"> <label for="facebook_url" class="form-label">Facebook</label> <input type="url" name="facebook_url" placeholder="Enter facebook url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{getSetting('facebook_url')}}" id="facebook_url" aria-describedby="facebook_url" >
                                            @error('facebook_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="instagram_url" class="form-label">Instagram</label> <input type="url" placeholder="Enter instagram url" name="instagram_url" value="{{getSetting('instagram_url')}}" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" >
                                            @error('instagram_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="x_url" class="form-label">Twitter</label> <input type="url" placeholder="Enter twitter url" name="x_url" value="{{getSetting('x_url')}}" class="form-control @error('x_url') is-invalid @enderror" id="x_url" >
                                            @error('x_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="youtube_url" class="form-label">Youtube</label> <input type="url" placeholder="Enter youtube url" name="youtube_url" value="{{getSetting('youtube_url')}}" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" >
                                            @error('youtube_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="pinterest_url" class="form-label">Pinterest</label> <input type="url" placeholder="Enter pinterest url" name="pinterest_url" value="{{getSetting('pinterest_url')}}" class="form-control @error('pinterest_url') is-invalid @enderror" id="pinterest_url" >
                                            @error('pinterest_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="linkedin_url" class="form-label">LinkedIn</label> <input type="url" placeholder="Enter linkedin url" name="linkedin_url" value="{{getSetting('linkedin_url')}}" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url">
                                            @error('linkedin_url')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection
