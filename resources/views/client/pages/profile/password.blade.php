@extends('client.layout.main')
@section('style')
    @include('client.pages.trip.style')
    @include('client.pages.profile.style')
@endsection
@section('content')
    <main>
        <div class="container_one">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group  mb-0">
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Profile.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="profile" href="#">Thông tin tài khoản</a>
                            </div>
                        </li>
                        <li class="list-group-item py-2" style="padding-top: 0.7rem!important;padding-bottom: 0.7rem!important;">
                            <div class="d-flex align-items-center">
                                <img src="http://127.0.0.1:8000/client/assets/images/coutun.jpg" alt="" class="mr-2" style="margin-left: -5px;width: 40px;">
                                <a class="dropdown-item" href="#">Mã Giảm Giá</a>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/History.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" href="#">Lịch Sử Đặt Vé</a>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Password.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="password" href="#">Đổi Mật Khẩu</a>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('client/assets/images/Logout.svg') }}" alt="" class="mr-2">
                                <a class="dropdown-item" id="logoutButton">Đăng Xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <div class="text-center text-md-left">
                        <h2 class="text-xl font-medium text-[#111111]"> Đặt lại mật khẩu</h2>
                        <p class="text-gray mt-3 mb-4 text-[13px]"> Để bảo mật tài khoản, vui lòng không chia sẻ mật
                            khẩu cho người khách</p>
                    </div>
                    <div class="mt-6 rounded-2xl border p-3 border_main">
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
    </main>
@endsection
@section('script')
    @include('client.pages.profile.scrip_password')
@endsection
