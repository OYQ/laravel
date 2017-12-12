$.ajaxSetup({
    async: false
});

var isLightIntensity = false;
var isSoilMoisture = true;
var isRainfall = true;
var time = 1;

var dic = new Array();
dic["temperature"] = "温度";
dic["humidity"] = "湿度";
dic["lightIntensity"] = "光照强度";
dic["soilMoisture"] = "土壤湿度";
dic["rainfall"] = "雨量";

createContainer('temperature');
createContainer('humidity');

$(function () {
    $(window).scroll(function(){
        var wScrollY = window.scrollY; // 当前滚动条位置
        var wInnerH = window.innerHeight; // 设备窗口的高度（不会变）
        var bScrollH = document.body.scrollHeight; // 滚动条总高度
        if (wScrollY + wInnerH >= bScrollH ) {
            if(!isLightIntensity && time == 1){
                addLightIntensity();
                isSoilMoisture = false;
            }

            if(!isSoilMoisture && time == 2){
                addSoilMoisture();
                isRainfall = false;
            }

            if(!isRainfall && time == 3){
                addRainfall();
            }
            time++;

        }
    });
});



function addLightIntensity() {
    isLightIntensity = true;
    $('#lightIntensity').append('<div id="lightIntensity" style="height: 400px; max-width: 800px; margin: 0 auto"></div>');
    createContainer('lightIntensity');
}

function addSoilMoisture() {
    isSoilMoisture = true;
    $('#soilMoisture').append('<div id="soilMoisture" style="height: 400px; max-width: 800px; margin: 0 auto"></div>');
    createContainer('soilMoisture');
}

function addRainfall() {
    isRainfall = true;
    $('#rainfall').append('<div id="rainfall" style="height: 400px; max-width: 800px; margin: 0 auto"></div>');
    createContainer('rainfall');
}

function createContainer(container) {
    // console.time(container);
    var data = getData(container);
    Highcharts.chart(container, {
        chart: {
            zoomType: 'x'
        },

        xAxis: {
            categories: data[2],
            labels:{
                // step: Math.ceil(parseFloat(data[0]/10)),
                rotation: -60
            },
            tickLength:5,
            tickmarkPlacement:'on'


        },
        boost: {
            useGPUTranslations: true
        },
        title: {
            text: dic[container]
        },
        subtitle: {
            text: '共'+ data[0] +'条数据'
        },
        tooltip: {
            valueDecimals: 2
        },


        series: [{
            name:dic[container],
            data: data[1],
            lineWidth: 0.5
        }
        ]

    });
    // console.timeEnd(container);
}




function getData(container) {
    var arr = [];
    var ret = [];
    var n;
    var time;
    $.getJSON('/admin/info/'+container,function (Jsondata) {
        var data;
        n = Jsondata.data.count;
        data = Jsondata.data.source;
        time = Jsondata.data.time;
        var i;
        for (i = 0; i < n; i++) {
            arr.push([
                i,
                Number(data[i])
            ]);
        }

    });
    ret[0] = n;
    ret[1] = arr;
    ret[2] = time;
    return ret;
}


$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


//Date range picker with time picker
    $('#reservationtime').daterangepicker({
        applyClass : 'btn-sm btn-success',
        cancelClass : 'btn-sm btn-default',
        locale: {
            applyLabel: '确认',
            cancelLabel: '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            firstDay : 1,
            format: 'YYYY-MM-DD hh:mm:ss',
            separator: ' ~ '
        },
        ranges : {
            '今日': [moment().startOf('day'), moment()],
            '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
            '最近7日': [moment().subtract('days', 6), moment()],
            '最近30日': [moment().subtract('days', 29), moment()],
            '本月': [moment().startOf("month"),moment().endOf("month")]
        },
        opens : 'right',    // 日期选择框的弹出位置
        showWeekNumbers : true,     // 是否显示第几周

        timePicker: true,
        timePickerIncrement : 1, // 时间的增量，单位为分钟
        timePicker12Hour : false, // 是否使用12小时制来显示时间

        format: 'YYYY-MM-DD',
        maxDate: new Date()

    }, function(start, end, label) { // 格式化日期显示框
        $('#beginTime').val(start.format('YYYY-MM-DD'));
        $('#endTime').val(end.format('YYYY-MM-DD'));
    })
        .next().on('click', function(){
        $(this).prev().focus();
    });
});


