@extends('backend.master')
@section('title')
    @isset($item) Edit @else Add @endisset Email Template
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" />
@endpush

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">@isset($item) Edit @else Add @endisset Email Template</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Email Templates</li>
                        <li class="breadcrumb-item active" aria-current="page">@isset($item) Edit @else Add @endisset</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header d-flex align-items-center">
                            <div class="card-title">Template Information</div>
                            <a href="{{ route('admin.email-template.index') }}" class="btn btn-primary ms-auto">
                                <i class="fa fa-list me-2"></i>View Email Templates
                            </a>
                        </div>

                        <!-- Begin Form -->
                        <form id="email-template-form" action="@isset($item){{ route('admin.email-template.update') }}@else{{ route('admin.email-template.store') }}@endisset" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="@isset($item){{ $item->id }}@endisset">

                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    @can('Email Template Title Edit')
                                        <input type="text" name="title" placeholder="Enter title of email" class="form-control @error('title') is-invalid @enderror"
                                               value="@isset($item){{ $item->title }}@else{{ old('title') }}@endisset"
                                               id="title" required>
                                        @error('title')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    @endcan
                                </div>

                                <div class="mb-3">
                                    <label for="body" class="form-label">Body Content</label>

                                    <textarea rows="3" name="body" placeholder="Enter body content" class="summernote form-control @error('body') is-invalid @enderror"
                                              id="body" required>@isset($item){{ $item->body }}@else{{ old('body') }}@endisset</textarea>

                                    <!-- Store original body content in hidden input -->
                                    <input type="hidden" id="original-body" value="@isset($item){{ $item->body }}@endisset">

                                    <div class="text-danger" role="alert">
                                        N.B: Don't edit the variables like [[...]]
                                    </div>

                                    @error('body')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Begin Footer -->
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">@isset($item) Update @else Submit @endisset</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Regular expression for the custom syntax [[ ... ]]
            const customSyntaxRegex = /\[\[\s*[^}]+\s*\]\]/g;

            // Get the original body content when the page loads
            const originalBody = $('textarea[name="body"]').val();

            // Extract all occurrences of [[ ... ]] in the original content
            const originalMatches = (originalBody.match(customSyntaxRegex) || []).map(match => match.trim());

            // On form submit
            $('form').submit(function(event) {
                const currentBody = $('textarea[name="body"]').val();

                // Extract all occurrences of [[ ... ]] in the current content
                const currentMatches = (currentBody.match(customSyntaxRegex) || []).map(match => match.trim());

                // Check if any original syntax was removed
                const removedSyntax = originalMatches.filter(match => !currentMatches.includes(match));

                // If any syntax was removed, show a warning via SweetAlert
                if (removedSyntax.length > 0) {
                    event.preventDefault(); // Prevent form submission

                    Swal.fire({
                        title: 'Warning',
                        text: 'It seems that you have removed one or more existing custom syntax variables ([[ ... ]]). Are you sure you want to continue?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, continue',
                        cancelButtonText: 'No, go back'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Allow the form to be submitted if the user confirms
                            $('form').off('submit').submit();
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
