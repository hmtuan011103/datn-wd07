<main>
        <div class="container_one">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group  mb-0">
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Profile.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="profile_menu"  href="#">Thông tin tài khoản</a>
                            </div>
                        </li>
                        <li class="list-group-item py-2" style="padding-top: 0.7rem!important;padding-bottom: 0.7rem!important;">
                            <div class="d-flex align-items-center">
                                <img src="http://127.0.0.1:8000/client/assets/images/coutun.jpg" alt="" class="mr-2" style="margin-left: -5px;width: 40px;">
                                <a class="dropdown-item" id="discount_menu" href="#">Mã Giảm Giá</a>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/History.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="booking_history_menu" href="#">Lịch Sử Đặt Vé</a>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Password.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="password_menu" href="#">Đổi Mật Khẩu</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <h2>Danh Sách Mã Giảm Giá</h2>

                    <div class="discount-container">

                    </div>
                </div>
            </div>
        </div>
</main>
