@extends('backend.master')
@section('title')
    Support Chat
@endsection
@push('css')
    <style>
        /* Your original styles */
        body {
            background-color: #f0f2f5;
        }

        .chat-window {
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .chat-header {
            background: #3b5998;
            color: white;
            padding: 15px;
            font-size: 18px;
        }

        /* Preserve the original height and scroll */
        .chat-body {
            height: 400px; /* Keep the original height */
            overflow-y: scroll;
            padding: 20px;
            background: #e9ebee;
            display: flex;
            flex-direction: column;
        }

        .chat-footer {
            padding: 15px;
            background: #ffffff;
            border-top: 1px solid #dcdcdc;
            position: relative; /* Required for the attachment pop-up positioning */
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 15px;
            position: relative;
            max-width: 70%;
        }

        .message.sent {
            background: #dff9fb;
            align-self: flex-end;
        }

        .message.received {
            background: #f1f2f6;
            align-self: flex-start;
        }

        .message::after {
            content: "";
            position: absolute;
            bottom: 0;
            width: 0;
            height: 0;
        }

        .message.sent::after {
            right: -10px;
            border-left: 10px solid #dff9fb;
            border-bottom: 10px solid transparent;
        }

        .message.received::after {
            left: -10px;
            border-right: 10px solid #f1f2f6;
            border-bottom: 10px solid transparent;
        }

        .chat-input {
            width: calc(100% - 60px);
            border: none;
            padding: 10px;
            border-radius: 16px;
            background: #f1f2f6;
            resize: none;
            overflow: hidden;
        }

        .send-button {
            width: 74px;
            background: var(--bs-primary);
            color: white;
            border: none;
            border-radius: 25px;
        }

        /* Round + button */
        .attachment-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--bs-primary);
            color: white;
            font-size: 24px;
            border: none;
            outline: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        /* Pop-up options */
        .attachment-options {
            display: none;
            position: absolute;
            bottom: 60px; /* Adjusted to show above the footer */
            left: 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .attachment-options input[type="file"] {
            display: none;
        }

        .attachment-option {
            cursor: pointer;
            padding: 5px 10px;
            display: flex;
            align-items: center;
        }

        .attachment-option img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .attachment-option:hover {
            background-color: #f1f1f1;
        }

        /* Styles for image preview with remove button */
        .image-preview {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .image-preview img {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        .remove-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border: none;
            font-size: 14px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .remove-image-btn:hover {
            background: darkred;
        }

    </style>

@endpush
@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Support Ticket Chat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Support Ticket
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chat
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
                            <div class="card-title">Support for : <span>{{$item->subject}}</span> ({{$item->token}})</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                            <div class="card-body">
                                <div class="chat-body d-flex flex-column">
                                    @foreach ($item->content as $chat)
                                        @if ($chat->sent_by != 1 && $chat->sent_by != 4)
                                            <div class="message received">
                                                @if(count($chat->supportFiles) > 0)

                                                    <div class="row">
                                                        @php $image_count = count($chat->supportFiles->where('type', 1)); @endphp
                                                        @foreach($chat->supportFiles as $file)

                                                            @if($file->type == 1)
                                                                <div class="p-0 text-start
                                                                    @if($image_count == 1)
                                                                        col-md-12
                                                                    @elseif($image_count == 2)
                                                                        col-md-6
                                                                    @elseif($image_count == 3)
                                                                        col-md-4
                                                                    @else
                                                                        col-md-3
                                                                    @endif
                                                                    ">
                                                                    <img src="{{asset($file->file_path)}}" width="100px" class="m-2" alt="">
                                                                </div>
                                                            @else
                                                                <div class="col-md-12 text-start">
                                                                    <a href="{{asset($file->file_path)}}" download="{{asset($file->file_path)}}">{{Str::after($file->file_path, 'support/file/' )}}</a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if($chat->message != null)
                                                            <div class="col-md-12 text-start">{{$chat->message}}</div>
                                                        @endif
                                                    </div>
                                                @else
                                                    {{ $chat->message }}
                                                @endif

                                            </div>
                                        @else
                                            <div class="message sent
{{--                                            @if(count($chat->supportFiles->where('type', 1)) >0) bg-transparent @endif--}}
                                            ">
                                                @if(count($chat->supportFiles) > 0)

                                                    <div class="row">
                                                        @php $image_count = count($chat->supportFiles->where('type', 1)); @endphp
                                                        @foreach($chat->supportFiles as $file)

                                                            @if($file->type == 1)
                                                                <div class="p-0 text-end
                                                                    @if($image_count == 1)
                                                                        col-md-12
                                                                    @elseif($image_count == 2)
                                                                        col-md-6
                                                                    @elseif($image_count == 3)
                                                                        col-md-4
                                                                    @else
                                                                        col-md-3
                                                                    @endif
                                                                    ">
                                                                    <img src="{{asset($file->file_path)}}" width="100px" class="m-2" alt="">
                                                                </div>
                                                            @else
                                                                <div class="col-md-12 text-end">
                                                                    <a href="{{asset($file->file_path)}}" download="{{asset($file->file_path)}}">{{Str::after($file->file_path, 'support/file/' )}}</a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if($chat->message != null)
                                                            <div class="col-md-12 text-end">{{$chat->message}}</div>
                                                        @endif
                                                    </div>
                                                @else
                                                    {{ $chat->message }}
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            @can('Support Chat')
                                @if($item->status == 1)
                                <div class="card-footer">
                                    <form id="supportForm" action="{{ route('admin.support.chat.message.send') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="chat-footer d-flex align-items-center mt-3">
                                            <!-- Add Attachment Button -->
                                            <button type="button" class="attachment-btn">+</button>

                                            <!-- Pop-up Options -->
                                            <div class="attachment-options">
                                                <div class="d-flex">
                                                    <div class="attachment-option" id="image-upload">
                                                        <i class="fa fa-photo-film attachment-btn-input"></i>
                                                    </div>
                                                    <input type="file" name="image[]" id="image-input" multiple accept="image/*">

                                                    <div class="attachment-option" id="file-upload">
                                                        <i class="fa fa-file attachment-btn-input"></i>
                                                    </div>
                                                    <input type="file" name="file" id="file-input" accept=".txt,.doc,.docx,.pdf,.xls,.xlsx">
                                                </div>
                                            </div>

                                            <!-- Message Input -->
                                            <textarea name="message" rows="3" class="chat-input form-control" placeholder="Type a message"></textarea>
                                            <input type="hidden" name="support_ticket_id" value="{{ $item->id }}">
                                            <button type="submit" class="send-button btn btn-primary ms-2">Send</button>
                                        </div>
                                    </form>
                                    <!-- Preview for selected images and files -->
                                    <div id="preview-container">
                                        <div id="image-preview-row"></div>
                                        <div class="row mt-2" id="file-preview-row"></div>
                                    </div>
                                </div> <!--end::Footer-->
                                @endif
                            @endcan
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Toggle attachment options on + button click
            $('.attachment-btn').on('click', function () {
                $('.attachment-options').toggle();
            });

            // Trigger image input when image option is clicked
            $('#image-upload').on('click', function () {
                $('#image-input').click();
            });

            // Trigger file input when file option is clicked
            $('#file-upload').on('click', function () {
                $('#file-input').click();
            });


            // Image preview logic
            $('#image-input').on('change', function() {
                var previewContainer = $('#image-preview-row');
                previewContainer.empty(); // Clear previous previews
                var files = this.files;

                $.each(files, function(index, file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var previewHtml = `
                <div class="image-preview">
                    <img src="${e.target.result}" alt="Preview Image" />
                    <button type="button" class="remove-image-btn" data-index="${index}">
                        <i class="fa fa-times"></i>
                    </button>
                </div>`;
                        previewContainer.append(previewHtml);
                    };
                    reader.readAsDataURL(file);
                });
                $('.attachment-options').toggle();
            });

// Remove image logic
            $(document).on('click', '.remove-image-btn', function() {
                var index = $(this).data('index');
                // Remove the image preview
                $(this).parent().remove();
                // Optionally, clear the file input if necessary
                var fileInput = $('#image-input');
                var fileList = Array.from(fileInput[0].files);
                fileList.splice(index, 1);
                var dataTransfer = new DataTransfer();
                fileList.forEach(function(file) {
                    dataTransfer.items.add(file);
                });
                fileInput[0].files = dataTransfer.files;
            });


            // Handle file selection and preview
            $('#file-input').on('change', function () {
                const file = this.files[0]; // Only one file is allowed
                $('#file-preview-row').empty(); // Clear previous file preview

                if (file) {
                    const fileHTML = `
            <div class="col-md-12">
                <div class="preview-file-wrapper">
                    <span>${file.name}</span>
                    <button type="button" class="btn btn-danger btn-sm remove-file">Remove</button>
                </div>
            </div>`;
                    $('#file-preview-row').append(fileHTML);
                }
                $('.attachment-options').toggle();
            });

            // Remove file from the preview and the input
            $(document).on('click', '.remove-file', function () {
                $('#file-input').val(''); // Clear the file input
                $(this).closest('.col-md-12').remove(); // Remove the file preview from DOM
            });

            // Ajax form submission for message sending
            $('#supportForm').on('submit', function (event) {
                event.preventDefault(); // Prevent the form from submitting the normal way

                var message = $('input[name="message"]').val();
                var image = $('#image-input').get(0).files.length;
                var file = $('#file-input').get(0).files.length;

                // Validation: Check if at least one field is filled (message, image, or file)
                if (message === '' && image === 0 && file === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a message, attach an image, or upload a file before submitting.',
                    });
                    return false; // Prevent form submission
                }

                // Submit form via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        $('#supportForm')[0].reset(); // Reset form fields
                        $('#file-preview-row').empty();
                        $('#image-preview-row').empty();

                        // Process response to append new message to the chat body
                        var newMessageHtml = `<div class="message sent">`;
                        var image_length = response[1].length;
                        var file_length = response[2].length;

                        // Process response for message, images, and files
                        if (image_length != 0 || file_length != 0) {
                            var col = 3;
                            newMessageHtml += `<div class="row">`;

                            // Handle images
                            if (image_length == 1) col = 12;
                            else if (image_length == 2) col = 6;
                            else if (image_length == 3) col = 4;

                            response[1].forEach(function (image) {
                                newMessageHtml += `
                                <div class="text-end col-md-${col}">
                                    <img src="{{asset('/')}}${image.file_path}" alt="Image" width="100px" class="m-2">
                                </div>`;
                            });

                            // Handle files

                            if (file_length !== 0) {
                                response[2].forEach(function (file) {
                                    var fileName = file.file_path.split('uploads/support/file/')[1];
                                    newMessageHtml += `
                                <div class="col-md-12 text-end">
                                    <a href="{{asset('/')}}${file.file_path}" download="${fileName}">${fileName}</a>
                                </div>`;
                                });
                            }

                            if(response[0].message != null){
                                console.log('text-dound');
                                newMessageHtml += `
                            <div class="col-md-12 text-end">${response[0].message}</div>
                            `;
                            }

                            newMessageHtml += `</div>`;
                        }
                        else {
                            newMessageHtml += `${response[0].message}`;
                        }

                        newMessageHtml += `</div>`;

                        $('.chat-body').append(newMessageHtml);

                        // Scroll chat body to the bottom
                        $('.chat-body').scrollTop($('.chat-body')[0].scrollHeight);
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Error',
                            text: 'An error occurred. Please try again.',
                        });
                    }
                });
            });
        });
    </script>
@endpush
