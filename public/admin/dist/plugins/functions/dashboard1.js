/*
Template Name: AdminKit
Author: UXLiner
*/
$(function() {
    "use strict";

// ======
// Yearly Earning Starts
// ======

var day_data = [
  {"elapsed": "2012", "Sales": 70, "Earning": 200},
  {"elapsed": "2013", "Sales": 130, "Earning": 170},
  {"elapsed": "2014", "Sales": 100, "Earning": 70},
  {"elapsed": "2015", "Sales": 180, "Earning": 140},
  {"elapsed": "2016", "Sales": 70, "Earning": 230},
  {"elapsed": "2017", "Sales": 130, "Earning": 70},
  {"elapsed": "2018", "Sales": 250, "Earning": 130}
];
Morris.Line({
  element: 'earning',
  data: day_data,
  xkey: 'elapsed',
  ykeys: ['Sales', 'Earning'],
  labels: ['Sales', 'Earning'],
  fillOpacity: 0,
  pointStrokeColors: ['#fff', '#fff'],
  behaveLikeLine: true,
  gridLineColor: '#e0e0e0',
  lineWidth: 3,
  hideHover: 'auto',
  lineColors: ['#00a65a', '#008cd3'],
  resize: true
});

// ======
// Yearly Earning Ending
// ======

// ======
// Donut Chart Starts
// ======

Morris.Donut({
      element: 'donut',
      data: [
        {value: 40, label: 'In-Store Sales'},
        {value: 25, label: 'Mail-Order Sales'},
        {value: 20, label: 'Download Sales'},
        {value: 15, label: 'Latest Order'}
      ],
      backgroundColor: '#fff',
      labelColor: '#404e67',
      colors: [
        '#ff4558',
        '#ff7d4d',
        '#00a5a8',
        '#626e82'
      ],
      formatter: function (x) { return x + "%"}
    });

// ======
// Donut chart End
// ======


})(jQuery);