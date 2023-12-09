@extends('client.layout.main')
@section('style')
    @include('client.pages.trip.style')
    @include('client.pages.profile.style')
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="profile_pading">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group  mb-0" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">

                    <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Profile.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="profile_menu"  href="#">Thông Tin Tài Khoản</a>
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
                <div class="col-9 ml-5" style="padding-left: 50px;">
                    <div class="rounded-2xl border p-4 border_main">
                        <form id="confirm_Password" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="old_Password" class="text-gray">Mật khẩu cũ</label>
                                <input class="form-control" id="old_Password" type="password">
                                <span class="text-danger" id="oldPasswordError"></span>
                            </div>

                            <div class="form-group">
                                <label for="new_Password" class="text-gray">Mật khẩu mới</label>
                                <input class="form-control" id="new_Password" type="password">
                                <span class="text-danger" id="newPasswordError"></span>
                            </div>

                            <div class="form-group">
                                <label for="confirm_Password" class="text-gray">Xác nhận mật khẩu</label>
                                <input class="form-control" id="confirm_PasswordS" type="password">
                                <span class="text-danger" id="confirmPasswordError"></span>
                            </div>
                            <div class="mt-4 text-center">
                                <button id="changePasswordButton" type="button" class="btn btn-primary">Cập nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
@section('script')
    @include('client.pages.profile.scrip_password')
@endsection
