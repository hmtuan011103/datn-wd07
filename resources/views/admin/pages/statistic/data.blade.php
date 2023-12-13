@extends('admin.pages.statistic.index')
@section('content')
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
                    <div class="col-xxl-12">
                        <div class="row">



                        </div><!-- end col -->


                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="filter">
                                    <label for="">Lọc:</label>
                                    <select class="form-select" id="filter" onchange="handleFilterChange()">
                                        <option value="all">Tất cả</option>
                                        <option value="7_days">7 ngày qua</option>
                                        <option value="last_month">Tháng trước</option>
                                        <option value="this_month">Tháng này</option>
                                        <option value="365_days">365 ngày</option>
                                    </select>
                                </div>


                                <div class="filter">
                                    <label for="start_date">Từ ngày:</label>
                                    <input type="date" class="form-control" id="start_date" onchange="handleFilterChangeDate()">
                                </div>

                                <div class="filter">
                                    <!-- Thêm input ngày kết thúc -->
                                    <label for="end_date">Đến ngày:</label>
                                    <input type="date"  class="form-control" id="end_date" onchange="handleFilterChangeDate()">
                                </div>
                                <canvas id="revenueDay"></canvas>
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
@endsection
