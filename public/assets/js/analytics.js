/**
 * Created by Narendra on 13-Jun-15.
 */

/*function usergraph() {
    var app_id = $('#app_id').val();
    $.getJSON('jsonp-1.php?filename=' + app_id + '_growthChart.txt&callback=?', function (data) {
        // Create the chart
        $('#growth-chart-container').highcharts('StockChart', {
            rangeSelector: {
                buttonTheme: { // styles for the buttons
                    fill: 'none',
                    stroke: 'none',
                    'stroke-width': 0,
                    r: 8,
                    style: {
                        color: '#039',
                        fontWeight: 'bold'
                    },
                    states: {
                        hover: {},
                        select: {
                            fill: '#039',
                            style: {
                                color: 'white'
                            }
                        }
                    }
                },
                selected: 0
            },
            title: {
                text: ''
            },
            series: [{
                name: 'user registered',
                data: data,
                type: 'area',
                tooltip: {
                    valueDecimals: 0
                },
                fillColor: {
                    linearGradient: [0, 0, 0, 300],
                    stops: [
                        [0, 'rgb(124, 181, 236)'],
                        [1, 'rgba(192, 192, 192, 0)']
                    ]
                }
            }],
            yAxis: {
                allowDecimals: false,
                endOnTick: false,
                startOnTick: false
            }
        }, function (chart) {
            // apply the date pickers
            setTimeout(function () {
                $('input.highcharts-range-selector', $(chart.container).parent())
                    .datepicker();
            }, 0);
        });
    });
}*/

/*function getProjectData() {
    var proj_id = $('#projects').val();
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var projectSharingData = xmlhttp.responseText.trim();
            drawProjectSharingPieChart(projectSharingData);
        }
    };
    xmlhttp.open("POST", "get-project-sharing-info.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("proj_id=" + proj_id);

    function drawProjectSharingPieChart(data) {
        data = JSON.parse(data);

        $('#project-sharing-pie-chart-container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,//null,
                plotShadow: false
            },
            title: {
                text: ' '
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}   </b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Project share',
                data: data
            }]
        });

    }
}*/

function getActiveUserData() {

    var platform = parseInt($('#platform').val());
    var activeUserValue = parseInt($('#activeUsers').val());

    $.ajax({
        type: "GET",
        url: "get-app-config-info.php",
        data: {device_type: platform},
        cache: false,
        success: function (response) {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear() - 1;
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '-' + mm + '-' + dd;

            var urlcall = "";
            var title = "";

            if (activeUserValue == 1) {
                urlcall = "http://api.flurry.com/appMetrics/ActiveUsers?apiAccessCode=" + response.apiAccessCode + "&apiKey=" + response.apiKey + "&startDate=" + today + "&endDate=" + response.endDate;
                title = "Total number of unique users who accessed the application per day";

            }
            else if (activeUserValue == 2) {
                urlcall = "http://api.flurry.com/appMetrics/NewUsers?apiAccessCode=" + response.apiAccessCode + "&apiKey=" + response.apiKey + "&startDate=" + today + "&endDate=" + response.endDate;
                title = "Total number of unique users who used the application for the first time ";
            }
            else if (activeUserValue == 3) {
                urlcall = "http://api.flurry.com/appMetrics/RetainedUsers?apiAccessCode=" + response.apiAccessCode + "&apiKey=" + response.apiKey + "&startDate=" + today + "&endDate=" + response.endDate;
                title = "Total number of users who remain active users of the application per day";
            }
            else if (activeUserValue == 4) {
                urlcall = "http://api.flurry.com/appMetrics/Sessions?apiAccessCode=" + response.apiAccessCode + "&apiKey=" + response.apiKey + "&startDate=" + today + "&endDate=" + response.endDate;
                title = "The total number of times users accessed the application per day";
            }


            var result = [];

            $.ajax({
                type: "GET",
                url: urlcall,
                data: '',
                cache: false,
                success: function (res) {
                    for (x in res.day) {
                        dateTime = new Date(res.day[x]['@date']).getTime();
                        var data = [];
                        data[0] = dateTime;
                        data[1] = parseInt(res.day[x]['@value']);
                        result[x] = data;
                    }
                    activeUser(result, title);

                }
            });
        }
    });


    function activeUser(data, title) {

        // Create the chart
        $('#active-users-chart-container').highcharts('StockChart', {
            rangeSelector: {
                buttons: [{
                    type: 'week',
                    count: 0,
                    text: 'week'
                },
                    {
                        type: 'month',
                        count: 1,
                        text: '1m'
                    }, {
                        type: 'month',
                        count: 3,
                        text: '3m'
                    }, {
                        type: 'month',
                        count: 6,
                        text: '6m'
                    }, {
                        type: 'ytd',
                        text: 'YTD'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '1y'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                buttonTheme: { // styles for the buttons
                    fill: 'none',
                    stroke: 'none',
                    'stroke-width': 0,
                    r: 8,
                    style: {
                        color: '#039',
                        fontWeight: 'bold'
                    },
                    states: {
                        hover: {},
                        select: {
                            fill: '#039',
                            style: {
                                color: 'white'
                            }
                        }
                    }
                },
                selected: 2
            },

            title: {
                text: title
            },

            series: [{
                name: 'users',
                data: data,
                type: 'area',
                tooltip: {
                    valueDecimals: 0
                },
                fillColor: {
                    linearGradient: [0, 0, 0, 300],
                    stops: [
                        [0, 'rgb(124, 181, 236)'],
                        [1, 'rgba(192, 192, 192, 0)']
                    ]
                }
            }],

            yAxis: {
                allowDecimals: false,
                endOnTick: false,
                startOnTick: false
            }
        }, function (chart) {

            // apply the date pickers
            setTimeout(function () {
                $('input.highcharts-range-selector', $(chart.container).parent())
                    .datepicker();
            }, 0);
        });
    }
}

//getProjectData();
//usergraph();
getActiveUserData();

