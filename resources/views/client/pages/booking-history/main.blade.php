<main>
    <div class="container">
        <div class="profile_pading">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group  mb-0" style="
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
">

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
                <div class="col-md-9 pading_left">
                <div class="discount-container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="listjs-table" id="customerList">
                                                    <div class="row g-4 mb-3">
                                                        <div class="col-sm">
                                                            <div class="d-flex justify-content-sm-end">
                                                                <div class="search-box ms-2">
                                                                    <input type="text" class="form-control search"
                                                                           placeholder="Search...">
                                                                    <i class="ri-search-line search-icon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive table-card mt-3 mb-1">
                                                        <table class="table align-middle table-nowrap" id="customerTable">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th data-sort="customer_name">Tuyến Đường</th>
                                                                    <th data-sort="customer_name">Số Vé</th>
                                                                    <th data-sort="customer_name">Ngày Đi</th>
                                                                    <th data-sort="customer_name">Tổng Tiền</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="customerTableBody" class="list form-check-all">

                                                            </tbody>
                                                        </table>
                                                        <div class="noresult" style="display: none">
                                                            <div class="text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                                           trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                                                           style="width:75px;height:75px">
                                                                </lord-icon>
                                                                <h5 class="mt-2">Không có bản ghi nào</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

