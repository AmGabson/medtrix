"use strict";
!function(NioApp, $) {
    var profileBalance = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
        dataUnit: "BTC",
        lineTension: .15,
        datasets: [{
            label: "Total Received",
            color: "#733AEA",
            background: NioApp.hexRGB("#733AEA", .3),
            data: [111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 75, 90]
        }]
    };
    function lineProfileBalance(selector, set_data) {
        var $selector = $(selector || ".profile-balance-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    fill: !0,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 2,
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: _get_data.datasets[i].data
                });
            var chart = new Chart(selectCanvas,{
                type: "line",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    plugins: {
                        legend: {
                            display: !1
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                title: function() {
                                    return !1
                                },
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 11
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 4,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 10
                            },
                            bodySpacing: 3,
                            padding: 8,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !1
                        },
                        x: {
                            display: !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        lineProfileBalance()
    });
    var orderOverview = {
        labels: ["22 Jun", "23 Jun", "24 Jun", "25 Jun", "26 Jun", "27 Jun", "28 Jun", "29 Jun", "30 Jun", "01 Jul"],
        dataUnit: "USD",
        datasets: [{
            label: "Buy Orders",
            color: "#8feac5",
            data: [1820, 1200, 1600, 2500, 1820, 1200, 1700, 1820, 1400, 2100]
        }, {
            label: "Sell Orders",
            color: "#9C73F5",
            data: [3e3, 3450, 2450, 1820, 2700, 4870, 2470, 2600, 4e3, 2380]
        }]
    };
    function orderOverviewChart(selector, set_data) {
        var $selector = $(selector || ".order-overview-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: NioApp.State.asMobile ? 1 : .7,
                    categoryPercentage: NioApp.State.asMobile ? 1 : .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 13
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 6,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !0,
                            stacked: _get_data.stacked || !1,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: !0,
                                font: {
                                    size: 11
                                },
                                color: "#9eaecf",
                                padding: 10,
                                callback: function(a, t, e) {
                                    return "$ " + a
                                },
                                min: 100,
                                max: 5e3,
                                stepSize: 1200
                            },
                            grid: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2),
                                drawTicks: !1
                            }
                        },
                        x: {
                            display: !0,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                font: {
                                    size: 9
                                },
                                color: "#9eaecf",
                                source: "auto",
                                padding: 10,
                                reverse: NioApp.State.isRTL
                            },
                            grid: {
                                color: "transparent",
                                tickLength: 0,
                                zeroLineColor: "transparent",
                                drawTicks: !1
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        orderOverviewChart()
    });
    var userActivity = {
        labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Direct Join",
            color: "#9C73F5",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
        }, {
            label: "Referral Join",
            color: NioApp.hexRGB("#9C73F5", .2),
            data: [125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    };
    function userActivityChart(selector, set_data) {
        var $selector = $(selector || ".usera-activity-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .8,
                    categoryPercentage: .9
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 13
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 6,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        },
                        x: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        userActivityChart()
    });
    var coinOverview = {
        labels: ["Bitcoin", "Ethereum", "NioCoin", "Litecoin", "Bitcoin"],
        stacked: !0,
        datasets: [{
            label: "Buy Orders",
            color: ["#f98c45", "#6baafe", "#8feac5", "#6b79c8", "#79f1dc"],
            data: [1740, 2500, 1820, 1200, 1600, 2500]
        }, {
            label: "Sell Orders",
            color: [NioApp.hexRGB("#f98c45", .2), NioApp.hexRGB("#6baafe", .4), NioApp.hexRGB("#8feac5", .4), NioApp.hexRGB("#6b79c8", .4), NioApp.hexRGB("#79f1dc", .4)],
            data: [2420, 1820, 3e3, 5e3, 2450, 1820]
        }]
    };
    function coinOverviewChart(selector, set_data) {
        var $selector = $(selector || ".coin-overview-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barThickness: "8",
                    categoryPercentage: .5,
                    barPercentage: 1
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    indexAxis: "y",
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 13
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 6,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0,
                                padding: 0
                            },
                            grid: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2),
                                drawTicks: !1
                            }
                        },
                        x: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                font: {
                                    size: 9
                                },
                                color: "#9eaecf",
                                source: "auto",
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            grid: {
                                color: "transparent",
                                tickLength: 0,
                                zeroLineColor: "transparent",
                                drawTicks: !1
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        coinOverviewChart()
    });
    var salesRevenue = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Sales Revenue",
            color: [NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), "#733AEA"],
            data: [11e3, 8e3, 12500, 5500, 9500, 14299, 11e3, 8e3, 12500, 5500, 9500, 14299]
        }]
    }
      , activeSubscription = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        dataUnit: "NGN",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), "#733AEA"],
            data: [8200, 7800, 9500, 5500, 9200, 9690]
        }]
    }
      , totalSubscription = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), "#aea1ff"],
            data: [8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };
    function salesBarChart(selector, set_data) {
        var $selector = $(selector || ".sales-bar-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                title: function() {
                                    return !1
                                },
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 11
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 4,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 10
                            },
                            bodySpacing: 3,
                            padding: 8,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        },
                        x: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        salesBarChart()
    });
    var salesOverview = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
        dataUnit: "BTC",
        lineTension: .1,
        datasets: [{
            label: "Sales Overview",
            color: "#733AEA",
            background: NioApp.hexRGB("#733AEA", .3),
            data: [8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };
    function lineSalesOverview(selector, set_data) {
        var $selector = $(selector || ".sales-overview-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    fill: !0,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 2,
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: _get_data.datasets[i].data
                });
            var chart = new Chart(selectCanvas,{
                type: "line",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 13
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 6,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !0,
                            stacked: _get_data.stacked || !1,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: !0,
                                font: {
                                    size: 11
                                },
                                color: "#9eaecf",
                                padding: 10,
                                callback: function(a, t, e) {
                                    return "$ " + a
                                },
                                min: 100,
                                stepSize: 3e3
                            },
                            grid: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2),
                                drawTicks: !1
                            }
                        },
                        x: {
                            display: !0,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                font: {
                                    size: 9
                                },
                                color: "#9eaecf",
                                source: "auto",
                                padding: 10,
                                reverse: NioApp.State.isRTL
                            },
                            grid: {
                                color: "transparent",
                                tickLength: 0,
                                zeroLineColor: "transparent",
                                drawTicks: !1
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        lineSalesOverview()
    });
    var supportStatus = {
        labels: ["Bitcoin", "Ethereum", "NioCoin", "Feature Request", "Bug Fix"],
        stacked: !0,
        datasets: [{
            label: "Solved",
            color: ["#f98c45", "#6baafe", "#8feac5", "#6b79c8", "#79f1dc"],
            data: [66, 74, 92, 142, 189]
        }, {
            label: "Open",
            color: [NioApp.hexRGB("#f98c45", .4), NioApp.hexRGB("#6baafe", .4), NioApp.hexRGB("#8feac5", .4), NioApp.hexRGB("#6b79c8", .4), NioApp.hexRGB("#79f1dc", .4)],
            data: [66, 74, 92, 32, 26]
        }, {
            label: "Pending",
            color: [NioApp.hexRGB("#f98c45", .2), NioApp.hexRGB("#6baafe", .2), NioApp.hexRGB("#8feac5", .2), NioApp.hexRGB("#6b79c8", .2), NioApp.hexRGB("#79f1dc", .2)],
            data: [66, 74, 92, 21, 9]
        }]
    };
    function supportStatusChart(selector, set_data) {
        var $selector = $(selector || ".support-status-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barThickness: "8",
                    categoryPercentage: .5,
                    barPercentage: 1
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    indexAxis: "y",
                    plugins: {
                        legend: {
                            display: _get_data.legend || !1,
                            rtl: NioApp.State.isRTL,
                            labels: {
                                boxWidth: 30,
                                padding: 20,
                                color: "#6783b8"
                            }
                        },
                        tooltip: {
                            enabled: !0,
                            rtl: NioApp.State.isRTL,
                            callbacks: {
                                label: function(a) {
                                    return "".concat(a.parsed.y, " ").concat(_get_data.dataUnit)
                                }
                            },
                            backgroundColor: "#eff6ff",
                            titleFont: {
                                size: 13
                            },
                            titleColor: "#6783b8",
                            titleMarginBottom: 6,
                            bodyColor: "#9eaecf",
                            bodyFont: {
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            footerMarginTop: 0,
                            displayColors: !1
                        }
                    },
                    maintainAspectRatio: !1,
                    scales: {
                        y: {
                            display: !0,
                            stacked: _get_data.stacked || !1,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: !0,
                                padding: 16,
                                color: "#8094ae"
                            },
                            grid: {
                                color: "transparent",
                                tickLength: 0,
                                zeroLineColor: "transparent",
                                drawTicks: !1
                            }
                        },
                        x: {
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                font: {
                                    size: 9
                                },
                                color: "#9eaecf",
                                source: "auto",
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            grid: {
                                color: "transparent",
                                tickLength: 0,
                                zeroLineColor: "transparent",
                                drawTicks: !1
                            }
                        }
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        supportStatusChart()
    })
}(NioApp, jQuery);
