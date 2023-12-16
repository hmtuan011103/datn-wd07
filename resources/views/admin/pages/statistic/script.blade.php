<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>
<!-- apexcharts -->
<script src={{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}></script>

<script src={{ asset('admin/assets/js/pages/src/main.js') }}></script>

<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--Swiper slider js-->
<script src={{ asset('admin/assets/libs/swiper/swiper-bundle.min.js') }}></script>

<!-- Dashboard init -->

<script src={{ asset('admin/assets/js/pages/dashboard-projects.init.js') }}></script>
<script src={{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('admin/assets/libs/node-waves/waves.min.js') }}></script>
<script src={{ asset('admin/assets/libs/feather-icons/feather.min.js') }}></script>
{{-- <script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script> --}}

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    var elementDataQuery = document.querySelector("#statistic-count-car-each-type-car-data");
    var formatData = JSON.parse(elementDataQuery.value);
    var labels = [];
    var values = [];

    if (formatData.length > 0) {
        formatData.forEach(element => {
            labels.push(element.name);
            values.push(element.cars_count);
        });
    }

    var options = {
        series: values,
        chart: {
            width: 380,
            type: 'donut'
        },
        title: {
            text: '*Loại xe - Số lượng xe',
            align: 'left',
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                color: '#263238'
            },
        },
        fill: {
            type: 'gradient',
        },
        labels: labels,
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        yaxis: {
            labels: {
                formatter: function(e) {
                    return e + " xe";
                },
            },
            tickAmount: 4,
            min: 0,
        }
    };

    var chart = new ApexCharts(document.querySelector("#statistic-count-car-each-type-car"), options);
    chart.render();
</script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var myChart;

    function updateChart(labels, revenueData, tripsData, isFilterByDate) {
        if (myChart) {
            myChart.data.labels = labels;
            if (isFilterByDate) {
                myChart.data.datasets[0].data = revenueData;
                myChart.data.datasets[0].label = 'Custom Range';
                myChart.data.datasets[1].data = []; // Đặt lại dữ liệu cho trục thứ hai thành mảng trống
            } else {
                myChart.data.datasets[0].data = revenueData;
                myChart.data.datasets[0].label = 'Doanh thu';
                myChart.data.datasets[1].data = tripsData; // Dữ liệu số chuyến
                myChart.data.datasets[1].label = 'Số chuyến';
            }

            myChart.update();
        } else {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: isFilterByDate ? 'Custom Range' : 'Doanh thu',
                            data: isFilterByDate ? tripsData : revenueData, // Dữ liệu hiển thị tương ứng
                            yAxisID: 'revenueAxis', // ID của trục doanh thu
                            backgroundColor: isFilterByDate ? '#0D71B9' : 'rgba(54, 162, 235, 0.5)',
                            borderColor: isFilterByDate ? '#0D71B9' : 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Số chuyến',
                            data: isFilterByDate ? [] :
                            tripsData, // Nếu lọc theo ngày, không có dữ liệu cho trục thứ hai
                            yAxisID: 'tripAxis', // ID của trục số chuyến
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        revenueAxis: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        tripAxis: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        indexAxis: 'y', // Thiết lập indexAxis nếu bạn đang sử dụng biểu đồ dạng bar
                        barThickness: 20, // Điều chỉnh kích thước của cột
                        // ... các cài đặt khác
                    }
                }
            });
        }
    }


    function handleFilterChangeDate() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        if (startDate !== '' && endDate !== '') {
            fetch('/api/getFilter', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        startDate: startDate,
                        endDate: endDate
                    })
                })
                .then(response => response.json())
                .then(data => {
                    var labels = data.labels;
                    var revenueData = data.data;
                    var tripData = data.trips_count; // Dữ liệu số lượng chuyến đi từ API

                    updateChart(labels, revenueData, tripData, false); // Gọi hàm để vẽ biểu đồ cột ghép

                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            var currentYear = document.querySelector('#yearSelect').value;
            fetch('/api/getRevenueData?year=' + currentYear)
                .then(response => response.json())
                .then(data => {
                    var labels = Array.from({
                        length: 12
                    }, (_, index) => 'Tháng ' + (index + 1));

                    var revenueData = Array(12).fill(0);

                    var tripsData = Array(12).fill(0);


                    data.forEach(item => {

                        revenueData[item.month - 1] = item.total;
                        tripsData[item.month - 1] = item.total_trips;
                    });

                    // Gọi hàm để tạo biểu đồ ban đầu khi trang được tải
                    updateChart(labels, revenueData, tripsData, false);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }



    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;

        fetch('/api/getRevenueData?year=' + selectedYear)
            .then(response => response.json())
            .then(data => {
                var labels = Array.from({
                    length: 12
                }, (_, index) => 'Tháng ' + (index + 1));
                var revenueData = Array(12).fill(0);
                var tripsData = Array(12).fill(0);

                data.forEach(item => {
                    revenueData[item.month - 1] = item.total;
                    tripsData[item.month - 1] = item.total_trips;
                });

                updateChart(labels, revenueData, tripsData, false); // Hiển thị biểu đồ theo năm

            })
            .catch(error => {
                console.error('Error:', error);
            });
    });


    window.onload = function() {
        var currentYear = document.querySelector('#yearSelect').value;
        fetch('/api/getRevenueData?year=' + currentYear)
            .then(response => response.json())
            .then(data => {
                var labels = Array.from({
                    length: 12
                }, (_, index) => 'Tháng ' + (index + 1));

                var revenueData = Array(12).fill(0);

                var tripsData = Array(12).fill(0);


                data.forEach(item => {

                    revenueData[item.month - 1] = item.total;
                    tripsData[item.month - 1] = item.total_trips;
                });

                // Gọi hàm để tạo biểu đồ ban đầu khi trang được tải
                updateChart(labels, revenueData, tripsData, false);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };
</script>

{{-- <script>
    var UserNotAcount = @json($UserNotAcount);
    var UserAcount = @json($UserAcount);
    var UserBookCustomer = @json($UserBookCustomer);

    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Khách đặt trực tiếp', 'Khách có tài khoản', 'Khách không có tài khoản'],
            datasets: [{
                label: 'User Types',
                data: [UserNotAcount, UserAcount, UserBookCustomer],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            // Cấu hình thêm nếu cần
        }
    });
</script> --}}

<script>
    // userChart.js (đoạn mã JavaScript độc lập)
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/user-data')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Kiểm tra dữ liệu nhận được từ server

                // Sử dụng dữ liệu trong biểu đồ
                var ctx = document.getElementById('userChart').getContext('2d');
                var userChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Khách không có tài khoản', 'Khách có tài khoản',
                            'Khách đặt trực tiếp'
                        ],
                        datasets: [{
                            label: 'Tổng số',
                            data: [data.UserNotAcount, data.UserAcount, data
                                .UserBookCustomer
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        // Cấu hình thêm nếu cần
                    }
                });
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    });
</script>

<script>
    fetch('/api/countUserType')
        .then(response => response.json())
        .then(data => {
            const labels = [];
            const userNotACountData = [];
            const userACountData = [];
            const userBookCustomerData = [];

            data.forEach(monthData => {
                labels.push(`Tháng ${monthData.month}`);
                userNotACountData.push(monthData.userNotACount);
                userACountData.push(monthData.userACount);
                userBookCustomerData.push(monthData.userBookCustomer);
            });

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Khách không có tài khoản',
                            data: userNotACountData,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Khách có tài khoản',
                            data: userACountData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Khách đặt trực tiếp',
                            data: userBookCustomerData,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
