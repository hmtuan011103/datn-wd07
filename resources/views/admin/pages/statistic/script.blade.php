<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>
<!-- apexcharts -->
<script src={{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}></script>

<script src={{ asset('admin/assets/js/pages/src/main.js') }}></script>

<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Vector map-->
{{-- <script src={{ asset('admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}></script> --}}
{{-- <script src={{ asset('admin/assets/libs/jsvectormap/maps/world-merc.js') }}></script> --}}

<!--Swiper slider js-->
<script src={{ asset('admin/assets/libs/swiper/swiper-bundle.min.js') }}></script>

<!-- Dashboard init -->
{{-- <script src={{ asset('admin/assets/js/pages/dashboard-ecommerce.init.js') }}></script> --}}
{{-- <script src={{ asset('admin/assets/js/pages/apexcharts.min.js') }}></script> --}}
<script src={{ asset('admin/assets/js/pages/dashboard-projects-route.init.js') }}></script>
<script src={{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('admin/assets/libs/node-waves/waves.min.js') }}></script>
<script src={{ asset('admin/assets/libs/feather-icons/feather.min.js') }}></script>
{{-- <script src={{ asset('admin/assets/js/app.js') }}></script> --}}
{{-- <script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script> --}}

{{-- <script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}

<!-- listjs init -->
{{-- <script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script> --}}

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

{{-- labels: ["Desktop", "Mobile", "Tablet"],
	chart: { type: "donut", height: 219 },
plotOptions: { pie: { size: 100, donut: { size: "76%" } } },
dataLabels: { enabled: !1 },
legend: {
	show: !1,
		position: "bottom",
			horizontalAlign: "center",
				offsetX: 0,
					offsetY: 0,
						markers: { width: 20, height: 6, radius: 2 },
	itemMargin: { horizontal: 12, vertical: 0 },
	formatter: function(val, opts) {
		return 'Loại: ' + val.toUpperCase() + "<br>Số xe: " + opts.w.globals.series[opts
			.seriesIndex];
	}

},
stroke: { width: 0 },
yaxis: {
	labels: {
		formatter: function (e) {
			return e + "k Users";
		},
	},
	tickAmount: 4,
		min: 0,
		},


 --}}


{{-- <script>
    var labels = {!! $labels !!}; // Dữ liệu nhãn từ PHP sang JavaScript
    var dataDaily = {!! $dataDaily !!}; // Dữ liệu doanh thu từ PHP sang JavaScript

    var ctx = document.getElementById('revenueDay').getContext('2d');
    var revenueDay = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu theo ngày',
                data: dataDaily,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },

    });
</script> --}}

{{-- <script>
    var ctx = document.getElementById('revenueDay').getContext('2d');
    var revenueDay; // Biến để lưu biểu đồ

    function updateChart() {
        var valueToNameMap = {
            'all': 'Tất cả',
            '7_days': '7 ngày qua',
            'last_month': 'Tháng trước',
            'this_month': 'Tháng này',
            '365_days': '365 ngày'
        };

        var filter = document.getElementById('filter').value;
        var label = valueToNameMap[filter];




        fetch('/api/getFilter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    filter: filter,

                })
            })
            .then(response => response.json())
            .then(data => {
                // Xử lý dữ liệu nhãn và doanh thu từ API
                var labels = data.labels;
                var dataDaily = data.data;

                // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                if (revenueDay) {
                    revenueDay.destroy();
                }

                // Tạo biểu đồ mới với dữ liệu từ API
                revenueDay = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: dataDaily,
                            backgroundColor: '#0D71B9',
                            borderColor: '#0D71B9',
                            borderWidth: 1
                        }]
                    },
                    options: {

                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 20
                                }
                            }]
                        },
                        maxBarThickness: 50 // Điều chỉnh kích thước cột tối đa
                    }

                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

    }

    // Gọi hàm updateChart khi trang được load để vẽ biểu đồ mặc định
    window.onload = function() {
        updateChart();
    };
</script>

<script>
    var ctx = document.getElementById('revenueDay').getContext('2d');
    var revenueDay; // Biến để lưu biểu đồ

    function updateChartDate() {
        var valueToNameMap = {
            'all': 'Tất cả',
            '7_days': '7 ngày qua',
            'last_month': 'Tháng trước',
            'this_month': 'Tháng này',
            '365_days': '365 ngày'
        };



        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;


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
                // Xử lý dữ liệu nhãn và doanh thu từ API
                var labels = data.labels;
                var dataDaily = data.data;

                // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                if (revenueDay) {
                    revenueDay.destroy();
                }

                // Tạo biểu đồ mới với dữ liệu từ API
                revenueDay = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: dataDaily,
                            backgroundColor: '#0D71B9',
                            borderColor: '#0D71B9',
                            borderWidth: 1
                        }]
                    },
                    options: {

                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 20
                                }
                            }]
                        },
                        maxBarThickness: 50 // Điều chỉnh kích thước cột tối đa
                    }

                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

    }

    // Gọi hàm updateChart khi trang được load để vẽ biểu đồ mặc định
    window.onload = function() {
        updateChart();
    };
</script> --}}


