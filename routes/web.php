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


include_once('admin.php');
