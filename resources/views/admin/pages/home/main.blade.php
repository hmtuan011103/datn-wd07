<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Good Morning, {{ Auth::user()->name }}!</h4>
                                        <ul>
                                            @foreach (Auth::user()->permissions as $permission)
                                                <li>{{ $permission }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div> <!-- end .h-100-->
                    </div>
                </div> <!-- end col -->
            </div> --}}
            <div class="row project-wrapper">
                <div class="col-xxl-8">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-2 fs-2">
                                                <i data-feather="briefcase"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Chuyến xe đã chạy</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="{{$get_trip_month}}">{{$get_trip_month}} Chuyến</span></h4>
                                                {{-- <span class="badge bg-danger-subtle text-danger fs-12"><i
                                                        class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                                    %</span> --}}
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Chuyến xe chạy trong tháng</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning rounded-2 fs-2">
                                                <i data-feather="award"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Người dùng mới</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="{{$get_user_month}}">{{$get_user_month}} Người</span></h4>
                                                {{-- <span class="badge bg-success-subtle text-success fs-12"><i
                                                        class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                                    %</span> --}}
                                            </div>
                                            <p class="text-muted mb-0">Số người dùng mới trong tháng</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info rounded-2 fs-2">
                                                <i data-feather="clock"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                Doanh thu</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="{{$get_revenue_month}}">{{$get_revenue_month}} Đ</span></h4>
                                                {{-- <span class="badge bg-danger-subtle text-danger fs-12"><i
                                                        class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                                    %</span> --}}
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Doanh thu trong tháng</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thống kê năm </h4>
                                    {{-- <div>
                                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                            ALL
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-soft-primary btn-sm shadow-none">
                                            1Y
                                        </button>
                                    </div> --}}
                                </div><!-- end card header -->

                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value"
                                                        data-target="{{$get_trip_year}}">{{$get_trip_year}}</span></h5>
                                                <p class="text-muted mb-0">Chuyến xe</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value"
                                                        data-target="{{$get_user_year}}">{{$get_user_year}}</span></h5>
                                                <p class="text-muted mb-0">Người dùng</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value"
                                                        data-target="{{$get_revenue_year}}">{{$get_revenue_year}}</span></h5>
                                                <p class="text-muted mb-0">Doanh thu</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-success"><span class="counter-value"
                                                        data-target="10589">0</span>h</h5>
                                                <p class="text-muted mb-0">Working Hours</p>
                                            </div>
                                        </div> --}}
                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body p-0 pb-2">
                                    <div>
                                        <div id="projects-overview-chart"
                                            data-colors='["--vz-primary", "--vz-warning", "--vz-success"]'
                                            class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
</div>
