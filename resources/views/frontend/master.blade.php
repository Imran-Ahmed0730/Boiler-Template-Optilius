<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontend.include.style')
    @stack('css')
    <title>{{getSetting('site_name')}} - @yield('title')</title>
</head>
<body>
@include('frontend.include.header')
<main>
    <div class="container-fluid">
        @yield('content')
    </div>
</main>
@include('frontend.include.script')
@stack('js')
@php
$route = Route::currentRouteName();
if($route != 'support.chat.public'){
    Session::forget('verify_chat');
}

@endphp
</body>
</html>
