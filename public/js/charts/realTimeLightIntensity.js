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
$('#lightIntensity').highcharts({
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
                    $.getJSON('/1/lightIntensity',function (Jsondata) {
                        y = Number(Jsondata.data);
                    });
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart)
                }, timeIntervel);

            }
        }
    },
    title: {
        text: '实时光照强度数据'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: '湿度'
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
        name: '实时光强',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;
            //数据量
            var dataCount = 20;
            $.getJSON('/'+dataCount+'/lightIntensity',function (Jsondata) {
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