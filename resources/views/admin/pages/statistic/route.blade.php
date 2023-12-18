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
                <div class="col col-md-3 ps-md-0 pe-md-4">
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
                <div class="col col-md-4 ps-md-0 pe-md-4">
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
                                <div class="row">
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
        </div>
    </div>
    @endsection
