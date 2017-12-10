<?php

Route::group(['prefix' => 'admin'],function (){

    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','\App\admin\Controllers\HomeController@index');

        //仪表盘
        Route::get('/dashboard','\App\admin\Controllers\DashboardController@index');

        //数据图表
        //数据统计
        Route::get('/chartStatistics','\App\admin\Controllers\ChartsController@chartStatistics');
        //实时数据
        Route::get('/chartRealTime/temperature','\App\admin\Controllers\ChartsController@temperature');
        Route::get('/chartRealTime/humidity','\App\admin\Controllers\ChartsController@humidity');
        Route::get('/chartRealTime/lightIntensity','\App\admin\Controllers\ChartsController@lightIntensity');
        Route::get('/chartRealTime/soilMoisture','\App\admin\Controllers\ChartsController@soilMoisture');
        Route::get('/chartRealTime/rainfall','\App\admin\Controllers\ChartsController@rainfall');

        //详细数据
        Route::get('/dataTable','\App\admin\Controllers\TableController@dataTable');

        //API
        //返回第一个所有数据
        Route::get('/firstInfo','\App\admin\Controllers\EnvInformationController@firstInfo');
        //返回所有数据
        Route::get('/info','\App\admin\Controllers\EnvInformationController@info');
        //返回table需要的数据数据
        Route::get('/tableInfo','\App\admin\Controllers\EnvInformationController@tableInfo');
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


    });

});