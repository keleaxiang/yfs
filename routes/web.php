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

//路由组设置
//后台的登录页面
Route::get('admin/logins','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('admin/captcha','Admin\LoginController@captcha');
//后台
Route::group([],function(){
	//后台首页
	Route::get('admins','Admin\IndexController@index');

	//修改头像
	Route::get('admin/profile','Admin\LoginController@profile');
	Route::post('admin/upload','Admin\LoginController@upload');

	//修改密码
	Route::get('admin/pass','Admin\LoginController@pass');
	Route::post('admin/dopass','Admin\LoginController@dopass');

	//后台的管理员
	Route::resource('admin/user','Admin\UserController');
	
	//退出
	Route::get('admin/logout','Admin\LoginController@logout');
});
//后台用户列表
Route::resource('/list','Admin\UserController');
//前台首页
Route::get('','Home\IndexController@index');

// Route::get('/', function () {
//     return view('welcome');
// });


