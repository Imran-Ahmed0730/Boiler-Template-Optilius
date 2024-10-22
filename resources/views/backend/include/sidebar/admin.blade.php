{{--<li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-clipboard-fill"></i>--}}
{{--        <p>--}}
{{--            Layout Options--}}
{{--            <span class="nav-badge badge text-bg-secondary me-3">6</span> <i class="nav-arrow bi bi-chevron-right"></i>--}}
{{--        </p>--}}
{{--    </a>--}}
{{--    <ul class="nav nav-treeview">--}}
{{--        <li class="nav-item"> <a href="./layout/unfixed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Default Sidebar</p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/fixed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Fixed Sidebar</p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/layout-custom-area.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Layout <small>+ Custom Area </small></p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/sidebar-mini.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Sidebar Mini</p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/collapsed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Sidebar Mini <small>+ Collapsed</small></p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/logo-switch.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Sidebar Mini <small>+ Logo Switch</small></p>--}}
{{--            </a> </li>--}}
{{--        <li class="nav-item"> <a href="./layout/layout-rtl.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>--}}
{{--                <p>Layout RTL</p>--}}
{{--            </a> </li>--}}
{{--    </ul>--}}
{{--</li>--}}
@canany(['Settings Add', 'Settings View', 'Settings Update'])
<li class="nav-item {{Str::contains($route, 'setting') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-gear"></i>
        <p>
            Site Setting
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'setting') ? 'show':''}}">
        @can('Settings View')
            <li class="nav-item "> <a href="{{route('admin.setting.index')}}" class="nav-link {{$route == 'admin.setting.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                    <p>View Setting Keys</p>
                </a> </li>
        @endcan
        @can('Settings Add')
            <li class="nav-item "> <a href="{{route('admin.setting.create')}}" class="nav-link {{$route == 'admin.setting.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                    <p>Add Setting</p>
                </a> </li>
        @endcan
        @can('Settings Update')
        <li class="nav-item "> <a href="{{route('admin.setting.edit', 'site')}}" class="nav-link {{$route == 'admin.setting.edit' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>General Setting</p>
            </a> </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['Page Create', 'Page View'])
    <li class="nav-item {{Str::contains($route, 'admin.page') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-earmark"></i>
            <p>
                Pages
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'admin.page') ? 'show':''}}">
            @can('Page View')
                <li class="nav-item">
                    <a href="{{route('admin.page.index')}}" class="nav-link {{$route == 'admin.page.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>View Pages</p>
                    </a>
                </li>
            @endcan
            @can('Page Create')
                <li class="nav-item">
                    <a href="{{route('admin.page.create')}}" class="nav-link {{$route == 'admin.page.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>Add Page</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['Frontend-Page Add', 'Frontend-Page View'])
    <li class="nav-item {{Str::contains($route, 'frontend-page') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-earmark"></i>
            <p>
                Frontend Page
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'frontend-page') ? 'show':''}}">
            @can('Frontend-Page View')
                <li class="nav-item">
                    <a href="{{route('admin.frontend-page.index')}}" class="nav-link {{$route == 'admin.frontend-page.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>View Pages</p>
                    </a>
                </li>
            @endcan
            @can('Frontend-Page Add')
                <li class="nav-item">
                    <a href="{{route('admin.frontend-page.create')}}" class="nav-link {{$route == 'admin.frontend-page.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>Add Page</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@canany(['Country View', 'Country Add'])
<li class="nav-item {{Str::contains($route, 'country') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-globe2"></i>
        <p>
            Countries
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'country') ? 'show':''}}">
        @can('Country View')
        <li class="nav-item ">
            <a href="{{route('admin.country.index')}}" class="nav-link {{$route == 'admin.country.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>View Countries</p>
            </a>
        </li>
        @endcan
        @can('Country Add')
        <li class="nav-item">
            <a href="{{route('admin.country.create')}}" class="nav-link {{$route == 'admin.country.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>Add Country</p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['Sms Template View', 'Sms Template Add'])
<li class="nav-item {{Str::contains($route, 'sms-template') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-chat"></i>
        <p>
            Sms Templates
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'sms-template') ? 'show':''}}">
        @can('Sms Template View')
        <li class="nav-item ">
            <a href="{{route('admin.sms-template.index')}}" class="nav-link {{$route == 'admin.sms-template.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>View Templates</p>
            </a>
        </li>
        @endcan
        @can('Sms Template Add')
        <li class="nav-item">
            <a href="{{route('admin.sms-template.create')}}" class="nav-link {{$route == 'admin.sms-template.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>Add Template</p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['Email Template View', 'Email Template Add'])
    <li class="nav-item {{Str::contains($route, 'email-template') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-envelope"></i>
            <p>
                Email Templates
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'sms-template') ? 'show':''}}">
            @can('Email Template View')
                <li class="nav-item ">
                    <a href="{{route('admin.email-template.index')}}" class="nav-link {{$route == 'admin.email-template.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>View Templates</p>
                    </a>
                </li>
            @endcan
            @can('Email Template Add')
                <li class="nav-item">
                    <a href="{{route('admin.email-template.create')}}" class="nav-link {{$route == 'admin.email-template.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>Add Template</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@can('Subscriber View')
