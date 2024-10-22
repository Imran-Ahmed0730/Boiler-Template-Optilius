@extends('backend.master')
@section('title')
    Profile Edit
@endsection
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">General Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            General Form
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-6"> <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Profile Edit</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf<!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3"> <label for="exampleInputName1" class="form-label">Name</label> <input type="text" name="name" placeholder="Enter name" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name}}" id="exampleInputName1" aria-describedby="nameHelp" required>
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3"> <label for="exampleInputEmail1" class="form-label">Email address</label> <input type="email" name="email" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3"> <label for="exampleInputPhone1" class="form-label">Phone <small>[optional]</small></label> <input type="tel" placeholder="Enter contact no" name="phone" value="{{Auth::user()->phone}}" class="form-control @error('phone') is-invalid @enderror" id="exampleInputPhone1" required>
                                    @error('phone')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3"> <label for="exampleInputAddress1" class="form-label">Address <small>[optional]</small></label> <textarea rows="3" name="address" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror" id="exampleInputAddress1" required>{{Auth::user()->address}}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3"><label for="inputGroupFile02" class="form-label">Profile Image <small>[optional]</small></label><input type="file" name="image" class="form-control" id="inputGroupFile02">
                                    @error('image')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @if(Auth::user()->image == null)
                                        <img src="{{asset('backend')}}/assets/img/user1-128x128.jpg" id="previewImage" width="128px" class="my-2 rounded-circle " alt="">
                                    @else
                                        <img src="{{asset(Auth::user()->image)}}" id="previewImage" width="128px" class="my-2 rounded-circle " alt="">

                                    @endif
                                </div>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">Update</button> </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div>
                </div><!--end::Quick Example-->
                <div class="col-md-6"> <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Password Update</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form action="{{route('admin.password.update')}}" method="post">
                            @csrf<!--begin::Body-->
                            <input type="hidden" name="tab" value="3">
                            <div class="card-body">
                                <div class="mb-3"> <label for="exampleInputPassword3" class="form-label">Current Password</label> <input type="password" minlength="8" name="current_password" placeholder="Enter current password" class="form-control @error('current_password') is-invalid @enderror" id="exampleInputPassword3" aria-describedby="emailHelp" required>
                                    @error('current_password')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3"> <label for="exampleInputPassword1" class="form-label">New Password</label> <input type="password" minlength="8" name="password" placeholder="Enter new password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                                    @error('password')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3"> <label for="exampleInputPassword2" class="form-label">Confirm Password</label> <input type="password" minlength="8" name="password_confirmation" placeholder="Re-enter password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword2" required>
                                    @error('password')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer d-flex justify-content-end"> <button type="submit" class="btn btn-primary">Update</button> </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('js')
    <script>
        // jQuery function to preview the image
        $(document).ready(function(){
            $('#inputGroupFile02').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#previewImage').attr('src', e.target.result); // Change the src of img tag
                }
                reader.readAsDataURL(this.files[0]); // Read the file as a data URL
            });
        });
    </script>
@endpush
