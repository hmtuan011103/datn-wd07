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
                        <form id="userInfor" class="custom-form">
                            <div class="form-group custom-form-item has-success mb-4">
                                <div class="row custom-form-item-row mb-2">
                                    <div class="col-4 custom-form-item-label">
                                        <label for="userInfor_fullName" class="text-muted text-sm">Họ và tên:</label>
                                    </div>
                                    <div class="col-8 custom-form-item-control">
                                        <div class="custom-form-item-control-input">
                                            <span id="userInfor_fullName" class="form-control-static text-muted text-sm"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group custom-form-item has-success mb-4">
                                <div class="row custom-form-item-row mb-2">
                                    <div class="col-4 custom-form-item-label">
                                        <label for="userInfor_phoneNumber" class="text-muted text-sm">Số điện thoại:</label>
                                    </div>
                                    <div class="col-8 custom-form-item-control">
                                        <div class="custom-form-item-control-input">
                                            <span id="userInfor_phoneNumber" class="form-control-static text-muted text-sm"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group custom-form-item has-success mb-4">
                                <div class="row custom-form-item-row mb-2">
                                    <div class="col-4 custom-form-item-label">
                                        <label for = "userInfor_email" class="text-muted text-sm">Email:</label>
                                    </div>
                                    <div class="col-8 custom-form-item-control">
                                        <div class="custom-form-item-control-input">
                                            <span id="userInfor_email" class="form-control-static text-muted text-sm"></span>
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
                                            <span id="userInfor_address" class="form-control-static text-muted text-sm"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button id="editButton" type="button" class="btn btn-primary">Sửa</button>
                            </div>
                        </form>
                        <form id="editInfor" style="display: none" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nameInput" class="text-gray">Họ và tên</label>
                                <input class="form-control" id="nameInput" type="text" value="">
                            </div>
                            <div class="form-group">
                                <label for="phoneInput" class="text-gray">Số điện thoại</label>
                                <input class="form-control" id="phoneInput" type="text" value="">
                            </div>
                            <div class="form-group">
                                <label for="emailInput" class="text-gray">Email</label>
                                <input class="form-control" id="emailInput" type="text" value="">
                            </div>
                            <div class="form-group">
                                <label for="locationInput" class="text-gray">Địa chỉ</label>
                                <input class="form-control" id="locationInput" type="text" value="">
                            </div>
                            <div class="mt-4 text-center">
                                <button id="updateButton" type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form >
                </div>
            </div>
            </div>
        </div>
    </main>
    <script>
        const updateButton = document.getElementById('updateButton');
        updateButton.addEventListener('click', function () {
            const name = document.getElementById('nameInput').value;
            const phone = document.getElementById('phoneInput').value;
            const email = document.getElementById('emailInput').value;
            // const location = document.getElementById('locationInput').value;
            const data = {
                name: name,
                phone: phone,
                email: email,
                // location: location
            };


            // Sử dụng fetch hoặc AJAX để gửi dữ liệu lên API, tương tự như trong ví dụ trước đó
            fetch('http://127.0.0.1:8000/api/update', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true) {
                        alert('Cập nhật thành công');
                    } else {
                        alert('Cập nhật thất bại: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Lỗi khi gửi yêu cầu: ' + error);
                });
        });

        function getProfile() {
            fetch('http://127.0.0.1:8000/api/profile ', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true) {
                        const nameContainer = document.getElementById('userNameContainer');
                        nameContainer.textContent = data.data.name;
                        const userInfor_fullName = document.getElementById('userInfor_fullName');
                        userInfor_fullName.textContent = data.data.name;
                        const userInfor_phoneNumber = document.getElementById('userInfor_phoneNumber');
                        userInfor_phoneNumber.textContent = data.data.phone_number;
                        const userInfor_email = document.getElementById('userInfor_email');
                        userInfor_email.textContent = data.data.email;
                        const nameInput = document.getElementById('nameInput');
                        nameInput.value = data.data.name;
                        const phoneInput = document.getElementById('phoneInput');
                        phoneInput.value = data.data.phone_number;
                        const emailInput = document.getElementById('emailInput');
                        emailInput.value = data.data.email;

                    } else {
                        console.error("Lỗi: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi lấy hồ sơ: " + error);
                });
        }
        getProfile();
    </script>
@endsection

