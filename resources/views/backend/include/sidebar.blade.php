@php $route = Route::currentRouteName() @endphp
<style>
    .nav-treeview.show{
        display: block; box-sizing: border-box;

            /*animation-name: fadeIn;*/
            /*animation-duration: 0.3s;*/
            /*animation-fill-mode: both;*/
            /*animation-delay: 0.3s;*/
            /*transform: translateY(-50%) rotate(90deg) !*rtl:ignore*!;*/

    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{route('admin.dashboard')}}" class="brand-link"> <!--begin::Brand Image-->
            <img src="{{asset(getSetting('site_logo'))}}" alt="{{getSetting('business_name')}} Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text-->
            {{--            <span class="brand-text fw-light">{{getSetting('business_name')}}</span> <!--end::Brand Text-->--}}
        </a> <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="{{route('admin.dashboard')}}" class="nav-link {{$route == 'admin.dashboard' ? 'active':''}}"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Auth::user()->role == 1 || Auth::user()->role == 4)
                    @include('backend.include.sidebar.admin')
                @endif
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside>
