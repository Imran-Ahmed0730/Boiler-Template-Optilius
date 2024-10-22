@extends('backend.master')
@section('title')
   @isset($item) Edit @else Add @endisset Setting
@endsection

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item) Edit @else Add @endisset Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Setting
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
                                <div class="card-title">Setting Information</div>
                                <a href="{{route('admin.setting.index')}}" class="btn btn-primary ms-auto"><i class="fa fa-list me-2"></i>View Setting Keys</a>
                            </div> <!--end::Header--> <!--begin::Form-->
                            <form action="@isset($item){{route('admin.setting.update')}}@else{{route('admin.setting.store')}}@endisset" method="post" enctype="multipart/form-data">
                                @csrf<!--begin::Body-->
                                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                                <div class="card-body">

                                    <div class="mb-3"> <label for="key" class="form-label">Key</label>
                                        <input type="text" name="key" placeholder="Enter key name" class="form-control
                                            @error('key') is-invalid @enderror"
                                               value="@isset($item){{$item->key}}@else{{old('key')}}@endisset"
                                               id="key" aria-describedby="key" required>
                                        @error('key')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3"> <label for="value" class="form-label">Value</label>
                                        <textarea rows="3" name="value" placeholder="Enter value"
                                                  class="form-control @error('value') is-invalid @enderror"
                                                  id="value" required>@isset($item){{$item->value}}@else{{old('value')}}@endisset</textarea>
                                        @error('value')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div> <!--end::Body--> <!--begin::Footer-->
                                <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button> </div> <!--end::Footer-->
                            </form>
                        </div>
                    </div>
                </div>
        </div>

    </div>
@endsection

