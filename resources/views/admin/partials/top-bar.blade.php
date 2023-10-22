@auth
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex align-items-center justify-content-end w-100">
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        @if (!Auth::check())
                            <a class="btn shadow-none" href="{{ route('login.form') }}">
                                <span class="d-flex align-items-center">
                                    <span class="d-xl-inline-block ms-1 fw-medium">
                                        Đăng nhập
                                    </span>
                                </span>
                            </a>
                        @else
                            <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    {{-- <img class="rounded-circle header-profile-user" alt="Header Avatar"
                        src={{ asset('admin/assets/images/users/avatar-1.jpg') }}> --}}
                                    <span class="text-start ms-xl-2">
                                        <span class="d-xl-inline-block ms-1 fw-medium user-name-text">
                                            {{ Auth::user()->name }}
                                        </span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text text-lowercase">
                                            _{{ Auth::user()->typeUser->name }}
                                        </span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header text-capitalize">Xin chào {{ Auth::user()->name }}!</h6>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">
                                        Tài khoản
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout.submit') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="dropdown-item" type="submit">
                                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">
                                            Đăng xuất
                                        </span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
@endauth
