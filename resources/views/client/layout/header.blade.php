<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    <link rel="icon" href="{{ asset('client/assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>.dropdown-toggle::after {display: none;}</style>
    @yield('style')


</head>

<body>

    <header class="w-full-container header-page-image">
        <header class="container">

            <div class="pt-3 d-flex justify-content-between">
                <div></div>
                <div></div>
                <div class="image_logo">
                    <img src="{{ asset('client/assets/images/logo_web.png') }}" alt="">
                </div>
                <div class="d-flex btn rounded-pill bg-white w-btn-lg-rg align justify-content-evenly">
                    <div class="pe-2">
                        <i class="fa-solid fa-circle-user icon-user-bg fs-22"></i>
                    </div>
                    <div class="fs-14">
                        <a href="" class="text-decoration-none cl-black fw-normal">Đăng nhập/</a>
                    </div>
                    <div class="fs-14">
                        <a href="" class="text-decoration-none cl-black fw-normal">Đăng ký</a>
                    </div>
                </div>
            </div>
            <nav class="pt-3 pb-4">
                <ul class="nav nav-underline justify-content-center gap-6">
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block active"
                            aria-current="page" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="{{ url('/lich-trinh') }}">Lịch trình</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="{{ url('/tra-cuu') }}">Tra cứu vé</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="#">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="#">Hóa đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="#">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-item-menu text-uppercase fs-14 cl-white fw-medium w-100 d-block "
                            href="#">Về chúng tôi</a>
                    </li>
                </ul>
            </nav>
        </header>
    </header>
