@extends('admin.pages.statistic.index')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mx-auto">
                <div class="col col-md-3 ps-md-0 pe-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Loại xe</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ $totalTypeCar }}">
                                            {{ $totalTypeCar }}
                                        </span> Loại
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Tổng số xe</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ $totalCar }}">
                                            {{ $totalCar }}
                                        </span> Chiếc
                                    </h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary rounded-circle fs-2">
                                            <i class="mdi mdi-car"></i>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Địa điểm hoạt động</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ $totalCar }}">
                                            {{ $totalCar }}
                                        </span> Địa điểm
                                    </h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary rounded-circle fs-2">
                                            <i class="mdi mdi-car"></i>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Chuyến đi trong ngày</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ $totalCar }}">
                                            {{ $totalCar }}
                                        </span> Chuyến
                                    </h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary rounded-circle fs-2">
                                            <i class="mdi mdi-car"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
            </div>
            <div class="row mx-auto rowData">
                <div class="col-xl-12">
                        <div class="text-center pb-2 pt-3" >
                            <h3>Doanh thu - Số chuyến</h3>
                        </div>
                        <div class="form mb-3" >
                            <div class="form-data">
                                <div class="filter">
                                    <label for="start_date">Từ ngày:</label>
                                    <input type="date" class="form-control" id="start_date"
                                           onchange="handleFilterChangeDate()">
                                </div>
                                <div class="filter">
                                    <label for="end_date">Đến ngày:</label>
                                    <input type="date" class="form-control" id="end_date"
                                           onchange="handleFilterChangeDate()">
                                </div>
                                <div class="filter">
                                    <label for="yearSelect">Chọn năm:</label>
                                    <select id="yearSelect" class="form-select">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = 2020; $year <= $currentYear; $year++) {
                                            $selected = $year == $currentYear ? 'selected' : ''; // Kiểm tra năm hiện tại
                                            echo "<option value='$year' $selected>$year</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                            </div>

                            <div class="form-bottom">

                            </div>
                        </div>
                        <canvas id="revenueChart" height="100"></canvas>




                    </div>
            </div>
            <div class="row mx-auto mt-3">
                <div class="col p-0">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Xếp hạng doanh thu 10 loại xe nổi bật</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Hạng</th>
                                            <th scope="col" style="width: 62;">Loại xe</th>
                                            <th scope="col">Số chuyến đã chạy</th>
                                            <th scope="col">Số vé đã bán</th>
                                            <th scope="col">Doanh thu (đ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getTopCar as $carIndex => $car)
                                            <tr>
                                                <td>{{ ++$carIndex }}</td>
                                                <td>{{ $car->name }}</td>
                                                <td>{{ $car->total_trip }}</td>
                                                <td>{{ $car->total_seats ?? 0 }}</td>
                                                <td>{{ number_format($car->total_money, 0, ',', '.') ?? 0 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-auto">
                <div class="col col-md-3 ps-md-0">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Tuyến đường</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ count($getRoute) }}">
                                            {{ count($getRoute) }}
                                        </span> Tuyến
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
                <div class="col col-md-3 ps-md-0">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Chuyến đã đi</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{ count($getTrip) }}">
                                            {{ count($getTrip) }}
                                        </span> Chuyến
                                    </h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary rounded-circle fs-2">
                                            <i class="mdi mdi-car"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
                <div class="col col-md-6 ps-md-0">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Doanh thu tổng</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="{{$getRevenue}}">
                                            {{ number_format($getRevenue, 0, ',', '.') ?? 0 }}
                                        </span>VNĐ
                                    </h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary rounded-circle fs-2">
                                            <i class="mdi mdi-car"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thống kê năm </h4>
                            <div>
                                <div class="row" hidden>
                                 <div class="form-group">
                                     <label class="control-label">Năm</label>
                                       <select class="form-control" id="year" >
                                            <option value="2020" >2020</option>
                                            <option value="2021" >2021</option>
                                          <option value="2021" >2022</option>
                                           <option value="2023" selected>2023</option>
                                           <option value="2024" >2024</option>
                                           <option value="2025" >2025</option>
                                        </select>
                                        <span aria-hidden="true"></span>
                                   </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-header p-0 border-0 bg-light-subtle">
                            <div class="row g-0 text-center">
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value"
                                                               data-target="" id="total_trip"></span></h5>
                                        <p class="text-muted mb-0">Chuyến xe</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value"
                                                               data-target="12" id="total_ticket"></span></h5>
                                        <p class="text-muted mb-0">Số vé đã bán</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value"
                                                               data-target="12" id="total_revenue"></span></h5>
                                        <p class="text-muted mb-0">Doanh thu</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body p-0 pb-2">
                            <div>
                                <div id="projects-overview-chart"
                                     data-colors='["--vz-primary", "--vz-warning", "--vz-success"]'
                                     class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <div class="row mx-auto">
                <div class="col p-0">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Xếp hạng 10 tuyến doanh thu cao nhất</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">Hạng</th>
                                        <th scope="col" style="width: 62;">Tuyến đường</th>
                                        <th scope="col">Số chuyến xe</th>
                                        <th scope="col">Số vé đã bán</th>
                                        <th scope="col">Doanh thu (đ)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($getTopRoute as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->total_trip }}</td>
                                            <td>{{ $value->total_seats ?? 0 }}</td>
                                            <td>{{ number_format($value->total_money, 0, ',', '.') ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
