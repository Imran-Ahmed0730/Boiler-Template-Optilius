@extends('frontend.master')
@section('title')
    Support Ticket
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Support Ticket
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
        <div class="col-md-9 mx-auto">
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-chat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-chat" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Support Chat</button>
                                <button class="nav-link" id="v-pills-support-add-tab" data-bs-toggle="pill" data-bs-target="#v-pills-support-add" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add Support Ticket</button>
                            </div>
                            <div class="tab-content w-75" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-chat" role="tabpanel" aria-labelledby="v-pills-chat-tab">
                                    <form action="{{route('support.chat')}}" method="get"> <!--begin::Body-->
                                        @csrf

                                        <div class="row">
                                            <div class="mb-3"> <label for="token" class="form-label">Token </label> <input type="text" name="token" class="form-control" id="token" aria-describedby="token" required>
                                                @error('token')
                                                <div class="invalid-feedback" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3"> <label for="email" class="form-label">Email address</label> <input type="email" @if(Auth::check() && Auth::user()->role == 3) value="{{Auth::user()->email}}" @endif name="email" class="form-control" id="email" aria-describedby="email" required>
                                                @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div> <!--end::Body--> <!--begin::Footer-->
                                        <div class="">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div> <!--end::Footer-->
                                    </form> <!--end::Form-->
                                </div>
                                <div class="tab-pane fade" id="v-pills-support-add" role="tabpanel" aria-labelledby="v-pills-support-add-tab">
                                    <form action="{{route('support.submit')}}" method="post" id="supportForm"> <!--begin::Body-->
                                        @csrf
                                        <div class="">
                                            <div class="mb-3"> <label for="email" class="form-label">Email address</label> <input type="email" @if(Auth::check() && Auth::user()->role == 3) value="{{Auth::user()->email}}" @endif name="email" class="form-control" id="email" aria-describedby="email" required>
                                                @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3"> <label for="subject" class="form-label">Subject</label> <input type="text" name="subject" class="form-control" id="subject" aria-describedby="subject" required>
                                                @error('subject')
                                                <div class="invalid-feedback" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3"> <label for="message" class="form-label">Message</label>
                                                <textarea name="message" id="message" class="form-control" cols="30" rows="10" required></textarea>
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
                                        <div class="">
                                            <button class="btn btn-primary g-recaptcha" data-sitekey="{{config('services.recaptcha.site_key')}}"
                                                    data-callback="onSubmit"
                                                    data-action="submit">Submit</button>
                                        </div> <!--end::Footer-->
                                    </form> <!--end::Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!--end::Quick Example--> <!--begin::Input Group-->
        </div>
    </div>
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site_key')}}"></script>
    <script>
        function onSubmit(token) {
            document.getElementById('supportForm').submit();
        }
    </script>
@endpush
