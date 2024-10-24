
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{getSetting('business_name')}} | Register</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{getSetting('business_name')}}| Register">
    <meta name="author" content="{{getSetting('business_name')}}">
    <meta name="description" content="{{getSetting('meta_description')}}">
{{--    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('backend')}}/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="register-page bg-body-secondary">
<div class="register-box"> <!-- /.register-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header"> <a href="{{route('home')}}" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"> <b>{{getSetting('business_name')}}</b>
                </h1>
            </a> </div>
        <div class="card-body register-card-body">
            <p class="register-box-msg">Register a new membership</p>
            <form action="{{route('register')}}" method="post" id="registerForm">
                @csrf
                <div class="input-group mb-1">
                    <div class="form-floating"> <input id="registerFullName" name="name" type="text" class="form-control" placeholder=""> <label for="registerFullName">Full Name</label> </div>
                    <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating"> <input id="registerEmail" type="email" name="email" class="form-control" placeholder=""> <label for="registerEmail">Email</label> </div>
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating"> <input id="registerPhone" name="phone" type="tel" class="form-control" placeholder=""> <label for="registerPhone">Phone</label> </div>
                    <div class="input-group-text"> <span class="bi bi-telephone"></span> </div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating"> <input id="registerPassword" name="password" type="password" class="form-control" placeholder=""> <label for="registerPassword">Password</label> </div>
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div> <!--begin::Row-->
                <div class="input-group mb-1">
                    <div class="form-floating"> <input id="registerPasswordConfirmation" name="password_confirmation" type="password" class="form-control" placeholder=""> <label for="registerPasswordConfirmation">Confirm Password</label> </div>
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div> <!--begin::Row-->
                <div class="row">
                    <div class="col-8 d-inline-flex align-items-center">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                I agree to the <a href="#">terms</a> </label> </div>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button class="btn btn-primary g-recaptcha" data-sitekey="{{config('services.recaptcha.site_key')}}"
                                                           data-callback="onSubmit"
                                                           data-action="submit">Sign Up</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
            <div class="social-auth-links text-center mb-3 d-grid gap-2">
                <p>- OR -</p> <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                </a> <a href="#" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using Google+
                </a>
            </div> <!-- /.social-auth-links -->
            <p class="mb-0"> <a href="{{route('login')}}" class="link-primary text-center">
                    I already have a membership
                </a> </p>
        </div> <!-- /.register-card-body -->
    </div>
</div> <!-- /.register-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{asset('backend')}}/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->


{{--//recaptcha script--}}
    <script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site_key')}}"></script>
    <script>
        function onSubmit(token) {
            document.getElementById('registerForm').submit();
        }
    </script>

</body><!--end::Body-->

</html>
