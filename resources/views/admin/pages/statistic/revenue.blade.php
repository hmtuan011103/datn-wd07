@extends('admin.pages.statistic.index')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row project-wrapper">
                    <div class="col-xxl-12">
                        <div class="row">
                        </div>
                    </div>
                    <div class="row rowData">
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
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
