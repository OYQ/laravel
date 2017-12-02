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
        Route::get('/chartRealTime','\App\admin\Controllers\ChartsController@chartRealTime');

        //详细数据
        Route::get('/dataTable','\App\admin\Controllers\TableController@dataTable');

    });

});