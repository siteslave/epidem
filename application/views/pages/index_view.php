
    <script type="text/javascript">
        $(function () {

            var colors = Highcharts.getOptions().colors,
                categories1 = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
                categories2 = ['MSI', 'Fire', 'Chro', 'Safar', 'Ope'],
                name = 'Browser brands',
                data1 = [{
                    y: 55.11,
                    color: colors[0],
                    drilldown1: {
                        name: 'MSIE versions',
                        categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0'],
                        data1: [10.85, 7.35, 33.06, 2.81],
                        color: colors[0]
                    }
                }, {
                    y: 21.63,
                    color: colors[1],
                    drilldown1: {
                        name: 'Firefox versions',
                        categories: ['Firefox 2.0', 'Firefox 3.0', 'Firefox 3.5', 'Firefox 3.6', 'Firefox 4.0'],
                        data1: [0.20, 0.83, 1.58, 13.12, 5.43],
                        color: colors[1]
                    }
                }, {
                    y: 11.94,
                    color: colors[2],
                    drilldown1: {
                        name: 'Chrome versions',
                        categories: ['Chrome 5.0', 'Chrome 6.0', 'Chrome 7.0', 'Chrome 8.0', 'Chrome 9.0',
                            'Chrome 10.0', 'Chrome 11.0', 'Chrome 12.0'],
                        data1: [0.12, 0.19, 0.12, 0.36, 0.32, 9.91, 0.50, 0.22],
                        color: colors[2]
                    }
                }, {
                    y: 7.15,
                    color: colors[3],
                    drilldown1: {
                        name: 'Safari versions',
                        categories: ['Safari 5.0', 'Safari 4.0', 'Safari Win 5.0', 'Safari 4.1', 'Safari/Maxthon',
                            'Safari 3.1', 'Safari 4.1'],
                        data1: [4.55, 1.42, 0.23, 0.21, 0.20, 0.19, 0.14],
                        color: colors[3]
                    }
                }, {
                    y: 2.14,
                    color: colors[4],
                    drilldown1: {
                        name: 'Opera versions',
                        categories: ['Opera 9.x', 'Opera 10.x', 'Opera 11.x'],
                        data1: [ 0.12, 0.37, 1.65],
                        color: colors[4]
                    }
                }],
                data2 = [{
                    y: 44.11,
                    color: colors[0],
                    drilldown2: {
                        name: 'MSIE versions',
                        categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0'],
                        data2: [10.85, 7.35, 33.06, 2.81],
                        color: colors[0]
                    }
                }, {
                    y: 21.63,
                    color: colors[1],
                    drilldown2: {
                        name: 'Firefox versions',
                        categories: ['Firefox 2.0', 'Firefox 3.0', 'Firefox 3.5', 'Firefox 3.6', 'Firefox 4.0'],
                        data2: [0.20, 0.83, 1.58, 13.12, 5.43],
                        color: colors[1]
                    }
                }, {
                    y: 11.94,
                    color: colors[2],
                    drilldown2: {
                        name: 'Chrome versions',
                        categories: ['Chrome 5.0', 'Chrome 6.0', 'Chrome 7.0', 'Chrome 8.0', 'Chrome 9.0',
                            'Chrome 10.0', 'Chrome 11.0', 'Chrome 12.0'],
                        data2: [0.12, 0.19, 0.12, 0.36, 0.32, 9.91, 0.50, 0.22],
                        color: colors[2]
                    }
                }, {
                    y: 7.15,
                    color: colors[3],
                    drilldown2: {
                        name: 'Safari versions',
                        categories: ['Safari 5.0', 'Safari 4.0', 'Safari Win 5.0', 'Safari 4.1', 'Safari/Maxthon',
                            'Safari 3.1', 'Safari 4.1'],
                        data2: [4.55, 1.42, 0.23, 0.21, 0.20, 0.19, 0.14],
                        color: colors[3]
                    }
                }, {
                    y: 2.14,
                    color: colors[4],
                    drilldown2: {
                        name: 'Opera versions',
                        categories: ['Opera 9.x', 'Opera 10.x', 'Opera 11.x'],
                        data2: [ 0.12, 0.37, 1.65],
                        color: colors[4]
                    }
                }];

            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }

            var chart = $('#chart1').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Browser market share, April, 2011'
                },
                subtitle: {
                    text: 'Click the columns to view versions. Click again to view brands.'
                },
                xAxis: {
                    categories: categories1
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown1;
                                    if (drilldown) { // drill down
                                        setChart(drilldown.name, drilldown.categories1, drilldown.data1, drilldown.color);
                                    } else { // restore
                                        setChart(name, categories1, data1);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[0],
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function() {
                                return this.y +'%';
                            }
                        }
                    }
                },
                tooltip: {
                    formatter: function() {
                        var point = this.point,
                            s = this.x +':<b>'+ this.y +'% market share</b><br/>';
                        if (point.drilldown) {
                            s += 'Click to view '+ point.category +' versions';
                        } else {
                            s += 'Click to return to browser brands';
                        }
                        return s;
                    }
                },
                series: [{
                    name: name,
                    data: data1,
                    color: 'white'
                }],
                exporting: {
                    enabled: false
                }
            })
//################### End Chart1
//################### Begin # Chart 2
            var chart = $('#chart2').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'ทดสอบภาษาไทย'
                },
                subtitle: {
                    text: 'ส่วนของ เมนูย่อย ครับ'
                },
                xAxis: {
                    categories: categories2
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown2;
                                    if (drilldown) { // drill down
                                        setChart(drilldown.name, drilldown.categories2, drilldown.data2, drilldown.color);
                                    } else { // restore
                                        setChart(name, categories2, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[0],
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function() {
                                return this.y +'%';
                            }
                        }
                    }
                },
                tooltip: {
                    formatter: function() {
                        var point = this.point,
                            s = this.x +':<b>'+ this.y +'% market share</b><br/>';
                        if (point.drilldown) {
                            s += 'Click to view '+ point.category +' versions';
                        } else {
                            s += 'Click to return to browser brands';
                        }
                        return s;
                    }
                },
                series: [{
                    name: name,
                    data: data2,
                    color: 'white'
                }],
                exporting: {
                    enabled: false
                }
            })
//################### End Chart1
                .highcharts(); // return chart
        });


    </script>
<script src="<?=base_url()?>assets/heighcharts/js/modules/exporting.js"></script>
<div class="col col-1"></div>
<div id="chart1" class="panel col col-5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div class="col col-1"></div>
<div id="chart2" class="panel col col-5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

