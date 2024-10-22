@extends('backend.master')
@section('title')
    Edit Physical Store Setting
@endsection
@push('css')
    <style>
        iframe{
            width: 100%;
            height: 40%;
        }
    </style>
@endpush
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Physical Store Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                           Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Physical Store
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
                    <div class="col-md-12"> <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title d-flex">Physical Store Information
                                        <div class="form-check ml-2"> <input class="form-check-input" type="checkbox" name="has_shop" value="{{getSetting('address') != null ? '1':'0'}}" id="shopCheck1" {{getSetting('address') != null ? 'checked':''}}> <label class="form-check-label" for="gridCheck1">
                                            </label> </div></div>
                                </div> <!--end::Header--> <!--begin::Form-->

                                <div class="card-body" id="shop-container">
                                    @if(getSetting('address') != null)
                                        <div class="mb-3"> <label for="address" class="form-label">Shop Address</label>
                                            <textarea rows="5" name="address" placeholder="Enter shop address" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" >{{getSetting('address')}}</textarea>

                                            @error('address')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="address" class="form-label">Shop Location</label>
                                            <textarea rows="5" name="shop_map_location" placeholder="Enter shop location (embedded)" class="form-control @error('shop_map_location') is-invalid @enderror" id="shop_map_location" aria-describedby="shop_map_location" >{{getSetting('shop_map_location')}}</textarea>
                                            @error('shop_map_location')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            @if(getSetting('shop_map_location') != null)
                                                <div class="mt-2">
                                                    {!! getSetting('shop_map_location') !!}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3"> <label for="opening_time" class="form-label">Opening Time</label> <input type="time" name="opening_time" placeholder="Enter opening time" class="form-control @error('opening_time') is-invalid @enderror" value="{{getSetting('opening_time')}}" id="opening_time" aria-describedby="opening_time" >
                                            @error('opening_time')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="closing_time" class="form-label">Closing time</label> <input type="time" name="closing_time" placeholder="Enter closing time" class="form-control @error('closing_time') is-invalid @enderror" value="{{getSetting('closing_time')}}" id="closing_time" aria-describedby="closing_time" >
                                            @error('closing_time')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3"> <label for="" class="form-label">Closed on</label>
                                            <div class="row">
                                                @php $closed_on = json_decode(getSetting('closed_on')) @endphp
                                                <div class="col-md-6 col-6">
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="1" id="gridCheck1" {{in_array('1', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck1">
                                                            Saturday
                                                        </label> </div>
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="2" id="gridCheck2" {{in_array('2', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck2">
                                                            Sunday
                                                        </label> </div>
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="3" id="gridCheck3" {{in_array('3', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck3">
                                                            Monday
                                                        </label> </div>
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="4" id="gridCheck4" {{in_array('4', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck4">
                                                            Tuesday
                                                        </label> </div>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="5" id="gridCheck5" {{in_array('5', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck5">
                                                            Wednesday
                                                        </label> </div>
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="6" id="gridCheck6" {{in_array('6', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck6">
                                                            Thursday
                                                        </label> </div>
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="7" id="gridCheck7" {{in_array('7', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck7">
                                                            Friday
                                                        </label> </div>
                                                </div>
                                            </div>
                                            @error('closed_on')
                                            <div class="invalid-feedback" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    @endif
                                </div> <!--end::Body--> <!--begin::Footer-->
                                <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                            </div>
                        </div><!--end::Quick Example-->
                </div>
            </form>
        </div>

    </div>
@endsection
@push('js')

    <script>
        $('#shopCheck1').click(function () {
            function shopVerify() {
                var has_shop = $('#shopCheck1').val();
                if(has_shop == 1){
                    $('#shopCheck1').val(0);
                    $('#shop-container').empty();
                }
                else{
                    $('#shopCheck1').val(1);
                    var html = `
                <div class="mb-3"> <label for="address" class="form-label">Shop Address</label>
                                        <textarea rows="5" name="address" placeholder="Enter shop address" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" >{{getSetting('address')}}</textarea>

                                        @error('address')
                    <div class="invalid-feedback" role="alert">
{{$message}}
                    </div>
@enderror
                    </div>
                    <div class="mb-3"> <label for="opening_time" class="form-label">Opening Time</label> <input type="time" name="opening_time" placeholder="Enter opening time" class="form-control @error('opening_time') is-invalid @enderror" value="{{getSetting('opening_time')}}" id="opening_time" aria-describedby="opening_time" >
                                        @error('opening_time')
                    <div class="invalid-feedback" role="alert">
{{$message}}
                    </div>
@enderror
                    </div>
                    <div class="mb-3"> <label for="closing_time" class="form-label">Closing time</label> <input type="time" name="closing_time" placeholder="Enter closing time" class="form-control @error('closing_time') is-invalid @enderror" value="{{getSetting('closing_time')}}" id="closing_time" aria-describedby="closing_time" >
                                        @error('closing_time')
                    <div class="invalid-feedback" role="alert">
{{$message}}
                    </div>
@enderror
                    </div>
                    <div class="mb-3"> <label for="closed_on" class="form-label">Closed on</label>
                        <div class="row">
@php  $closed_on = json_decode(getSetting('closed_on')); if($closed_on == null){$closed_on = [];} @endphp
                    <div class="col-md-6 col-6">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="1" id="gridCheck1" {{in_array('1', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck1">
                                                        Saturday
                                                    </label> </div>
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="2" id="gridCheck2" {{in_array('2', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck2">
                                                        Sunday
                                                    </label> </div>
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="3" id="gridCheck3" {{in_array('3', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck3">
                                                        Monday
                                                    </label> </div>
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="4" id="gridCheck4" {{in_array('4', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck4">
                                                        Tuesday
                                                    </label> </div>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="5" id="gridCheck5" {{in_array('5', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck5">
                                                        Wednesday
                                                    </label> </div>
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="6" id="gridCheck6" {{in_array('6', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck6">
                                                        Thursday
                                                    </label> </div>
                                                <div class="form-check"> <input class="form-check-input" type="checkbox" name="closed_on[]" value="7" id="gridCheck7" {{in_array('7', $closed_on) ? 'checked':''}}> <label class="form-check-label" for="gridCheck7">
                                                        Friday
                                                    </label> </div>
                                            </div>
                                        </div>
                                        @error('closed_on')
                    <div class="invalid-feedback" role="alert">
{{$message}}
                    </div>
@enderror
                    </div>
`;
                    $('#shop-container').html(html);
                }
            }
            shopVerify();
        })
    </script>
@endpush
