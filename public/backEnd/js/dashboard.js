"use strict";
var url = $("#url").val();
var Labels = new Array();
var Prices = new Array();
var val = 2;
var currencySys = $(".currencyIn").val();

console.log(url);
$.get(url + "/admin/dashboard/chart/", function (response) {
    var total = 0;
    var item = 0;
    response.forEach(function (data) {
        var arr = data.split("#");
        total = parseFloat(total) + parseFloat(arr[1]);
        item = parseFloat(item) + parseFloat(arr[2]);
        Labels.push(arr[0]);
        Prices.push(parseFloat(arr[1]));
    });

    // var ctx = document.getElementById('myChart').getContext('2d');

    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: Labels,
    //         datasets: [{
    //             label: 'Total Sell',
    //             data:Prices,
    //             backgroundColor: [
    //                 'rgba(143, 52, 245, 0.3)'
    //             ],
    //             borderColor: [
    //                 '#8f34f5'
    //             ],
    //             borderWidth: 2
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                   //   beginAtZero: true
    //                   callback: function(value, index, values) {
    //                      return currencySys + value.toFixed(val);
    //                  }
    //                 }
    //             }]
    //         },
    //         legend: {
    //             display: true
    //         },
    //     }
    //   });

    var areaChartData = {
        labels: Labels,

        datasets: [
            {
                label: "Page views",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: Prices,
            },
        ],
    };

    var barChartCanvas = $("#myChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;

    // barChartData.datasets[1].fillColor = "#00a65a";
    // barChartData.datasets[1].strokeColor = "#00a65a";
    // barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate:
            '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true,
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
});
