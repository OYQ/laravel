<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:33
 */

//管理后台
Route::group(['prefix' => 'admin'],function (){

    //登录
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login','\App\Admin\Controllers\LoginController@login');

    //登出行为
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        //管理人员模块
        Route::get('/users','\App\Admin\Controllers\UserController@index');
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');
        Route::post('/users/store','\App\Admin\Controllers\UserController@store');

        //审核模块
        Route::get('/posts','\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');
    });

});