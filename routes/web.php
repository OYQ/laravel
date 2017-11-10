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
    return view('welcome');
});
*/

//可以用get post put patch delete options
//Route::post('/posts', '\App\Http\Controllers\PostController@index');
/*
 * <form action="/post" method="POST">
 * </form>
 * */

//Route::match(['get','post'],'/posts', '\App\Http\Controllers\PostController@index');

//Route::put('/posts', '\App\Http\Controllers\PostController@index');
/*
 * <form action="/post" method="POST">
 *      <input type="hidden" name="_method" value="PUT" />
 *      //{{method_field("PUT")}}与上句话等价
 * </form>
 * */

//路由参数
//Route::get('/posts/{id}','\App\Http\Controllers\PostController@index');
//Route::get('/posts/create','\App\Http\Controllers\PostController@index');

//controller方法
/*
 * function index($id){
 *      $id
 * }
*/

/*
//路由分组,增加一个前缀
Route::group(['prefix' => 'posts'] , function (){
    Route::post('/', '\App\Http\Controllers\PostController@index');
    Route::get('/{id}','\App\Http\Controllers\PostController@index');
    Route::get('/create','\App\Http\Controllers\PostController@index');
});
*/

//绑定模型
//post对应的表是posts 对应的主键是id
//Route::get('/posts/{post}','\App\Http\Controllers\PostController@index');
//controller方法
/*
 * function index(\APP\Post $post){
 *      //$post = \APP\Post::find($id);
 * }
*/

//文章列表
Route::get('/posts','\App\Http\Controllers\PostController@index');
//文章详情
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show')->where('post', '[0-9]+');
//创建文章
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');
//编辑文章
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');
//删除文章
Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');
//上传图片
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');