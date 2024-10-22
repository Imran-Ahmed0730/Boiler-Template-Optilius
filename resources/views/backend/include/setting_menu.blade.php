@php
$url = URL::current();
@endphp

<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!-- Start navbar links -->
        <ul class="navbar-nav flex-nowrap" style="overflow-x: auto; white-space: nowrap;">
            @can('Settings Site')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'site')}}" class="nav-link {{Str::contains($url, 'site') ? 'active':''}}">Site</a>
            </li>
            @endcan
            @can('Settings Contact')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'contact')}}" class="nav-link {{Str::contains($url, 'contact') ? 'active':''}}">Contact</a>
            </li>
                @endcan
                @can('Settings Logo & Favicon')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'logos-favicon')}}" class="nav-link {{Str::contains($url, 'logos-favicon') ? 'active':''}}">Logos & Favicon</a>
            </li>
                @endcan
                @can('Settings Social Media')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'social-media')}}" class="nav-link {{Str::contains($url, 'social-media') ? 'active':''}}">Social Media</a>
            </li>
                @endcan
                @can('Settings User')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'user')}}" class="nav-link {{Str::contains($url, 'user') ? 'active':''}}">User Setting</a>
            </li>
                @endcan
                @can('Settings Store')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'store')}}" class="nav-link {{Str::contains($url, 'store') ? 'active':''}}">Physical Store</a>
            </li>
                @endcan
                @can('Settings Language')
            <li class="nav-item setting-menu">
                <a href="{{route('admin.setting.edit', 'language')}}" class="nav-link {{Str::contains($url, 'language') ? 'active':''}}">Language</a>
            </li>
                @endcan
        </ul>
        <!-- End navbar links -->
    </div>
    <!--end::Container-->
</nav>
