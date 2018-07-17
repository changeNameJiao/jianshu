<?php 

//后台管理路由
Route::group(['prefix' => 'admin'],function(){
	//登录
	Route::get('/login','\App\Admin\Controllers\LoginController@index');  //登录页面
	Route::post('/login','\App\Admin\Controllers\LoginController@login'); //登录逻辑

	Route::group(['middleware' => 'auth:admin'],function(){
		Route::get('/logout','\App\Admin\Controllers\LoginController@logout');//登出
		//首页
		Route::get('/home','\App\Admin\Controllers\HomeController@index');
		//系统管理
		Route::get('/permissions','\App\Admin\Controllers\UserController@permission');  //权限管理
		Route::get('/users','\App\Admin\Controllers\UserController@index');   			//用户管理列表
		Route::get('/users/create','\App\Admin\Controllers\UserController@create');   	//添加用户页面
		Route::post('/users/store','\App\Admin\Controllers\UserController@store');  	//添加用户逻辑
		Route::get('/roles','\App\Admin\Controllers\UserController@role');   			//角色管理
		
		//文章管理
		Route::get('/posts','\App\Admin\Controllers\PostController@index');  //文章管理列表页面
		Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');  //文章操作逻辑
		//专题管理
		Route::get('/topics','\App\Admin\Controllers\TopicController@index');
		//通知管理
		Route::get('/notices','\App\Admin\Controllers\NoticeController@index');
	});
});