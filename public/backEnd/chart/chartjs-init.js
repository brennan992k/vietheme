
(function ($) {
    "use strict";

    const ctx = document.getElementById("highlights").getContext('2d');
    const gradientStroke1 = ctx.createLinearGradient(500, 500, 100, 0);
    gradientStroke1.addColorStop(0, "#4400eb");
    gradientStroke1.addColorStop(1, "#44ecf5");


    const gradientStroke2 = ctx.createLinearGradient(500, 500, 100, 0);
    gradientStroke2.addColorStop(0, "#f25521");
    gradientStroke2.addColorStop(1, "#f9c70a");

    // ctx.height = 50;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["01:00 pm", "04:00 pm", "07:00 pm", "10:00 pm", "01:00 am", "07:00 am", "10:00 am", "04:00 am", "12:00 am"],
            type: 'line',
            defaultFontFamily: 'Poppins', 
            datasets: [{
                data: [0, 80, 100, 122, 220, 200, 210, 320, 200],
                label: "Saiful",
                backgroundColor: gradientStroke1,
                borderColor: gradientStroke1,
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: gradientStroke1,
                pointBackgroundColor: gradientStroke1,
            }, {
                label: "Saikot",
                data: [0, 100, 160, 130, 100, 220, 370, 300, 170],
                backgroundColor: gradientStroke2,
                borderColor: gradientStroke2,
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: gradientStroke2,
                pointBackgroundColor: gradientStroke2,
            }]
        },
        options: {
            maintainAspectRatio: false, 
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                // position: 'top',
                // labels: {
                //     usePointStyle: true,
                // },
                display: false


            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        max: 400, 
                        stepSize: 100, 
                        min: 0
                    }, 
                    gridLines: {
                        display: true,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });


})(jQuery);

(function ($) {
    "use strict";

    const ctx = document.getElementById("sales-chart").getContext('2d');
    const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke1.addColorStop(0, "#f53c79");
    gradientStroke1.addColorStop(1, "#f0ae00");

    const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke2.addColorStop(0, "#4400eb");
    gradientStroke2.addColorStop(1, "#44ecf5");

    const gradientStroke3 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke3.addColorStop(0, "#36b9d8");
    gradientStroke3.addColorStop(1, "#4bffa2");
    
    ctx.height = 100;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',
            defaultFontFamily: 'Poppins',
            datasets: [{
                label: "Clothes",
                data: [0, 10, 20, 10, 25, 75, 50],
                backgroundColor: 'transparent',
                borderColor: gradientStroke1,
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: gradientStroke1,

            }, {
                label: "Foods",
                data: [0, 30, 10, 60, 50, 63, 10],
                backgroundColor: 'transparent',
                borderColor: gradientStroke2,
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: gradientStroke2,
            }, {
                label: "Electronics",
                data: [0, 50, 40, 20, 40, 79, 20],
                backgroundColor: 'transparent',
                borderColor: gradientStroke3,
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: gradientStroke3,
            }]
        },
        options: {
            responsive: true,

            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }, 
                    ticks: {
                        max: 200, 
                        min: 0, 
                        stepSize: 20
                    }
                }]
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });

})(jQuery);

(function ($) {
    "use strict";
    //line chart
    const ctx = document.getElementById("lineChart").getContext('2d');
    const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke1.addColorStop(0, "#36b9d8");
    gradientStroke1.addColorStop(1, "#4bffa2");

    const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke2.addColorStop(0, "#f25521");
    gradientStroke2.addColorStop(1, "#f9c70a");


    ctx.height = 100;
    new Chart(ctx, {
        type: 'line',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    borderColor: '#4bffa2',
                    borderWidth: "3",
                    backgroundColor: gradientStroke1,
                    data: [0, 16, 35, 14, 35, 54, 12]
                },
                {
                    label: "My Second dataset",
                    borderColor: '#f9c70a',
                    borderWidth: "3",
                    backgroundColor: gradientStroke2,
                    pointHighlightStroke: gradientStroke2,
                    data: [0, 22, 45, 32, 39, 75, 44]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }, 
            scales: {
                xAxes: [{
                    display: false
                }], 
                yAxes: [{
                    ticks: {
                        max: 100, 
                        stepSize: 10, 
                        min: 0
                    }
                }]
            }

        }
    });

})(jQuery);

