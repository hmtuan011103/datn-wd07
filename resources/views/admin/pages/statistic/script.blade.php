<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>
<!-- apexcharts -->
<script src={{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}></script>

<script src={{ asset('admin/assets/js/pages/src/main.js') }}></script>


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
