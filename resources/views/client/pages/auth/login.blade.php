<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset("admin/assets/css/icons.min.css") }}" rel="stylesheet" type="text/css" />
    @include('client.pages.auth.style')
</head>
<body>
<header class="w-full-container header-page-image">
    <header class="container">
        <div class="pt-3 d-flex justify-content-between">
            <div></div>
            <div></div>
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
    </header>
</header>
<main>
    <div class="container" >
        <div class="d-flex justify-content-center">
            <div class="row form-login rounded ">
                <div class="col-md-7" >
                    <div class="login_tag mt-4" style="width: 40%;">
                        <img src="http://127.0.0.1:8000/client/assets/images/logo_chienthang.jpg" alt="" style="width: 100%;/* max-width: 100%; */height: auto;padding-left: 25px;">
                    </div>
                    <div  class= "login-img">
                        <img src="http://127.0.0.1:8000/client/assets/images/tcv.svg" alt="" style="max-width: 100%; height: auto;">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="text-center mt-4 mb-4" id= "loginName"><h4>Đăng Nhập Tài Khoản</h4></div>
                    <div class="text-center mt-4 mb-4" id= "registerName"style="display: none;"><h4>Tạo Tài Khoản</h4></div>
                    <p class="text-center">
                        <a href="#" id="login-link" class="auth-link mx-2 text-decoration-none"> <i class="mdi mdi-gmail"></i>   ĐĂNG NHẬP</a> |
                        <a href="#" id="register-link" class="auth-link mx-2 text-decoration-none">ĐĂNG KÝ</a>
                    </p>
                    <div class ="m-4">
                            <form id="login-form">
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-gmail"></i></span>
                                    <input type="email" class="form-control " id="login-username" placeholder="Bạn hãy nhập email">
                                </div>
                                <p id="email-error" class="error-message" ></p>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-form-textbox-password"></i></span>
                                    <input type="password" class="form-control " id="login-password" placeholder="Bạn hãy nhập mật khẩu">
                                </div>
                                <p id="password-error" class="error-message" ></p>
                                <div class="mb-4" id="error-message" style="color: red;"></div>
                                <button type="submit" class="ant-btn-primary" onclick="validateForm()">Đăng Nhập</button>
                            </form>
                        <form id="register-form" style="display: none">
                            <div class="form1">
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-file-phone"></i></span>
                                    <input type="tel" class="form-control" id="register-phone" placeholder="Bạn hãy nhập số điện thoại">
                                </div>
                                    <p id="tel-error-container" class="error-message" ></p>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-rename-box"></i></span>
                                    <input type="text" class="form-control" id="register-name" placeholder="Bạn hãy nhập tên">
                                </div>
                                    <p id="name-error-container" class="error-message" ></p>
                                    <div class="mb-4" ></div>
                                <button type="button" class="ant-btn-primary" onclick="showForm(2)"><span>Tiếp Tục</span></button>
                            </div>

                                <div class="form2"  style="display: none;">
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="mdi mdi-gmail"></i></span>
                                        <input name="email" type="email" class="form-control" id="register-email" placeholder="Bạn hãy nhập email">
                                    </div>
                                    <p id="email_error" class="error-message"></p>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-form-textbox-password"></i></span>
                                        <input type="password" class="form-control" id="register-password" placeholder="Bạn hãy nhập mật khẩu">
                                    </div>
                                    <p id="password_error" class="error-message"></p>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend2"> <i class="mdi mdi-form-textbox-password"></i></span>
                                        <input type="password" class="form-control" id="register-confirm-password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                    <p id="confirm_password_error" class="error-message"></p>
                                    <p id="register_add" class="error-message" style="display: none" >Email đã tồn tại</p>
                                    <button type="submit" class="ant-btn-primary" onclick="validate_Form()"><span>Hoàn Thành</span></button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class ="main_information">
            <div class="text-center">

                <h2 style ="color: #00613d;"><p >Kết Nối Chiến Thắng Lines</p></h2>
                <span>Đa dạng hệ sinh thái Chien Thang Lines qua App Chien Thang: mua vé xe Chiến Thắng, Xe Hợp Đồng, Xe Buýt, Giao hàng...</span>
            </div>
            <div class="mt-10 mt-5 mb-5">
                <img src="http://127.0.0.1:8000/client/assets/images/login_banner.png" style="width: 100%;">
            </div>
        </div>
    </div>
</main>
@include('client.layout.footer');
</body>
@include('client.pages.auth.script');

