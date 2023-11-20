    @auth
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('admin.homepage') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src={{ asset('admin/assets/images/logo-sm.png') }} alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src={{ asset('admin/assets/images/logo-dark.png') }} alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('admin.homepage') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src={{ asset('admin/assets/images/logo-sm.png') }} alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src={{ asset('admin/assets/images/logo-light.png') }} alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.homepage') }}">
                                <i class="mdi mdi-home"></i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>

                        @if (in_array('read-location', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('list_location') }}">
                                    <i class="mdi mdi-map-marker-outline"></i> <span data-key="t-maps">Địa điểm</span>
                                </a>
                            </li>
                        @endif

                        @if (in_array('read-trip', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('list_trip') }}">
                                    <i class="fa-solid fa-road" style="font-size: 15px"></i> <span data-key="t-maps">Chuyến đi</span>
                                </a>
                            </li>
                        @endif

                        @if (count(array_diff(['read-user', 'read-user-type'], Auth::user()->permissions)) < 1)
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarUsers">
                                    <i class="mdi mdi-account"></i> <span>
                                        Người dùng
                                    </span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarUsers">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('read-user-type', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a class="nav-link menu-link" href="{{ route('type_users.index') }}"
                                                    role="button">
                                                    <span>Loại người dùng</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (in_array('read-user', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a class="nav-link menu-link" href="{{ route('users.index') }}"
                                                    role="button">
                                                    <span>Người dùng</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                            </li>
                        @endif

                        @if (count(array_diff(['read-role', 'read-permission'], Auth::user()->permissions)) < 1)
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarRole" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarRole">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    <span data-key="t-authentication">Vai trò & phân quyền</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarRole">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('read-role', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('list_role') }}" class="nav-link" role="button">
                                                    Vai trò
                                                </a>
                                            </li>
                                        @endif

                                        @if (in_array('read-permission', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('list_permission') }}" class="nav-link" role="button">
                                                    Phân quyền
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (count(array_diff(['read-car', 'read-car-type'], Auth::user()->permissions)) < 1)
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarCarTypeCar" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarCarTypeCar">
                                    <i class="mdi mdi-car"></i>
                                    <span data-key="t-authentication">Xe và loại xe</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCarTypeCar">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('read-car-type', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('index_typecar') }}" class="nav-link" role="button">
                                                    Loại xe
                                                </a>
                                            </li>
                                        @endif

                                        @if (in_array('read-car', Auth::user()->permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('index_car') }}" class="nav-link" role="button">
                                                    Xe
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (in_array('read-discount-code', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('list_discount_code') }}">
                                    <i class="fa-solid fa-ticket" style="font-size: 15px"></i> <span data-key="t-maps">Mã giảm giá</span>
                                </a>
                            </li>
                        @endif
                        @if (in_array('read-news', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('index_new') }}">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span data-key="t-maps">Bài viết</span>
                                </a>
                            </li>
                        @endif

                        @if (in_array('read-search-ticket', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('form_search') }}">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span data-key="t-maps">Tra cứu vé</span>
                                </a>
                            </li>
                        @endif
                        @if (in_array('read-bill', Auth::user()->permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('list_order') }}">
                                    <i class="fa-solid fa-cart-shopping"></i> <span data-key="t-maps">Hóa đơn</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    @endauth
