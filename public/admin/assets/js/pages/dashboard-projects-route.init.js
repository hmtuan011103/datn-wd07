window.addEventListener('DOMContentLoaded', function () {
  selectElement.value = 2023;
  selectElement.dispatchEvent(new Event('change'));
});
var selectElement = document.getElementById('year');

selectElement.addEventListener('change', updateChart);
function updateChart() {
  var selectedValue = selectElement.value;
  fetch("http://127.0.0.1:8000/api/get_data_route?year=" + selectedValue)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      dataChart(data)
      const trip = document.getElementById('total_trip');
      const ticket = document.getElementById('total_ticket');
      const revenue = document.getElementById('total_revenue');
      let total_trip = 0;
      for (const key in data[0][0]) {
        total_trip += data[0][0][key];
      }
      let total_ticket = 0;
      for (const key in data[0][1]) {
        total_ticket += data[0][1][key];
      }
      let total_revenue = 0;
      for (const key in data[0][2]) {
        total_revenue += data[0][2][key];
      }
      const formattedNumber = total_revenue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
      trip.innerText = total_trip;
      ticket.innerText = total_ticket;
      revenue.innerText = formattedNumber;
    })
    .catch(function (error) {
      console.log("Đã xảy ra lỗi:", error);
    });
}

function dataChart(data) {
  var datatrip = Object.values(data[0][0])
  var datauser = Object.values(data[0][1])
  var datarevenue = Object.values(data[0][2]).map(function (value) {
    return value / 1000000;
  });

  function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
      var t = document.getElementById(e).getAttribute("data-colors");
      if (t)
        return (t = JSON.parse(t)).map(function (e) {
          var t = e.replace(" ", "");
          return -1 === t.indexOf(",")
            ? getComputedStyle(document.documentElement).getPropertyValue(t) || t
            : 2 == (e = e.split(",")).length
              ? "rgba(" +
              getComputedStyle(document.documentElement).getPropertyValue(e[0]) +
              "," +
              e[1] +
              ")"
              : t;
        });
      console.warn("data-colors Attribute not found on:", e);
    }
  }
  var options,
    chart,
    linechartcustomerColors = getChartColorsArray("projects-overview-chart"),
    isApexSeriesData =
      (linechartcustomerColors &&
        ((options = {
          series: [
            {
              name: "Chuyến xe",
              type: "bar",
              data: datatrip,
            },
            {
              name: "Doanh thu",
              type: "area",
              data: datarevenue
            },
            {
              name: "Số vé đã bán",
              type: "bar",
              data: datauser,
            },
          ],
          chart: { height: 374, type: "line", toolbar: { show: !1 } },
          stroke: { curve: "smooth", dashArray: [0, 3, 0], width: [0, 1, 0] },
          fill: { opacity: [1, 0.1, 1] },
          markers: { size: [0, 4, 0], strokeWidth: 2, hover: { size: 4 } },
          xaxis: {
            categories: [
              "Tháng 1",
              "Tháng 2",
              "Tháng 3",
              "Tháng 4",
              "Tháng 5",
              "Tháng 6",
              "Tháng 7",
              "Tháng 8",
              "Tháng 9",
              "Tháng 10",
              "Tháng 11",
              "Tháng 12",
            ],
            axisTicks: { show: !1 },
            axisBorder: { show: !1 },
          },
          grid: {
            show: !0,
            xaxis: { lines: { show: !0 } },
            yaxis: { lines: { show: !1 } },
            padding: { top: 0, right: -2, bottom: 15, left: 10 },
          },
          legend: {
            show: !0,
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: -5,
            markers: { width: 9, height: 9, radius: 6 },
            itemMargin: { horizontal: 10, vertical: 0 },
          },
          plotOptions: { bar: { columnWidth: "30%", barHeight: "70%" } },
          colors: linechartcustomerColors,
          tooltip: {
            shared: !0,
            y: [
              {
                formatter: function (e) {
                  return void 0 !== e ? e.toFixed(0) : e;
                },
              },
              {
                formatter: function (e) {
                  return void 0 !== e ? e.toFixed(3) + "k" : e;
                },
              },
              {
                formatter: function (e) {
                  return void 0 !== e ? e.toFixed(0) : e;
                },
              },
            ],
          },
        }),
          (chart = new ApexCharts(
            document.querySelector("#projects-overview-chart"),
            options
          ))),
       {});
    // chart.updateSeries(data);
    chart.render()
    // dataChart(data)
    // isApexSeries = document.querySelectorAll("[data-chart-series]"),
    // donutchartProjectsStatusColors =
    //   (isApexSeries &&
    //     Array.from(isApexSeries).forEach(function (e) {
    //       var t,
    //         e = e.attributes;
    //       e["data-chart-series"] &&
    //         ((isApexSeriesData.series = e["data-chart-series"].value.toString()),
    //           (t = getChartColorsArray(e.id.value.toString())),
    //           (t = {
    //             series: [isApexSeriesData.series],
    //             chart: {
    //               type: "radialBar",
    //               width: 36,
    //               height: 36,
    //               sparkline: { enabled: !0 },
    //             },
    //             dataLabels: { enabled: !1 },
    //             plotOptions: {
    //               radialBar: {
    //                 hollow: { margin: 0, size: "50%" },
    //                 track: { margin: 1 },
    //                 dataLabels: { show: !1 },
    //               },
    //             },
    //             colors: t,
    //           }),
    //           new ApexCharts(
    //             document.querySelector("#" + e.id.value.toString()),
    //             t
    //           ).render());
    //     }),
    //     getChartColorsArray("prjects-status"))
    //     ,
    // currentChatId =
    //   (donutchartProjectsStatusColors &&
    //     ((options = {
    //       series: [125, 42, 58, 89],
    //       labels: ["Completed", "In Progress", "Yet to Start", "Cancelled"],
    //       chart: { type: "donut", height: 230 },
    //       plotOptions: {
    //         pie: {
    //           size: 100,
    //           offsetX: 0,
    //           offsetY: 0,
    //           donut: { size: "90%", labels: { show: !1 } },
    //         },
    //       },
    //       dataLabels: { enabled: !1 },
    //       legend: { show: !1 },
    //       stroke: { lineCap: "round", width: 0 },
    //       colors: donutchartProjectsStatusColors,
    //     }),
    //       (chart = new ApexCharts(
    //         document.querySelector("#prjects-status"),
    //         options
    //       )).render()),
    //     "users-chat");
  // function scrollToBottom(e) {
  //   setTimeout(() => {
  //     new SimpleBar(
  //       document.getElementById("chat-conversation")
  //     ).getScrollElement().scrollTop =
  //       document.getElementById("users-conversation").scrollHeight;
  //   }, 100);
  // }
  // scrollToBottom(currentChatId);
}



