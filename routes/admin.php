<?php

Route::group(['prefix' => 'admin'],function (){
    //登录页面
    Route::get('/login','\App\admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login','\App\admin\Controllers\LoginController@login');
    //登出行为
    Route::get('/logout','\App\admin\Controllers\LoginController@logout');

    //首页
    Route::get('/home','\App\admin\Controllers\HomeController@index');
});