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


Route::get('/', 'LoginController@index');

//注册
Route::get('/register', 'BlogController@index');

// 联系表单
Route::any('/contact', 'BlogController@Register');

//用户界面
Route::any('/user', 'UserController@index');

//获取用户信息
Route::any('/user/getChild', 'UserController@getChild');

//用户信息界面
Route::get('/detail/{user_id}', 'UserController@detail');

//修改用户信息
Route::post('/edit', 'UserController@userEdit');

//删除用户信息
Route::post('/delUser', 'UserController@userDel');

//登录
Route::post('/tologin', 'LoginController@login');


