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

Route::get('/', function () {
    return view('welcome');
});

//用户路由

 // Route::group(['middleware'=>'authcheck'],function(){
	Route::get('register','RegisterController@index');				//注册页面
	Route::post('register','RegisterController@register');			//注册逻辑
	Route::get('login','LoginController@index');					//登录页面
	Route::post('login','LoginController@login');					//登录逻辑
	Route::get('logout','LoginController@logout');					//登出逻辑

	Route::get('user/me/setting','LoginController@setting');		//个人设置页面
	Route::post('user/me/setting','LoginController@settingStore');	//个人设置逻辑
	Route::get('user/{user}','UserController@index');				//个人中心
	Route::post('user/{user}/fan','UserController@fan');			//关注
	Route::post('user/{user}/unfan','UserController@unfan');		//取消关注

	// 文章路由
	// Route::resource('posts','PostController');
	Route::get('posts','PostController@index');
	Route::get('posts/create','PostController@create');
	Route::post('posts','PostController@store');
	Route::get('posts/{post}','PostController@show');
	Route::get('posts/{post}/edit','PostController@edit');
	Route::put('posts/{post}','PostController@update');
	Route::get('posts/{post}/delete','PostController@destroy');
	Route::post('posts/image/upload','PostController@imageUpload');
	Route::post('posts/{post}/comment','PostController@comment');//文章评论
	Route::get('posts/{post}/zan','PostController@zan');//点赞
	Route::get('posts/{post}/unzan','PostController@unzan');//取消赞

	//专题模块
	Route::get('topic/{topic}','TopicController@show'); //专题展示页
	Route::post('topic/{topic}/submit','TopicController@submit'); //专题提交

	//通知
	Route::get('notice','NoticeController@show');
 // });
