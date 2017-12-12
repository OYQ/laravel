$.ajaxSetup({
    async: false
});

var isLightIntensity = false;
var isSoilMoisture = true;
var isRainfall = true;


var dic = new Array();
dic["temperature"] = "温度";
dic["humidity"] = "湿度";
dic["lightIntensity"] = "光照强度";
dic["soilMoisture"] = "土壤湿度";
dic["rainfall"] = "雨量";

createContainer('temperature');
createContainer('humidity');

var time = 1;

$(document).ready(function() {
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
    console.time(container);
    var data = getData(container);
    Highcharts.chart(container, {
        chart: {
            zoomType: 'x'
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
    console.timeEnd(container);
}




function getData(container) {
    var arr = [];
    var ret = [];
    var n;
    $.getJSON('/admin/info/'+container,function (Jsondata) {
        var data;
        n = Jsondata.data.count;
        data = Jsondata.data.source;
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
    return ret;



}