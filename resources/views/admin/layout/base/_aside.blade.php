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
            <a href="{{url('/')}}/admin/dashboard">
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
            <a href="{{url('/')}}/admin/dashboard">
                <div>JobPortal</div>

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

                <!-- <li class="menu-item menu-item-submenu @yield('ordermaster')   @yield('enquiremaster')   @yield('jdlead') " aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="flaticon-bag"></span>
                        </span>
                        <span class="menu-text">Lead</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item @yield('ordermaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/')}}/admin/orders/list" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Home Collection</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu   @yield('enquiremaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/')}}/admin/enquires/list" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Booking</span>
                                </a>
                            </li>
                             
                        </ul>
                    </div>
                </li> -->


                <li class="menu-item menu-item-submenu @yield('employermaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/company/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Companies</span>
                    </a>
                </li>
                {{-- <li class="menu-item menu-item-submenu @yield('partnermaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/partner/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Recruitment Partner</span>
                    </a>
                </li> --}}
                {{-- <li class="menu-item menu-item-submenu @yield('kycmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/kyc/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">KYC Management</span>
                    </a>
                </li> --}}
                <li class="menu-item menu-item-submenu @yield('customermaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/customers/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Jobs Seeker</span>
                    </a>
                </li>
                <!-- <li class="menu-item menu-item-submenu @yield('testsmaster')  @yield('packagemaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="fas fa-vial"></span>
                        </span>
                        <span class="menu-text">Tests & Packages</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item @yield('testsmaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/tests/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Tests</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu @yield('packagemaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/packages/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Packages</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="menu-item menu-item-submenu @yield('industrymaster')  @yield('categorymaster') @yield('servicesmaster') @yield('citymaster') @yield('departmentmaster')  @yield('specialitymaster')  @yield('pgoptions')  @yield('facilitymaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
                                    <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Job Master</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item @yield('citymaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/city/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Job City</span>
                                </a>
                            </li>
                            <li class="menu-item  @yield('categorymaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/categories/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Job Category</span>
                                </a>
                            </li>
                            <li class="menu-item @yield('servicesmaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/services/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Job Services</span>
                                </a>
                            </li>
                            <li class="menu-item  @yield('departmentmaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/departments/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Manage Department</span>
                                </a>
                            </li>

                            <li class="menu-item  @yield('industrymaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/industries/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Manage Industries</span>
                                </a>
                            </li>

                            <!-- <li class="menu-item  @yield('facilitymaster')  " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/facility/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Facilities </span>
                                </a>
                            </li> -->

                        </ul>
                    </div>
                </li>
                <!-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M6,8 L6,16 L18,16 L18,8 L6,8 Z M20,16 L21.381966,16 C21.7607381,16 22.1070012,16.2140024 22.2763932,16.5527864 L22.5,17 C22.6706654,17.3413307 22.5323138,17.7563856 22.190983,17.927051 C22.0950363,17.9750244 21.9892377,18 21.881966,18 L2.11803399,18 C1.73641461,18 1.42705098,17.6906364 1.42705098,17.309017 C1.42705098,17.2017453 1.45202663,17.0959467 1.5,17 L1.7236068,16.5527864 C1.89299881,16.2140024 2.23926193,16 2.61803399,16 L4,16 L4,8 C4,6.8954305 4.8954305,6 6,6 L18,6 C19.1045695,6 20,6.8954305 20,8 L20,16 Z" fill="#000000" fill-rule="nonzero" />
                                    <polygon fill="#000000" opacity="0.3" points="6 8 6 16 18 16 18 8" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Marketing</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="#" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Offers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li class="menu-item menu-item-submenu   @yield('centermaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/centres/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Centres</span>
                    </a>
                </li> -->

                <!-- <li class="menu-item menu-item-submenu @yield('doctormaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/doctors/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M8,18 L8,18 C10.209139,18 12,19.790861 12,22 L4,22 L4,22 C4,19.790861 5.790861,18 8,18 Z" fill="#000000" opacity="0.3" />
                                    <path d="M7,12.1260175 L7,8 C7,4.6862915 9.6862915,2 13,2 C16.3137085,2 19,4.6862915 19,8 L19,9 L17,9 L17,8 C17,5.790861 15.209139,4 13,4 C10.790861,4 9,5.790861 9,8 L9,12.1260175 C10.7252272,12.5700603 12,14.1361606 12,16 C12,18.209139 10.209139,20 8,20 C5.790861,20 4,18.209139 4,16 C4,14.1361606 5.27477279,12.5700603 7,12.1260175 Z M8,18 C9.1045695,18 10,17.1045695 10,16 C10,14.8954305 9.1045695,14 8,14 C6.8954305,14 6,14.8954305 6,16 C6,17.1045695 6.8954305,18 8,18 Z" fill="#000000" />
                                    <path d="M18,17 C19.1045695,17 20,16.1045695 20,15 C20,14.2636203 19.3333333,13.2636203 18,12 C16.6666667,13.2636203 16,14.2636203 16,15 C16,16.1045695 16.8954305,17 18,17 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Doctors</span>
                    </a>
                </li> -->

                <!-- <li class="menu-item menu-item-submenu @yield('coupons')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/offers/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="fas fa-tags"></span>
                        </span>
                        <span class="menu-text">Offers</span>
                    </a>
                </li> -->

                <!-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Transactions</span>
                    </a>
                </li> -->
<!-- 
                <li class="menu-item menu-item-submenu @yield('pressrelease')  @yield('cmemaster')  @yield('eventmaster') " aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <span class="fas fa-file-invoice"></span>
                        </span>
                        <span class="menu-text">Content Management</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">




                            <li class="menu-item   @yield('eventmaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/events/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>

                                    <span class="menu-text">News & Events</span>
                                </a>
                            </li>

                            <li class="menu-item @yield('cmemaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/cme/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>

                                    <span class="menu-text">CME Management</span>
                                </a>
                            </li>


                            <li class="menu-item @yield('pressrelease') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/pressrelease/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Press Release</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

 -->

                {{-- <li class="menu-item menu-item-submenu @yield('querymaster')  @yield('newslettersubscription')  @yield('partnerenquirymaster')  @yield('testimonials') @yield('faqmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1" />
                                    <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Others</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item  @yield('querymaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/queries/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Queries</span>
                                </a>
                            </li>
                            <!-- <li class="menu-item  @yield('partnerenquirymaster') " aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('admin/partnerenquiry/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Partner Enquiry</span>
                                </a>
                            </li> -->
                            <li class="menu-item  @yield('faqmaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/faqs/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">FAQ</span>
                                </a>
                            </li>
                            <li class="menu-item @yield('testimonials')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('admin/testimonials/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Testimonials</span>
                                </a>
                            </li>
                            <li class="menu-item @yield('newslettersubscription')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('admin/newslettersubscription/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Newsletter Subscriptions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
<!-- 
                <li class="menu-item menu-item-submenu @yield('seomanagement')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/seo/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">SEO</span>
                    </a>
                </li> -->
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Tasks</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Traders</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Workforce</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu @yield('userlist')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/users/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Users</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Interview</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Manage Invoices</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Payroll</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Quote</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Expense</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Profit Lose</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">LMS</span>
                    </a>
                </li>
                {{-- <li class="menu-item menu-item-submenu @yield('notificationmanagement')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/notification/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Notifications</span>
                    </a>
                </li> --}}
                {{-- <li class="menu-item menu-item-submenu   @yield('jobsmaster') @yield('applicationmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">HR</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="320" style=""><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Admin</span></span></li>
                            <li class="menu-item @yield('jobsmaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/jobs/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Job Posts</span>
                                </a>
                            </li>
                            <li class="menu-item @yield('applicationmaster')" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{url('/admin/job-applications/list')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line"><span></span></i>
                                    <span class="menu-text">Job Applications</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                
 
                {{-- <li class="menu-item menu-item-submenu  @yield('reportmaster')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/report/list')}}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Reports</span>
                    </a>
                </li> --}}
                <li class="menu-item menu-item-submenu @yield('changePass')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ url('admin/change-password') }}" class="menu-link menu-toggle">
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
                {{-- <li class="menu-item menu-item-submenu  @yield('settings')" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{url('/admin/settings')}}" class="menu-link menu-toggle">
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
                </li> --}}









                {{-- Menu::renderVerMenu(config('menu_aside.items')) --}}
            </ul>
        </div>
    </div>

</div>