{{-- <script>
    var ctx = document.getElementById('revenueDay').getContext('2d');
    var revenueDay; // Biến để lưu biểu đồ

    function updateChart() {
        var valueToNameMap = {
            'all': 'Tất cả',
            '7_days': '7 ngày qua',
            'last_month': 'Tháng trước',
            'this_month': 'Tháng này',
            '365_days': '365 ngày'
        };

        var filter = document.getElementById('filter').value;
        var label = valueToNameMap[filter];
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        if (startDate != "" || endDate != "") {

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
                    // Xử lý dữ liệu nhãn và doanh thu từ API
                    var labels = data.labels;
                    var dataDaily = data.data;

                    // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                    if (revenueDay) {
                        revenueDay.destroy();
                    }

                    // Tạo biểu đồ mới với dữ liệu từ API
                    revenueDay = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: label,
                                data: dataDaily,
                                backgroundColor: '#0D71B9',
                                borderColor: '#0D71B9',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        autoSkip: true,
                                        maxTicksLimit: 20
                                    }
                                }]
                            },
                            maxBarThickness: 50 // Điều chỉnh kích thước cột tối đa
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        if(filter) {
            fetch('/api/getFilter', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        filter: filter
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Xử lý dữ liệu nhãn và doanh thu từ API
                    var labels = data.labels;
                    var dataDaily = data.data;

                    // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                    if (revenueDay) {
                        revenueDay.destroy();
                    }

                    // Tạo biểu đồ mới với dữ liệu từ API
                    revenueDay = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: label,
                                data: dataDaily,
                                backgroundColor: '#0D71B9',
                                borderColor: '#0D71B9',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        autoSkip: true,
                                        maxTicksLimit: 20
                                    }
                                }]
                            },
                            maxBarThickness: 50 // Điều chỉnh k
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
</script> --}}



{{-- <script>
    var ctx = document.getElementById('revenueDay').getContext('2d');
    var revenueDay; // Biến để lưu biểu đồ

    function updateChartByFilter(filter) {
        var valueToNameMap = {
            'all': 'Tất cả',
            '7_days': '7 ngày qua',
            'last_month': 'Tháng trước',
            'this_month': 'Tháng này',
            '365_days': '365 ngày'
        };

        var label = valueToNameMap[filter];


        fetch('/api/getFilter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    filter: filter
                })
            })
            .then(response => response.json())
            .then(data => {
                // Xử lý dữ liệu nhãn và doanh thu từ API
                var labels = data.labels;
                var dataDaily = data.data;

                // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                if (revenueDay) {
                    revenueDay.destroy();
                }

                // Tạo biểu đồ mới với dữ liệu từ API
                revenueDay = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: dataDaily,
                            backgroundColor: '#0D71B9',
                            borderColor: '#0D71B9',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 20
                                }
                            }]
                        },
                        maxBarThickness: 50 // Điều chỉnh kích thước cột tối đa
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function handleFilterChange() {
        var filter = document.getElementById('filter').value;


        // Reset giá trị của startDate và endDate khi chọn select option

        if (filter != "") {
            updateChartByFilter(filter);
        }



    }
</script> --}}
{{-- <script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueDay; // Biến để lưu biểu đồ


    function updateChartByDate(startDate, endDate) {
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
                // Xử lý dữ liệu nhãn và doanh thu từ API
                var labels = data.labels;
                var dataDaily = data.data;

                // Xóa biểu đồ hiện tại nếu đã được tạo trước đó
                if (revenueDay) {
                    revenueDay.destroy();
                }

                // Tạo biểu đồ mới với dữ liệu từ API
                revenueDay = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Custom Range',
                            data: dataDaily,
                            backgroundColor: '#0D71B9',
                            borderColor: '#0D71B9',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 20
                                }
                            }]
                        },
                        maxBarThickness: 50 // Điều chỉnh kích thước cột tối đa
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function handleFilterChangeDate() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        // Reset giá trị của startDate và endDate khi chọn select option

        if (startDate != '' && endDate != '') {
            updateChartByDate(startDate, endDate);


        }



    }
</script>

<script>
    var myChart;

    function updateChart(labels, revenueData, tripsData) {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        if (myChart) {
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = revenueData;
            myChart.data.datasets[1].data = tripsData;
            myChart.update(); // Cập nhật biểu đồ với dữ liệu mới
        } else {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Doanh thu',
                            data: revenueData,
                            yAxisID: 'revenueAxis',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Số chuyến',
                            data: tripsData,
                            yAxisID: 'tripAxis',
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
                        }
                    }
                }
            });
        }
    }

    // Xử lý sự kiện khi select option thay đổi
    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;

        // Gửi yêu cầu lấy dữ liệu từ API
        fetch('/api/getRevenueData?year=' + selectedYear)
            .then(response => response.json())
            .then(data => {

                var labels = Array.from({
                    length: 12
                }, (_, index) => 'Tháng ' + (index + 1));
                var revenueData = Array(12).fill(0);
                var tripData = Array(12).fill(0);
                var totalRevenue = 0;
            var totalTrips = 0;

                data.forEach(item => {
                    revenueData[item.month - 1] = item.total;
                    tripData[item.month - 1] = item.total_trips;

                });

                // Gọi hàm để cập nhật hoặc vẽ biểu đồ mới
                updateChart(labels, revenueData, tripData);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });


    // Gửi yêu cầu khi trang được tải
    // Gửi yêu cầu khi trang được tải
    window.onload = function() {
        var currentYear = '<?php echo $currentYear; ?>';
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
                updateChart(labels, revenueData, tripsData);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };
</script> --}}

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
                            data: isFilterByDate ? tripsData :  revenueData, // Dữ liệu hiển thị tương ứng
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

        if (startDate !== '' && endDate !== '' && startDate <= endDate ) {
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
