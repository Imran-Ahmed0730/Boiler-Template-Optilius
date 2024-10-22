@extends('frontend.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Contact Us
            </h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-8 mx-auto">
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                <form action="{{route('message.send')}}" method="post" id="messageForm"> <!--begin::Body-->
                    @csrf

                    <div class="card-body">
                        <div class="mb-3"> <label for="name" class="form-label">Name</label> <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                            @error('name')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="email" class="form-label">Email address</label> <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="subject" class="form-label">Subject</label> <input type="text" name="subject" class="form-control" id="subject" aria-describedby="subject">
                            @error('subject')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                            @error('message')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @error('g-recaptcha-response')
                        <div class="invalid-feedback" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div> <!--end::Body--> <!--begin::Footer-->
                    <div class="card-footer">
                        <button class="btn btn-primary g-recaptcha" data-sitekey="{{config('services.recaptcha.site_key')}}"
                                data-callback="onSubmit"
                                data-action="submit">Submit</button>
                    </div> <!--end::Footer-->
                </form> <!--end::Form-->
            </div> <!--end::Quick Example--> <!--begin::Input Group-->
        </div>
    </div>
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site_key')}}"></script>
    <script>
        function onSubmit(token) {
            document.getElementById('messageForm').submit();
        }
    </script>
@endpush
