@extends('backend.master')
@section('title')
    @isset($item)Edit @else Add @endisset Country
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item)Edit @else Add @endisset Country</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">
                            Country
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @isset($item)Edit @else Add @endisset
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <form action="@isset($item){{route('admin.country.update')}}@else{{route('admin.country.store')}}@endisset" method="post" enctype="multipart/form-data">
                    @csrf<!--begin::Body-->
                    <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                    <div class="col-md-12"> <!--begin::Quick Example-->
                        <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                            <div class="card-header d-flex align-items-center">
                                <div class="card-title">@isset($item)Edit @else Add @endisset Country</div>
                                @can('Country View')
                                <a href="{{route('admin.country.index')}}" class="btn btn-primary ms-auto"><i class="fa fa-list me-2"></i>View Countries</a>
                                @endcan

                            </div> <!--end::Header--> <!--begin::Form-->
                            <div class="card-body row">
                                <div class="col-md-6 mb-3"> <label for="exampleInputName1" class="form-label">Name <small class="text-danger">[Max Length = 100 characters]</small></label>  <input maxlength="100" type="text" name="name" placeholder="Enter name" class="form-control @error('name') is-invalid @enderror" value="@isset($item){{$item->name}}@else{{old('name')}}@endisset" id="exampleInputName1" aria-describedby="nameHelp" required>
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="iso2" class="form-label">Country Code <small class="text-danger">[Max Length = 2 characters]</small></label> <input maxlength="2" type="text" name="iso2" placeholder="Enter country code" class="form-control @error('iso2') is-invalid @enderror" value="@isset($item){{$item->iso2}}@else{{old('iso2')}}@endisset" id="iso2" aria-describedby="iso2" @isset($item) readonly disabled @else required @endisset>
                                    @error('iso2')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="phonecode" class="form-label">Phone Code <small class="text-danger">[Max Length = 3 characters]</small></label> <input type="number" placeholder="Enter phone code" name="phonecode" value="@isset($item){{$item->phonecode}}@else{{old('phonecode')}}@endisset" class="form-control @error('phonecode') is-invalid @enderror" id="phonecode" required>
                                    @error('phonecode')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="currency" class="form-label">Currency</label> <input type="text" name="currency" placeholder="Enter currency name" value="@isset($item){{$item->currency}}@else{{old('currency')}}@endisset" class="form-control @error('currency') is-invalid @enderror" id="currency" required>
                                    @error('currency')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="currency_name" class="form-label">Currency Code </label> <input type="text" name="currency_name" placeholder="Enter currency code" value="@isset($item){{$item->currency_name}}@else{{old('currency_name')}}@endisset" class="form-control @error('currency_name') is-invalid @enderror" id="currency_name" required>
                                    @error('currency_name')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="currency_symbol" class="form-label">Currency Symbol</label> <input type="text" placeholder="Enter currency symbol" name="currency_symbol" value="@isset($item){{$item->currency_symbol}}@else{{old('currency_symbol')}}@endisset" class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" required>
                                    @error('nid_no')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="language" class="form-label">Language</label> <input type="text" name="language" placeholder="Enter language" class="form-control @error('language') is-invalid @enderror" value="@isset($item){{$item->language}}@else{{old('language')}}@endisset" id="language" aria-describedby="language" @isset($item) readonly disabled @else required @endisset>
                                    @error('language')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="lang_code" class="form-label">Language Code <small class="text-danger">[Max Length = 10 characters]</small></label> <input maxlength="10" type="text" placeholder="Enter language code" name="lang_code" value="@isset($item){{$item->lang_code}}@else{{old('lang_code')}}@endisset" class="form-control @error('lang_code') is-invalid @enderror" id="lang_code" @isset($item) readonly disabled @else required @endisset>
                                    @error('lang_code')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3"> <label for="conversion_rate_to_tk" class="form-label">Conversion Rate (To BDT)</label> <input min="0" step=".0001" type="number" name="conversion_rate_to_tk" placeholder="Enter conversion rate" value="@isset($item){{$item->conversion_rate_to_tk}}@else{{old('conversion_rate_to_tk')}}@endisset" class="form-control @error('conversion_rate_to_tk') is-invalid @enderror" id="conversion_rate_to_tk" required>
                                    @error('conversion_rate_to_tk')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <fieldset class="col-md-6 mb-3">
                                    <legend class="col-form-label ">Status</legend>
                                    <div class="">
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status1" value="1" @isset($item){{$item->status == 1 ? 'checked':''}}@endisset> <label class="form-check-label" for="status1">
                                                Active
                                            </label> </div>
                                        <div class="form-check"> <input class="form-check-input" type="radio" name="status" id="status0" value="0" @isset($item){{$item->status == 0 ? 'checked':''}}@else checked @endisset> <label class="form-check-label" for="status0">
                                                Inactive
                                            </label> </div>
                                    </div>
                                </fieldset>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                        </div>
                    </div><!--end::Quick Example-->

                </form>
            </div>
        </div>

    </div>

@endsection
@push('js')
    <script>
        $('#currency_name').change(function () {
            var currency  = $(this).val();
            if(currency != null){
                var placeholder = '1 '+ currency +' = XX.XXXX BDT';
                $('#conversion_rate_to_tk').attr('placeholder', placeholder);
            }
        })
    </script>
@endpush
