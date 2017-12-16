$.ajaxSetup({
    async: false
});

var style = '0';
var startTime = getToDateFormatDate();
var endTime = getNowFormatDate();

var chart;

function getData() {
    var data;
    $.getJSON('/admin/average?style='+style+'&startTime='+startTime+'&endTime='+endTime,function (Jsondata) {
        data = Jsondata.data;
    });
    return data;
}

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    createContainer();

    $('#reservationtime').daterangepicker({
        applyClass : 'btn-sm btn-success',
        cancelClass : 'btn-sm btn-default',
        locale: {
            applyLabel: '确定',
            cancelLabel: '取消',
            fromLabel: '起始时间',
            toLabel: '结束时间',
            customRangeLabel: '自定义',
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月',
                '七月', '八月', '九月', '十月', '十一月', '十二月'],
            firstDay: 1,
            separator: ' ~ ',
            format: 'YYYY-MM-DD HH:mm:ss' //控件中from和to 显示的日期格式
        },
        ranges : {
            '最近1小时': [moment().subtract('hours',1), moment()],
            // '最近7小时': [moment().subtract('hours',7), moment()],
            '最近24小时': [moment().subtract('hours',24), moment()],
            '今天': [moment().hour(0).minutes(0).seconds(0), moment().endOf('day')],
            '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '7天':  [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
            // '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
            '30天': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
            '这个月': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
            '上个月': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')]
        },
        opens : 'right',    // 日期选择框的弹出位置
        showWeekNumbers : true,     // 是否显示第几周

        timePicker: true,
        timePickerIncrement : 1, // 时间的增量，单位为分钟
        timePicker24Hour: true, // 是否使用12小时制来显示时间
        timePickerSeconds:true,
        startOfWeek: 'monday',

        format: 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
        maxDate: new Date()

    }, function(start, end, label) { // 格式化日期显示框
        startTime = start.format('YYYY-MM-DD HH:mm:ss');
        endTime = end.format('YYYY-MM-DD HH:mm:ss');
        reBindChart();
    })
        .next().on('click', function(){
        $(this).prev().focus();
    });


});

function createContainer() {
    var data = getData();
    chart = Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: data.text
        },
        subtitle: {
            text: '点击下方可隐藏某一数据'
        },
        xAxis: {
            categories: data.xAxis,
            tickLength:5,
            tickmarkPlacement:'on'
        },
        yAxis: {
            title: {
                text: '值'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true          // 开启数据标签
                },
                enableMouseTracking: false // 关闭鼠标跟踪，对应的提示框、点击事件会失效
            }
        },
        series: [{
            name: '温度',
            data: data.temperature
        }, {
            name: '湿度',
            data: data.humidity
        }, {
            name: '光照强度',
            data: data.lightIntensity
        }, {
            name: '土壤湿度',
            data: data.soilMoisture
        }, {
            name: '雨量',
            data: data.rainfall
        }],
        credits: {
            enabled: false
        }
    });
}

$('#hour').click(function(){
    style = '0';
    reBindChart();
});

$('#day').click(function(){
    style = '1';
    reBindChart();
});

$('#month').click(function(){
    style = '2';
    reBindChart();
});


function reBindChart() {
    chart.destroy();
    createContainer();
}

function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
        + " " + date.getHours() + seperator2 + date.getMinutes() + seperator2 + date.getSeconds();
    return currentdate;
}

function getToDateFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
        + " " + "00" + seperator2 + "00" + seperator2 + "00";
    return currentdate;
}