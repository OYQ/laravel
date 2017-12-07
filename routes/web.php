<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    //将admin的login改到这一页
    return view('welcome');
});
*/

//登录页面
Route::get('/','\App\admin\Controllers\LoginController@index')->name('login');
//登录行为
Route::post('/','\App\admin\Controllers\LoginController@login');
//登出行为
Route::get('/logout','\App\admin\Controllers\LoginController@logout');


//返回第一个所有数据
Route::get('/firstInfo','\App\admin\Controllers\EnvInformationController@firstInfo');
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

include_once('admin.php');
