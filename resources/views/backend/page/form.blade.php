@extends('backend.master')
@section('title')
    @isset($item) Edit @else Add @endisset Page
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
@endpush
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item) Edit @else Add @endisset Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Pages
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
                            <div class="card-title">Page Information</div>
                            <a href="{{route('admin.page.index')}}" class="btn btn-primary ms-auto"><i class="fa fa-list me-2"></i>View Pages</a>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form action="@isset($item){{route('admin.page.update')}}@else{{route('admin.page.store')}}@endisset" method="post" enctype="multipart/form-data">
                            @csrf<!--begin::Body-->
                            <input type="hidden" name="slug" value="@isset($item){{$item->slug}}@endisset">
                            <div class="card-body">

                                <div class="mb-3"> <label for="title" class="form-label">Page Title</label>
                                    <input type="text" name="title" placeholder="Enter page name" class="form-control
                                            @error('title') is-invalid @enderror"
                                           value="@isset($item){{$item->title}}@else{{old('title')}}@endisset"
                                           id="title" aria-describedby="title" required>
                                    @error('title')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <nav>
                                        <div class="nav nav-tabs me-3" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                            <button class="nav-link active" id="{{getSetting('default_language')}}" data-bs-toggle="pill" data-bs-target="#v-pills-{{getSetting('default_language')}}" type="button" role="tab" aria-controls="v-pills-{{getSetting('default_language')}}" aria-selected="true">{{getLangaugeByCode(getSetting('default_language'))}}</button>

                                            @foreach(json_decode(getSetting('site_language')) as $language)
                                                @if($language != getSetting('default_language'))
                                                    <button class="nav-link" id="{{$language}}" data-bs-toggle="pill" data-bs-target="#v-pills-{{$language}}" type="button" role="tab" aria-controls="v-pills-{{$language}}" aria-selected="true">{{getLangaugeByCode($language)}}</button>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="tab-content w-100 mt-3" id="v-pills-tabContent">
                                            <!-- English Category -->
                                            <div class="tab-pane fade show active" id="v-pills-{{getSetting('default_language')}}" role="tabpanel" aria-labelledby="v-pills-{{getSetting('default_language')}}-tab">
                                                <div class="mb-3"> <label for="description" class="form-label">Content for {{getLangaugeByCode(getSetting('default_language'))}}</label>
                                                    <textarea rows="3" name="description" placeholder="Enter page content"
                                                              class="form-control summernote @error('description') is-invalid @enderror"
                                                              id="description" required>@isset($item){{$item->content}}@else{{old('description')}}@endisset</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Other Languages -->
                                            @foreach(json_decode(getSetting('site_language')) as $language)
                                                @if($language != getSetting('default_language'))
                                                    @php $translation = $translations[$language] ?? null; @endphp
                                                    <div class="tab-pane fade" id="v-pills-{{$language}}" role="tabpanel" aria-labelledby="v-pills-{{$language}}-tab">
                                                        <div class="mb-3"> <label for="description_{{$language}}" class="form-label">Content for {{getLangaugeByCode($language)}} <small>[optional]</small></label>
                                                            <textarea rows="3" name="description_{{$language}}" placeholder="Enter page content"
                                                                      class="form-control summernote @error('description_'.$language) is-invalid @enderror"
                                                                      id="description_{{$language}}">@isset($item){{$translation->description ?? null}}@else{{old('description_'.$language)}}@endisset</textarea>
                                                            @error('description_'.$language)
                                                            <div class="invalid-feedback" role="alert">
                                                                {{$message}}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </nav>
                                </div>

                                <fieldset class="mb-3">
                                    <legend class="col-form-label ">Status</legend>
                                    <div class="">
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status1" value="1" @isset($item){{$item->status == 1 ? 'checked':''}}@endisset> <label class="form-check-label" for="status1">
                                                Show
                                            </label> </div>
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status0" value="0" @isset($item){{$item->status == 0 ? 'checked':''}}@else checked @endisset> <label class="form-check-label" for="status0">
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
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
