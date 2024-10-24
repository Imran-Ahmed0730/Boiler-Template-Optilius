@extends('backend.master')
@section('title')
    @isset($item) Edit @else Add @endisset Translation
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item) Edit @else Add @endisset Translation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Translations
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
                            <div class="card-title">@isset($item) Edit @else Add @endisset Translation @isset($item) For {{$item->first()->key}} @endisset</div>
                            <a href="{{route('admin.static-translation.index')}}" class="btn btn-primary ms-auto"><i class="fa fa-list me-2"></i>View Translations</a>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form id="translation_form" action="@isset($item){{route('admin.static-translation.update')}}@else{{route('admin.static-translation.store')}}@endisset" method="post" enctype="multipart/form-data">
                            @csrf<!--begin::Body-->
                            <div class="card-body">

                                @isset($item)
                                    <input type="hidden" name="key" value="{{$item->first()->key}}">
                                @else
                                    <div class="mb-3"> <label for="key" class="form-label">Key</label>
                                        <input type="text" name="key" placeholder="Enter key" class="form-control
                                            @error('key') is-invalid @enderror"
                                               value="@isset($item){{$item->first()->key}}@else{{old('key')}}@endisset"
                                               id="key" aria-describedby="key" required>
                                        <div id="key-error" class="text-danger"></div>
                                        @error('key')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                @endisset
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
                                            <!-- English Translation -->
                                            <div class="tab-pane fade show active" id="v-pills-{{getSetting('default_language')}}" role="tabpanel" aria-labelledby="v-pills-{{getSetting('default_language')}}-tab">
                                                @php $en_translation = $item[getSetting('default_language')] ?? null; @endphp
                                                <label for="" class="form-label">Value</label>
                                                <input type="text" name="value_{{getSetting('default_language')}}" value="{{ $en_translation ? $en_translation->value : old('value_'.getSetting('default_language')) }}" placeholder="Enter value for {{getLangaugeByCode(getSetting('default_language'))}}" class="form-control" required>
                                            </div>

                                            <!-- Other Languages -->
                                            @foreach(json_decode(getSetting('site_language')) as $language)
                                                @if($language != getSetting('default_language'))
                                                    @php $translation = $item[$language] ?? null; @endphp
                                                    <div class="tab-pane fade" id="v-pills-{{$language}}" role="tabpanel" aria-labelledby="v-pills-{{$language}}-tab">
                                                        <label for="" class="form-label">Value <small>[optional]</small></label>
                                                        <input type="text" name="value_{{$language}}" value="{{ $translation ? $translation->value : old('value_'.$language) }}" placeholder="Enter value for {{getLangaugeByCode($language)}}" class="form-control">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </nav>
                                </div>

                                <fieldset class="mb-3">
                                    <legend class="col-form-label ">Included Pages</legend>
                                    <div class="">
                                        @foreach($frontend_pages as $page)
                                            @isset($item)
                                                @php
                                                    $keys = $page->translations != null ? json_decode($page->translations): null;
                                                @endphp
                                            @endisset
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" name="page[]" id="{{$page->id}}" value="{{$page->title}}"@isset($item){{$keys != null && in_array($item['en']->key, $keys)  ? 'checked':''}}@endisset> <label class="form-check-label" for="{{$page->id}}">
                                                    {{Str::title($page->title)}}
                                                </label> </div>
                                        @endforeach

                                    </div>
                                </fieldset>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer d-flex justify-content-end"> <button type="submit" id="submit_btn" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#key').on('input', function () {
                checkKey();
            });

            $('#submit_btn').click(function (event) {
                event.preventDefault();
                if(checkKey()){
                    console.log('ok');
                    $('#translation_form').submit();
                }
                else{
                    Swal.fire({
                        title: 'Warning',
                        text: 'Key cannot contain spaces or special characters. Use underscore ("_") instead.',
                        icon: 'warning',
                        showCancelButton: false,
                    });
                }
            });
            function checkKey(){
                var key = $('#key').val();
                var hasSpaceOrSpecialChar = /[\s\W]/.test(key);
                if(hasSpaceOrSpecialChar){
                    $('#key-error').text('Key cannot contain space or special characters. Use underscore ("_") instead');
                    return false;
                }
                else {
                    $('#key-error').text('');
                    return true;
                }
            }
        })
    </script>
@endpush
