$.ajaxSetup({
    async: false
});

var isLightIntensity = false;
var isSoilMoisture = true;
var isRainfall = true;
var time = 1;

var dic = new Array();
var con = new Array();

var startTime = getToDateFormatDate();
var endTime = getNowFormatDate();

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
    var chart = new Highcharts.chart(container, {
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
        }],
        credits: {
            enabled: false
        }

    });
    con[container] = chart;
    // console.timeEnd(container);
}




function getData(container) {
    var arr = [];
    var ret = [];
    var n;
    var time;

    //默认取今天0点到现在
    $.getJSON('/admin/info/'+container+'?startTime='+startTime+'&endTime='+endTime,function (Jsondata) {
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
            format: 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
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
        // $('#beginTime').val(start.format('YYYY-MM-DD'));
        // $('#endTime').val(end.format('YYYY-MM-DD'));

        startTime = start.format('YYYY-MM-DD HH:mm:ss');
        endTime = end.format('YYYY-MM-DD HH:mm:ss');
        // console.log(startTime,endTime);
        destroySeries();
        resetVar();
        //创建
        createContainer('temperature');
        createContainer('humidity');

    })
        .next().on('click', function(){
        $(this).prev().focus();
    });
});

function destroySeries() {
    if(con['temperature']){
        con['temperature'].destroy ();
    }

    if(con['humidity']){
        con['humidity'].destroy ();
    }

    if(con['lightIntensity']){
        con['lightIntensity'].destroy ();
    }

    if(con['soilMoisture']){
        con['soilMoisture'].destroy ();
    }

    if(con['rainfall']){
        con['rainfall'].destroy ();
    }

    con = new Array();



}


function resetVar() {
    isLightIntensity = false;
    isSoilMoisture = true;
    isRainfall = true;
    time = 1;
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