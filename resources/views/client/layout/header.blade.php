<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ""}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>.dropdown-toggle::after {display: none;}</style>
    @yield('style')


</head>
<body>
<header class="w-full-container header-page-image">
    <header class="container" >
        <div class="pt-3 d-flex justify-content-between">
            <div></div>
            <div></div>
            <div class="image_logo">
                <img src="{{ asset('client/assets/images/logo_web.png') }}" alt="">
            </div>
                    <div id="button_login" class=" btn rounded-pill bg-white w-btn-lg-rg align justify-content-evenly">
                        <div class="d-flex ">
                            <div class="pe-2">
                                <i class="fa-solid fa-circle-user icon-user-bg fs-22"></i>
                            </div>
                            <div class="fs-14">
                                <a href="{{route('dang-nhap')}}" class="text-decoration-none cl-black fw-normal">Đăng nhập/</a>
                            </div>
                            <div class="fs-14">
                                <a id="register-link" class="text-decoration-none cl-black fw-normal">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                    <div id="button_logout" class="rounded-pill bg-white align justify-content-evenly" style="display: none">
                        <div class="btn rounded-pill align dropdown-toggle " data-toggle="dropdown">
                            <div class="d-flex">
                                <div class="pe-2">
                                    <i class="fa-solid fa-circle-user icon-user-bg fs-22"></i>
                                </div>
                                <div class="fs-14"id="userNameContainer">
                                </div>
                                <div class="dropdown-menu">
                                    <ul class="list-group mb-0">
                                        <li class="list-group-item py-3" id="profile">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('client/assets/images/Profile.svg') }}" alt="" class="mr-2">
                                                <a class="dropdown-item" href="#">Thông Tin Tài Khoản</a>
                                            </div>
                                        </li>
                                        <li class="list-group-item py-2" id="discount" style="padding-top: 0.7rem!important;padding-bottom: 0.7rem!important;">
                                            <div class="d-flex align-items-center">
                                                <img src="http://127.0.0.1:8000/client/assets/images/coutun.jpg" alt="" class="mr-2" style="margin-left: -5px;width: 40px;">
                                                <a class="dropdown-item" href="#">Mã Giảm Giá</a>
                                            </div>
                                        </li>
                                        <li class="list-group-item py-3" id="booking_history">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('client/assets/images/History.svg') }}" alt="" class="mr-2">
                                                <a class="dropdown-item" href="#">Lịch Sử Đặt Vé</a>
                                            </div>
                                        </li>
                                        <li class="list-group-item py-3" id="password">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('client/assets/images/Password.svg') }}" alt="" class="mr-2">
                                                <a class="dropdown-item" href="#">Đổi Mật Khẩu</a>
                                            </div>
                                        </li>
                                        <li class="list-group-item py-3" id="logoutButton">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('client/assets/images/Logout.svg') }}" alt="" class="mr-2">
                                                <a class="dropdown-item" href="#">Đăng Xuất</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" >
                                <h5 class="modal-title" id="logoutModalLabel">Xác nhận đăng xuất</h5>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc muốn đăng xuất?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelLogout" style="background-color: #6c757d;">Hủy</button>
                                <button type="button" class="btn btn-primary" id="confirmLogout" style="background-color: rgb(239, 82, 34);border: 1px solid rgb(239, 82, 34);">Đăng xuất</button>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="pt-3 pb-4">
                    <ul class="nav nav-underline justify-content-center gap-6">
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block" href="{{url('/')}}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="{{url('/lich-trinh')}}">Lịch trình</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="{{url('/tra-cuu')}}">Tra cứu vé</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="#">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="#">Hóa đơn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="{{url('/lien-he')}}">Liên hệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block " href="{{url('/ve-chung-toi')}}">Về chúng tôi</a>
                        </li>
                    </ul>
                </nav>

    </header>

</header>
<script>
    $(document).ready(function() {
        $('#register-link').on('click', function(e) {
            e.preventDefault();
            localStorage.setItem('registrationClicked', 'true');
            window.location.href = "{{ route('dang-nhap') }}";
        });
    });
</script>
<script src="{{ asset('client/assets/js/login.js') }}"></script>


