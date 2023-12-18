@extends('admin.pages.statistic.index')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="text-center pb-4">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="row mx-auto pb-5">
                    <div class="col col-md-3 ps-md-0 pe-md-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="height: 80px">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Tổng nhân viên</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $sumStaff }}">
                                                 {{ $sumStaff }}
                                            </span>
                                            <span>Người</span>
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div>
                    <div class="col col-md-3 ps-md-0 pe-md-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="height: 80px">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Tài xế</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $sumDriver }}">
                                                {{ $sumDriver }}
                                            </span>
                                            <span>Người</span>
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div>
                    <div class="col col-md-3 ps-md-0 pe-md-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="height: 80px">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Phụ xe</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $sumAssistant }}">
                                                {{ $sumAssistant }}
                                            </span>
                                            <span>Người</span>
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div>
                    <div class="col col-md-3 ps-md-0 pe-md-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="height: 80px">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Bán vé</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $sumTickerSeller }}">
                                                {{ $sumTickerSeller }}
                                            </span>
                                            <span>Người</span>
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class="col-xl-4 col-lg-6 p-0">
                        <canvas id="userChart" width="400" height="400"></canvas>
                    </div>

                    <div class="col p-0 px-lg-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Xếp hạng 10 khách hàng nổi bật</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Hạng</th>
                                                <th scope="col" style="width: 62;">Tên khách</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số vé đã mua</th>
                                                <th scope="col">Tổng tiền phải trả (đ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topUser as $userIndex => $user)
                                                <tr>
                                                    <td>{{ ++$userIndex }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->total_seats ?? 0 }}</td>
                                                    <td>{{ number_format($user->total_payment, 0, ',', '.') ?? 0 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col p-0 px-lg-4 pt-5">
                        <div class="card card-height-100">
                            <div class="text-center pb-2 pt-4">
                                <h3>Tài khoản mới trong năm</h3>
                            </div>
                            <div class="pb-3">
                                <canvas id="myChart" height="180" width="400"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="getDrive">
                    <div class="col p-0 px-lg-4 py-3">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Danh sách tài xế</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col" style="width: 62;">Tên tài xế</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Số chuyến đã chạy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getCountDriver as $driverIndex => $driver)
                                                <tr>
                                                    <td>{{ ++$driverIndex }}</td>
                                                    <td>{{ $driver->name }}</td>
                                                    <td>{{ $driver->phone_number }}</td>
                                                    <td>{{ $driver->total_finished_trips ?? 0 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col p-0 px-lg-4 py-3">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Danh sách phụ xe</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col" style="width: 62;">Tên phụ xe</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Số chuyến đã chạy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getCountAssistant as $assistantIndex => $assistant)
                                                <tr>
                                                    <td>{{ ++$assistantIndex }}</td>
                                                    <td>{{ $assistant->name }}</td>
                                                    <td>{{ $assistant->phone_number }}</td>
                                                    <td>{{ $assistant->total_finished_trips ?? 0 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
