"use strict";

var statistics_chart = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'line',
  data: {
    labels: ["6 feb", "7 feb", "8 feb", "9 feb", "10 feb", "11 feb", "12 feb"],
    datasets: [{
      label: 'USD ',
      data: [130, 98, 210, 123, 58, 99, 130],
      borderWidth: 2,
      borderColor: '#6777ef',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
      pointRadius: 0
    }]
  },
  options: {
    responsive: true,
    tooltips: {
      mode: 'index',
      intersect: false,
    },
   hover: {
      mode: 'nearest',
      intersect: true
    },
    legend: {
      display: false
    },
    elements:{
      line:{
        tension:0.2,
      },
    }
    ,
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 20
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});


var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [
        350,
        500,
        125,
        25,
      ],
      backgroundColor: [
        '#7f7f7f',
        '#63ed7a',
        '#fc544b',
        '#ffa426',

      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Free Users',
      'Upgraded',
      'Expired',
      'none'
    ],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
  }
});

$('#visitorMap').vectorMap(
{
  map: 'world_en',
  backgroundColor: '#ffffff',
  borderColor: '#f2f2f2',
  borderOpacity: .8,
  borderWidth: 1,
  hoverColor: '#000',
  hoverOpacity: .8,
  color: '#ddd',
  normalizeFunction: 'linear',
  selectedRegions: false,
  showTooltip: true,
  pins: {
    id: '<div class="jqvmap-circle"></div>',
    my: '<div class="jqvmap-circle"></div>',
    th: '<div class="jqvmap-circle"></div>',
    sy: '<div class="jqvmap-circle"></div>',
    eg: '<div class="jqvmap-circle"></div>',
    ae: '<div class="jqvmap-circle"></div>',
    nz: '<div class="jqvmap-circle"></div>',
    tl: '<div class="jqvmap-circle"></div>',
    ng: '<div class="jqvmap-circle"></div>',
    si: '<div class="jqvmap-circle"></div>',
    pa: '<div class="jqvmap-circle"></div>',
    au: '<div class="jqvmap-circle"></div>',
    ca: '<div class="jqvmap-circle"></div>',
    tr: '<div class="jqvmap-circle"></div>',
  },
});

// weather
getWeather();
setInterval(getWeather, 600000);

function getWeather() {
  $.simpleWeather({
  location: 'Bogor, Indonesia',
  unit: 'c',
  success: function(weather) {
    var html = '';
    html += '<div class="weather">';
    html += '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' + weather.code + '"></span></div>';
    html += '<div class="weather-desc">';
    html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
    html += '<div class="weather-text">' + weather.currently + '</div>';
    html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
    html += '<li> <i class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
    html += '</div>';
    html += '</div>';

    $("#myWeather").html(html);
  },
  error: function(error) {
    $("#myWeather").html('<div class="alert alert-danger">'+error+'</div>');
  }
  });
}
