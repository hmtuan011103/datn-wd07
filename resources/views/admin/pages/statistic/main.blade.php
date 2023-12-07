<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mx-auto">
                <div class="col col-md-2 ps-md-0 pe-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Loại xe</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="28.05">
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
                <div class="col col-md-2 ps-md-0 pe-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Tổng số xe</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="28.05">
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
            </div>

            <div class="row mx-auto">
                <div class="col-xl-4 col-lg-6 p-0">
                    <div class="card">
                        <div class="row p-3">
                            <div class="card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Số lượng xe theo loại xe</h4>
                                </div>
                                <div class="card-body">
                                    <div id="statistic-count-car-each-type-car" class="apex-charts" dir="ltr">
                                        <input type="text" value="{{ $statisticTypeCar }}"
                                            id="statistic-count-car-each-type-car-data" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col p-0 px-lg-4">
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
        </div>
    </div>
