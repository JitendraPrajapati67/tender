<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('tender_category_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.tender-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tender-categories") || request()->is("admin/tender-categories/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.tenderCategory.title') }}
                </a>
            </li>
        @endcan
            @if( Auth::user()->id == 1)
        @can('bidder_manager_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.bidder-managers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bidder-managers") || request()->is("admin/bidder-managers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-bimobject c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.bidderManager.title') }}
                </a>
            </li>
        @endcan
        @endif
        @if( Auth::user()->id == 1)
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-gavel c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.tenderManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">

                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tender.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.postTender.title') }}
                            </a>
                        </li>

                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tender.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.listTender.title') }}
                            </a>
                        </li>
                    <!--
                        <li class="c-sidebar-nav-item">
                            <a href="#" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.biidingMange.title') }}
                            </a>
                        </li> -->

                </ul>
            </li>
        <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.tender.invitation") }}" class="c-sidebar-nav-link {{ request()->is("admin/tender/invitation") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-envelope c-sidebar-nav-icon">
                    </i>Send Tender invitation
                </a>
            </li>
        @else
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.tender.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.listTender.title') }}
                </a>
            </li>
        @endif


        <li class="c-sidebar-nav-item">
                <a href="{{ route("bid.index") }}" class="c-sidebar-nav-link {{ request()->is("bids") || request()->is("bid/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-dolly-flatbed c-sidebar-nav-icon">

                    </i>
                    @if( Auth::user()->id == 1)
                        Tendder Bider
                    @else
                        My {{ trans('cruds.bidManagement.title') }}
                    @endif
                </a>
            </li>
        @can('material_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.materials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/materials") || request()->is("admin/materials/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-dolly-flatbed c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.material.title') }}
                </a>
            </li>
        @endcan

        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
