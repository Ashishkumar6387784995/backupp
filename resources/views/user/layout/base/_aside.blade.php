{{-- Aside --}}

@php
$kt_logo_image = 'hirezy250.png';
@endphp

@if (config('layout.brand.self.theme') === 'light')
@php $kt_logo_image = 'hirezy250.png' @endphp
@elseif (config('layout.brand.self.theme') === 'dark')
@php $kt_logo_image = 'hirezy250.png' @endphp
@endif

<div class="aside aside-left {{ Metronic::printClasses('aside', false) }} d-flex flex-column flex-row-auto" id="kt_aside">

    {{-- Brand --}}
    <div class="brand flex-column-auto {{ Metronic::printClasses('brand', false) }}" id="kt_brand">
        <div class="brand-logo text-center">
            <a href="{{url('/')}}/user/dashboard">
                <!-- <div>JobPortal</div> -->
                <img class="pt-10  w-100" alt="{{ config('app.name') }}" src="{{ asset('frontend/assets/img/logo.png') }}" />
            </a>
        </div>

        @if (config('layout.aside.self.minimize.toggle'))
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            {{ Metronic::getSVG("media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl") }}
        </button>
        @endif

    </div>

    {{-- Aside menu --}}
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        @if (config('layout.aside.self.display') === false)
        <div class="header-logo">
            <a href="{{url('/')}}/user/dashboard">
                <div>Backupp</div>

                <!-- <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/'.$kt_logo_image) }}" /> -->
            </a>
        </div>
        @endif

        <div id="kt_aside_menu" class="aside-menu my-4 {{ Metronic::printClasses('aside_menu', false) }}" data-menu-vertical="1" {{ Metronic::printAttrs('aside_menu') }}>
            <ul class="menu-nav {{ Metronic::printClasses('aside_menu_nav', false) }}">
                <li class="menu-item menu-item-submenu @yield('dashboardmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/')}}/admin/dashboard" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="flaticon-dashboard"></span>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <li class="menu-item menu-item-submenu @yield('savedJobsmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/')}}/user/saved-jobs" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="flaticon-dashboard"></span>
                        </span>
                        <span class="menu-text">Saved Jobs</span>
                    </a>
                </li>

                <li class="menu-item menu-item-submenu @yield('changePass')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ route('user.changePass')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Change Password</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu  @yield('manageProfile')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ route('user.profile') }}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Profile</span>
                    </a>
                </li>
                {{-- Menu::renderVerMenu(config('menu_aside.items')) --}}
            </ul>
        </div>
    </div>

</div>