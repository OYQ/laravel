<?php

Route::group(['prefix' => 'admin'],function (){

    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','\App\admin\Controllers\HomeController@index');

        //仪表盘
        Route::get('/dashboard','\App\admin\Controllers\DashboardController@index');

        //数据图表
        //数据统计
        Route::get('/chart/largeData','\App\admin\Controllers\ChartsController@largeData');
        Route::get('/chart/meanData','\App\admin\Controllers\ChartsController@meanData');
        //实时数据
        Route::get('/chartRealTime/temperature','\App\admin\Controllers\ChartsController@temperature');
        Route::get('/chartRealTime/humidity','\App\admin\Controllers\ChartsController@humidity');
        Route::get('/chartRealTime/lightIntensity','\App\admin\Controllers\ChartsController@lightIntensity');
        Route::get('/chartRealTime/soilMoisture','\App\admin\Controllers\ChartsController@soilMoisture');
        Route::get('/chartRealTime/rainfall','\App\admin\Controllers\ChartsController@rainfall');

        //详细数据
        Route::get('/dataTable','\App\admin\Controllers\TableController@dataTable');
        //警报信息
        Route::get('/alertMsg','\App\admin\Controllers\TableController@alertMsg');

        //API
        //返回第一个所有数据
        Route::get('/firstInfo','\App\admin\Controllers\EnvInformationController@firstInfo');
        //返回所有数据
        Route::get('/info','\App\admin\Controllers\EnvInformationController@info');
        Route::get('/info/temperature','\App\admin\Controllers\EnvInformationController@infoTemperature');
        Route::get('/info/humidity','\App\admin\Controllers\EnvInformationController@infoHumidity');
        Route::get('/info/lightIntensity','\App\admin\Controllers\EnvInformationController@infoLightIntensity');
        Route::get('/info/soilMoisture','\App\admin\Controllers\EnvInformationController@infoSoilMoisture');
        Route::get('/info/rainfall','\App\admin\Controllers\EnvInformationController@infoRainfall');
        //平均信息
        Route::get('/average','\App\admin\Controllers\EnvInformationController@averageInfo');

        //返回table需要的数据数据
        Route::get('/tableInfo','\App\admin\Controllers\EnvInformationController@tableInfo');
        //返回警报信息需要的数据
        Route::get('/alertInfo','\App\admin\Controllers\EnvInformationController@alertInfo');
        Route::get('/deleteAlertInfo','\App\admin\Controllers\EnvInformationController@deleteAlertInfo');
        //返回前number条温度数据
        Route::get('/{number}/temperature','\App\admin\Controllers\EnvInformationController@temperature');
        //返回第一个湿度数据
        Route::get('/{number}/humidity','\App\admin\Controllers\EnvInformationController@humidity');
        //返回第一个光照强度数据
        Route::get('/{number}/lightIntensity','\App\admin\Controllers\EnvInformationController@lightIntensity');
        //返回第一个土壤湿度数据
        Route::get('/{number}/soilMoisture','\App\admin\Controllers\EnvInformationController@soilMoisture');
        //返回第一个雨量数据
        Route::get('/{number}/rainfall','\App\admin\Controllers\EnvInformationController@rainfall');

        //放回所有警报信息
        Route::get('/allAlerts','\App\admin\Controllers\EnvAlertsController@allAlerts');
        //放回第一条警报信息
        Route::get('/firstAlert','\App\admin\Controllers\EnvAlertsController@firstAlert');


    });

});