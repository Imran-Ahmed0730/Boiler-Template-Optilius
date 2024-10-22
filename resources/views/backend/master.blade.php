<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{getSetting('site_name')}} | @yield('title')</title><!--begin::Primary Meta Tags-->
    <link rel="icon" type="image/x-icon" href="{{asset(getSetting('site_favicon'))}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{getSetting('business_name')}} | @yield('title')">
{{--    <meta name="author" content="ColorlibHQ">--}}
    <meta name="description" content="{{getSetting('meta_description')}}">
{{--    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->--}}
    @include('backend.include.style')
    @stack('css')
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
<div class="app-wrapper"> <!--begin::Header-->
    @include('backend.include.header')

    @include('backend.include.sidebar')
     <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
        @yield('content')
    </main> <!--end::App Main--> <!--begin::Footer-->
    @include('backend.include.footer')
</div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
@include('backend.include.script')
@stack('js')
</body><!--end::Body-->

</html>