<li class="nav-item {{Str::contains($route, 'subscriber') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-check"></i>
        <p>
            Subscribers
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'subscriber') ? 'show':''}}">
        <li class="nav-item"> <a href="{{route('admin.subscriber.index')}}" class="nav-link {{$route == 'admin.subscriber.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>View Subscribers</p>
            </a> </li>
    </ul>
</li>
@endcan
@canany(['Role Add', 'Role View', 'Permission Add', 'Permission View'])
<li class="nav-item {{Str::contains($route, 'role') || Str::contains($route, 'permission') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-lock"></i>
        <p>
            Roles & Permissions
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'role') || Str::contains($route, 'permission') ? 'show':''}}">
        @canany(['Role Add', 'Role View'])
        <li class="nav-item {{Str::contains($route, 'role') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                <p>
                    Roles
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview {{Str::contains($route, 'role') ? 'show':''}}">
                @can('Role Add')
                <li class="nav-item"> <a href="{{route('admin.role.create')}}" class="nav-link {{$route == 'admin.role.create' ? 'active':''}}"> <i class="nav-icon bi bi-record-circle-fill"></i>
                        <p>Add Role</p>
                    </a> </li>
                @endcan
                @can('Role View')
                <li class="nav-item"> <a href="{{route('admin.role.index')}}" class="nav-link {{$route == 'admin.role.index' ? 'active':''}}"> <i class="nav-icon bi bi-record-circle-fill"></i>
                        <p>View Roles</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
        @canany(['Permission Add', 'Permission View'])
        <li class="nav-item {{Str::contains($route, 'permission') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                <p>
                    Permission
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview {{Str::contains($route, 'permission') ? 'show':''}}">
                @can('Permission Add')
                <li class="nav-item"> <a href="{{route('admin.permission.create')}}" class="nav-link {{$route == 'admin.permission.create' ? 'active':''}}"> <i class="nav-icon bi bi-record-circle-fill"></i>
                        <p>Add Permission</p>
                    </a> </li>
                @endcan
                @can('Permission View')
                <li class="nav-item"> <a href="{{route('admin.permission.index')}}" class="nav-link {{$route == 'admin.permission.index' ? 'active':''}}"> <i class="nav-icon bi bi-record-circle-fill"></i>
                        <p>View Permissions</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
    </ul>
</li>
@endcanany
@canany(['Staff View', 'Staff Create', 'Role Assign'])
<li class="nav-item {{Str::contains($route, 'staff') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-gear"></i>
        <p>
            Staff & Roles
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{Str::contains($route, 'staff') ? 'show':''}}">
        @can('Staff View')
            <li class="nav-item"> <a href="{{route('admin.staff.index')}}" class="nav-link {{$route == 'admin.staff.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>View Staffs</p>
            </a> </li>
        @endcan

        @can('Staff Create')
        <li class="nav-item"> <a href="{{route('admin.staff.create')}}" class="nav-link {{$route == 'admin.staff.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>Add Staff</p>
            </a> </li>
        @endcan
        @can('Role Assignment')
        <li class="nav-item"> <a href="{{route('admin.staff.assign')}}" class="nav-link {{$route == 'admin.staff.assign' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                <p>Assign Role</p>
            </a> </li>
        @endcan
    </ul>
</li>
@endcanany
@can('Support View')
    <li class="nav-item {{Str::contains($route, 'live-chat') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-raised-hand"></i>
            <p>
                Live Chats
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'live-chat') ? 'show':''}}">
            <li class="nav-item"> <a href="{{route('admin.live-chat.index')}}" class="nav-link {{$route == 'admin.live-chat.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                    <p>Live Chats View</p>
                </a> </li>
        </ul>
    </li>
@endcan
@can('Support View')
    <li class="nav-item {{Str::contains($route, 'support') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-raised-hand"></i>
            <p>
                Support Tickets
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'support') ? 'show':''}}">
            <li class="nav-item"> <a href="{{route('admin.support.index')}}" class="nav-link {{$route == 'admin.support.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                    <p>Support Ticket View</p>
                </a> </li>
        </ul>
    </li>
@endcan
@can('Message View')
    <li class="nav-item {{Str::contains($route, 'message') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-envelope"></i>
            <p>
                User Messages
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'message') ? 'show':''}}">
            <li class="nav-item"> <a href="{{route('admin.message.index')}}" class="nav-link {{$route == 'admin.message.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                    <p>View Messages</p>
                </a> </li>
        </ul>
    </li>
@endcan
@canany(['Static Translation View', 'Static Translation Add'])
    <li class="nav-item {{Str::contains($route, 'static-translation') ? 'menu-open':''}}"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-translate"></i>
            <p>
                Static Translations
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview {{Str::contains($route, 'sms-template') ? 'show':''}}">
            @can('Static Translation View')
                <li class="nav-item ">
                    <a href="{{route('admin.static-translation.index')}}" class="nav-link {{$route == 'admin.static-translation.index' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>View Translations</p>
                    </a>
                </li>
            @endcan
            @can('Static Translation Key Add')
                <li class="nav-item">
                    <a href="{{route('admin.static-translation.create')}}" class="nav-link {{$route == 'admin.static-translation.create' ? 'active':''}}"> <i class="nav-icon bi bi-circle"></i>
                        <p>Add Translation</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