(function ($) {
    "use strict";

    const ctx = document.getElementById("barChart").getContext('2d');
    const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke1.addColorStop(0, "#fd712c");
    gradientStroke1.addColorStop(1, "#f21780");

    const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke2.addColorStop(0, "#f25521");
    gradientStroke2.addColorStop(1, "#f9c70a");
    
    ctx.height = 100;

    new Chart(ctx, {
        type: 'bar',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: gradientStroke1,
                    borderWidth: "0",
                    backgroundColor: gradientStroke1
                },
                {
                    label: "My Second dataset",
                    data: [28, 48, 40, 19, 86, 27, 90],
                    borderColor: gradientStroke2,
                    borderWidth: "0",
                    backgroundColor: gradientStroke2
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    // Change here
                    barPercentage: 0.2
                }]
            }
        }
    });

})(jQuery);

(function ($) {
    "use strict";
    //radar chart
    const ctx = document.getElementById("radarChart").getContext('2d');

    const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke1.addColorStop(0, "rgba(54, 185, 216, .5)");
    gradientStroke1.addColorStop(1, "rgba(75, 255, 162, .5)");

    const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke2.addColorStop(0, "rgba(68, 0, 235, .5");
    gradientStroke2.addColorStop(1, "rgba(68, 236, 245, .5");

    ctx.height = 100;
    new Chart(ctx, {
        type: 'radar',
        data: {
            defaultFontFamily: 'Poppins',
            labels: [["Eating", "Dinner"], ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Cycling", "Running"],
            datasets: [
                {
                    label: "My First dataset",
                    data: [65, 59, 66, 45, 56, 55, 40],
                    borderColor: '#f21780',
                    borderWidth: "1",
                    backgroundColor: gradientStroke2
                },
                {
                    label: "My Second dataset",
                    data: [28, 12, 40, 19, 63, 27, 87],
                    borderColor: '#f21780',
                    borderWidth: "1",
                    backgroundColor: gradientStroke1
                }
            ]
        },
        options: {
            legend: {
                position: 'top'
            },
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });

})(jQuery);

(function ($) {
    "use strict";
    //pie chart
    const ctx = document.getElementById("pieChart").getContext('2d');
    ctx.height = 100;
    new Chart(ctx, {
        type: 'pie',
        data: {
            defaultFontFamily: 'Poppins',
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: [
                    "rgba(242, 85, 33, .9)",
                    "rgba(242, 85, 33, .7)",
                    "rgba(242, 85, 33, .5)",
                    "rgba(0,0,0,0.07)"
                ],
                hoverBackgroundColor: [
                    "rgba(242, 85, 33, .9)",
                    "rgba(242, 85, 33, .7)",
                    "rgba(242, 85, 33, .5)",
                    "rgba(0,0,0,0.07)"
                ]

            }],
            labels: [
                "one",
                "two",
                "three", 
                "four"
            ]
        },
        options: {
            responsive: true
        }
    });
})(jQuery);
console.log(templateStyle.version == "dark");
(function ($) {
    "use strict";
    //doughut chart
    const ctx = document.getElementById("doughutChart").getContext('2d');
    ctx.height = 100;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            defaultFontFamily: 'Poppins', 
            datasets: [{
                data: [45, 25, 20, 10], 
                backgroundColor: [
                    "rgba(242, 23, 128, .9)",
                    "rgba(242, 23, 128, .7)",
                    "rgba(242, 23, 128, .5)",
                    "rgba(242, 23, 128, .4)"
                ],
                hoverBackgroundColor: [
                    "rgba(242, 23, 128, .5)",
                    "rgba(242, 23, 128, .4)",
                    "rgba(242, 23, 128, .3)",
                    "rgba(242, 23, 128, .2)"
                ]

            }],
            // labels: [
            //     "green",
            //     "green",
            //     "green",
            //     "green"
            // ]
        },
        options: {
            responsive: true
        }
    });

})(jQuery);

(function ($) {
    "use strict";
    //polar chart
    const ctx = document.getElementById("polarChart").getContext('2d');
    ctx.height = 100;
    new Chart(ctx, {
        type: 'polarArea',
        data: {
            defaultFontFamily: 'Poppins',
            datasets: [{
                data: [15, 18, 9, 6, 19],
                backgroundColor: [
                    "rgba(242, 23, 128, .5)",
                    "rgba(242, 23, 128, .7)",
                    "rgba(242, 23, 128, .3)",
                    "rgba(242, 23, 128, .1)",
                    "rgba(242, 23, 128, .8)"
                ]

            }],
            // labels: [
            //     "green",
            //     "green",
            //     "green",
            //     "green"
            // ]
        },
        options: {
            responsive: true
        }
    });

})(jQuery);

