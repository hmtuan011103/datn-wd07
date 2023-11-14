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
                        <h2 class="text-xl font-medium text-[#111111]">Thông tin tài khoản</h2>
                        <p class="text-gray mt-3 mb-4 text-[13px]">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    </div>
                    <div class="mt-6 rounded-2xl border p-3">
                       <div class="row" id="userInfor">
                           <div class="col-4 mb-4 text-center">
                               <img src="{{ asset('client/assets/images/Facebook-Avatar_3.png') }}" alt="Avatar" class="rounded-circle avatar-image mb-2">
                               <div id="paymentSteps" class="step-container mt-4">
                                   <div class="step">
                                       <div class="step-circle"></div>
                                       <div data-step="1">V1</div>
                                   </div>
                                   <div class="step">
                                       <div class="step-circle"></div>
                                       <div data-step="2">V2</div>
                                   </div>
                                   <div class="step">
                                       <div class="step-circle"></div>
                                       <div data-step="3">V3</div>
                                   </div>
                                   <div class="step">
                                       <div class="step-circle"></div>
                                       <div data-step="4">V4</div>
                                   </div>
                                   <div class="line"></div>
                               </div>
                           </div>
                           <div class="col-1"></div>
                           <div class="col-7 mt-5 ml-5">
                               <form class="custom-form">
                                   <div class="form-group custom-form-item has-success mb-4">
                                       <div class="row custom-form-item-row mb-2">
                                           <div class="col-4 custom-form-item-label">
                                               <label for="userInfor_fullName" class="text-muted text-sm">Họ và tên:</label>
                                           </div>
                                           <div class="col-8 custom-form-item-control">
                                               <div class="custom-form-item-control-input">
                                            <span id="userInfor_fullName"
                                                  class="form-control-static text-muted text-sm"></span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group custom-form-item has-success mb-4">
                                       <div class="row custom-form-item-row mb-2">
                                           <div class="col-4 custom-form-item-label">
                                               <label for="userInfor_phoneNumber" class="text-muted text-sm">Số điện
                                                   thoại:</label>
                                           </div>
                                           <div class="col-8 custom-form-item-control">
                                               <div class="custom-form-item-control-input">
                                            <span id="userInfor_phoneNumber"
                                                  class="form-control-static text-muted text-sm"></span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group custom-form-item has-success mb-4">
                                       <div class="row custom-form-item-row mb-2">
                                           <div class="col-4 custom-form-item-label">
                                               <label for="userInfor_email" class="text-muted text-sm">Email:</label>
                                           </div>
                                           <div class="col-8 custom-form-item-control">
                                               <div class="custom-form-item-control-input">
                                            <span id="userInfor_email"
                                                  class="form-control-static text-muted text-sm"></span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group custom-form-item has-success mb-4">
                                       <div class="row custom-form-item-row mb-2">
                                           <div class="col-4 custom-form-item-label">

                                               <label for="userInfor_address" class="text-muted text-sm">Địa chỉ:</label>
                                           </div>
                                           <div class="col-8 custom-form-item-control">
                                               <div class="custom-form-item-control-input">
                                            <span id="userInfor_location"
                                                  class="form-control-static text-muted text-sm"></span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="mt-4 text-center">
                                       <button id="editButton" type="button" class="btn btn-primary">Sửa</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                        <form id="edit_Profile" method="POST" style="display: none">
                            @csrf
                            <div class="form-group">
                                <label for="name_Profile" class="text-gray">Họ và tên</label>
                                <input class="form-control" id="name_Profile" type="text" value="">
                                <span id="nameError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="phone_Profile" class="text-gray">Số điện thoại</label>
                                <input class="form-control" id="phone_Profile" type="text" value="">
                                <span id="phoneError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="email_Profile" class="text-gray">Email</label>
                                <input class="form-control" id="email_Profile" type="text" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="location_Profile" class="text-gray">Địa chỉ</label>
                                <input class="form-control" id="location_Profile" type="text" value="">
                            </div>
                            <div class="mt-4 text-center">
                                <button id="update_Profile" type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @include('client.pages.profile.script_profile')
@endsection
