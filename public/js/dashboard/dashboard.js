$.ajaxSetup({
    async: false
});

$(function () {
    //当前信息--------------
    nowInfo();
    //---------------------

    //当天每小时信息---------
    createContainer();
    //---------------------

    //警报信息--------------
    alertInfo();
    //---------------------



});


function alertInfo() {
    var alertColor = $('#alertColor');
    var alertImg = $('#alertImg');
    var alertContain = $('#alertContain');
    $.getJSON('/admin/firstAlert',function (Jsondata) {
        if(Jsondata.error == 0){
            alertContain.html(Jsondata.data.style + '出现报警，报警值为:' + Jsondata.data.zhi + '<br>报警时间:' + Jsondata.data.time);
            alertColor.removeClass('alert-success');
            alertImg.removeClass('fa-check');
            alertColor.addClass('alert-danger');
            alertImg.addClass('fa-ban');
        }else{
            alertContain.html('无警报信息');
            alertColor.removeClass('alert-danger');
            alertImg.removeClass('fa-ban');
            alertColor.addClass('alert-success');
            alertImg.addClass('fa-check');
        }

    });
}

function nowInfo() {
    var temp1 = $('#temperature');
    var temp2 = $('#humidity');
    var temp3 = $('#lightIntensity');
    var temp4 = $('#soilMoisture');
    // temp1.html('123<sup style="font-size: 20px">%</sup>');
    $.getJSON('/admin/firstInfo',function (Jsondata) {
        temp1.html(Jsondata.data.temperature +'<sup style="font-size: 20px">℃</sup>');
        temp2.html(Jsondata.data.humidity +'<sup style="font-size: 20px">%</sup>');
        temp3.html(Jsondata.data.lightIntensity +'<sup style="font-size: 20px">cd</sup>');
        temp4.html(Jsondata.data.soilMoisture +'<sup style="font-size: 20px">d</sup>');
    });
}

function getData() {
    var data;
    var style = '0';
    var startTime = getToDateFormatDate();
    var endTime = getNowFormatDate();
    $.getJSON('/admin/average?style='+style+'&startTime='+startTime+'&endTime='+endTime,function (Jsondata) {
        data = Jsondata.data;
    });
    return data;
}


function createContainer() {
    var data = getData();
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: '今天每小时平均数据'
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