(function ($) {
    "use strict";

    // single bar chart
    const ctx = document.getElementById("singelBarChart").getContext('2d');
    ctx.height = 100;
    new Chart(ctx, {
        type: 'bar',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
            datasets: [
                {
                    label: "My First dataset",
                    data: [40, 55, 75, 81, 56, 55, 40],
                    borderColor: "rgba(242, 23, 128, .9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(242, 23, 128, .5)"
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
})(jQuery);

(function ($) {
    "use strict";

    const nk = document.getElementById("canvas").getContext('2d');
    const gradientStroke = nk.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, "#f0a808");
    gradientStroke.addColorStop(0.235, "#f53c79");
    gradientStroke.addColorStop(0.7, "#f0a709");
    gradientStroke.addColorStop(1, "#f0a808");

    let draw = Chart.controllers.line.prototype.draw;
    Chart.controllers.line = Chart.controllers.line.extend({
        draw: function () {
            draw.apply(this, arguments);
            let nk = this.chart.chart.ctx;
            let _stroke = nk.stroke;
            nk.stroke = function () {
                nk.save();
                nk.shadowColor = 'rgba(0, 0, 0, .1)';
                nk.shadowBlur = 5;
                nk.shadowOffsetX = 0;
                nk.shadowOffsetY = 20;
                _stroke.apply(this, arguments)
                nk.restore();
            }
        }
    });
    
    
    new Chart(nk, {
        type: 'line',
        data: {
            defaultFontFamily: 'Poppins',
            labels: ["01", "02", "03", "04", "05", "06", "07", "08"],
            datasets: [{
                data: [450, 470, 50, 380, 100, 450, 300, 340],
                borderWidth: 4,
                borderColor: gradientStroke,
                pointBackgroundColor: gradientStroke,
                pointBorderColor: gradientStroke,
                pointHoverBackgroundColor: gradientStroke,
                pointHoverBorderColor: gradientStroke,
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: !1
            }]
        },
        options: {
            responsive: !0,
            legend: {
                display: !1
            },
            scales: {
                xAxes: [{
                    display: 1,
                    gridLines: {
                        display: 1
                    }
                }],
                yAxes: [{
                    display: 1,
                    ticks: {
                        padding: 10,
                        stepSize: 100,
                        max: 600,
                        min: 0
                    },
                    gridLines: {
                        display: !0,
                        drawBorder: !1,
                        lineWidth: 1,
                        zeroLineColor: "#e5e5e5"
                    }
                }]
            }
        },
    });

})(jQuery);

(function ($) {
    "use strict";

    const ctx = document.getElementById("stalkedBarChart").getContext('2d');
    const gradientStroke = ctx.createLinearGradient(50, 100, 50, 50);
    gradientStroke.addColorStop(0, "#36b9d8");
    gradientStroke.addColorStop(1, "#4bffa2");

    const gradientStroke2 = ctx.createLinearGradient(50, 100, 50, 50);
    gradientStroke2.addColorStop(0, "#4400eb");
    gradientStroke2.addColorStop(1, "#44ecf5");

    const gradientStroke3 = ctx.createLinearGradient(50, 100, 50, 50);
    gradientStroke3.addColorStop(0, "#f53c79");
    gradientStroke3.addColorStop(1, "#f0ae00");

    var barChartData = {
        defaultFontFamily: 'Poppins',
        labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Red',
            backgroundColor: gradientStroke,
            hoverBackgroundColor: gradientStroke, 
            data: [
                '12',
                '12',
                '12',
                '12',
                '12',
                '12',
                '12'
            ]
        }, {
            label: 'Green',
            backgroundColor: gradientStroke2,
            hoverBackgroundColor: gradientStroke2, 
            data: [
                '12',
                '12',
                '12',
                '12',
                '12',
                '12',
                '12'
            ]
        }, {
            label: 'Blue',
            backgroundColor: gradientStroke3,
            hoverBackgroundColor: gradientStroke3, 
            data: [
                '12',
                '12',
                '12',
                '12',
                '12',
                '12',
                '12'
            ]
        }]

    };
    
    new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            legend: {
                display: false
            }, 
            title: {
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

})(jQuery);





//piety chart
(function($) {
    "use strict"
 
    $(".data-attr").peity("donut");
 
})(jQuery);