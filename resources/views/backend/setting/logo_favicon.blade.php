@extends('backend.master')
@section('title')
    Edit Logo & Favicon Setting
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Logo & Favicon Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            General
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
                                    <div class="card-title">Logos & Favicon</div>
                                </div> <!--end::Header--> <!--begin::Form-->
                                <div class="card-body">

                                    <div class="mb-3"><label for="site_favicon" class="form-label">Favicon</label><input type="file" name="site_favicon" class="form-control" id="site_favicon" accept="image/*">
                                        @error('site_favicon')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        @if(getSetting('site_favicon') == null)
                                            <img src="{{asset('backend')}}/assets/img/default-150x150.png" id="previewSiteFavicon" width="100px" class="my-2  " alt="">
                                        @else
                                            <img src="{{asset(getSetting('site_favicon'))}}" id="previewSiteFavicon" width="100px" class="my-2  " alt="">

                                        @endif
                                    </div>
                                    <div class="mb-3"><label for="site_logo" class="form-label">Logo</label><input type="file" name="site_logo" class="form-control" id="site_logo" accept="image/*">
                                        @error('site_logo')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        @if(getSetting('site_logo') == null)
                                            <img src="{{asset('backend')}}/assets/img/default-150x150.png" id="previewSiteLogo" width="100px" class="my-2  " alt="">
                                        @else
                                            <img src="{{asset(getSetting('site_logo'))}}" id="previewSiteLogo" width="100px" class="my-2  " alt="">

                                        @endif
                                    </div>
                                    <div class="mb-3"><label for="site_dark_logo" class="form-label">Dark logo</label>
                                        <input type="file" name="site_dark_logo" class="form-control" id="site_dark_logo" accept="image/*">
                                        @error('site_dark_logo')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        @if(getSetting('site_dark_logo') == null)
                                            <img src="{{asset('backend')}}/assets/img/default-150x150.png" id="previewSiteLogoDark" width="100px" class="my-2  " alt="">
                                        @else
                                            <img src="{{asset(getSetting('site_dark_logo'))}}" id="previewSiteLogoDark" width="100px" class="my-2  " alt="">

                                        @endif
                                    </div>
                                    <div class="mb-3"><label for="site_footer_logo" class="form-label">Footer logo</label><input type="file" name="site_footer_logo" class="form-control" id="site_footer_logo" accept="image/*">
                                        @error('site_footer_logo')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        @if(getSetting('site_footer_logo') == null)
                                            <img src="{{asset('backend')}}/assets/img/default-150x150.png" id="previewSiteFooterLogo" width="100px" class="my-2  " alt="">
                                        @else
                                            <img src="{{asset(getSetting('site_footer_logo'))}}" id="previewSiteFooterLogo" width="100px" class="my-2  " alt="">

                                        @endif
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
@push('js')
    <script>
        // jQuery function to preview the image
        $(document).ready(function(){
            $('#site_favicon').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#previewSiteFavicon').attr('src', e.target.result); // Change the src of img tag
                }
                reader.readAsDataURL(this.files[0]); // Read the file as a data URL
            });
            $('#site_logo').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#previewSiteLogo').attr('src', e.target.result); // Change the src of img tag
                }
                reader.readAsDataURL(this.files[0]); // Read the file as a data URL
            });
            $('#site_dark_logo').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#previewSiteLogoDark').attr('src', e.target.result); // Change the src of img tag
                }
                reader.readAsDataURL(this.files[0]); // Read the file as a data URL
            });
            $('#site_footer_logo').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#previewSiteFooterLogo').attr('src', e.target.result); // Change the src of img tag
                }
                reader.readAsDataURL(this.files[0]); // Read the file as a data URL
            });
        });
    </script>
@endpush
