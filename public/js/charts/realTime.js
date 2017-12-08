var timeIntervel = 2000;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

$.ajaxSetup({
    async: false
});

function activeLastPointToolip(chart) {
    var points = chart.series[0].points;
    chart.tooltip.refresh(points[points.length -1]);
}
$('#container').highcharts({
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {
                // set up the updating of the chart each second
                var series = this.series[0],
                    chart = this;
                
                setInterval(function () {
                    var x = (new Date()).getTime(); // current time
                    var y;
                    $.getJSON('/1/temperature',function (Jsondata) {
                        y = Number(Jsondata.data);
                    });
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart)
                }, timeIntervel);

            }
        }
    },
    title: {
        text: '动态模拟实时数据'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: '值'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: '随机数据',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;
            //数据量
            var dataCount = 20*1000/timeIntervel;
            $.getJSON('/'+dataCount+'/temperature',function (Jsondata) {
                for (i = 0; i < dataCount; i++) {
                    data.push({
                        x: time + (i-dataCount-1) * timeIntervel,
                        y: Number(Jsondata.data[i])
                    });
                }
            });
            return data;
        }())
    }]
}, function(c) {
    activeLastPointToolip(c)
});