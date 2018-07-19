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

		Route::group(['middleware' => 'can:system'],function(){
			//权限管理
			Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');          //权限列表
			Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');  //添加权限页面
			Route::post('/permissions','\App\Admin\Controllers\PermissionController@store');         //添加权限逻辑
			//用户管理
			Route::get('/users','\App\Admin\Controllers\UserController@index');   			      //用户管理列表
			Route::get('/users/create','\App\Admin\Controllers\UserController@create');   	      //添加用户页面
			Route::post('/users','\App\Admin\Controllers\UserController@store');  	              //添加用户逻辑
			Route::get('/users/{user}/role','\App\Admin\Controllers\UserController@role');        //用户管理-角色管理页面
			Route::post('/users/{user}/role','\App\Admin\Controllers\UserController@roleStore');  //用户添加角色
			//角色管理
			Route::get('/roles','\App\Admin\Controllers\RoleController@index');   							   //角色列表
			Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');     				   //添加角色页面
			Route::post('/roles','\App\Admin\Controllers\RoleController@store');   							   //添加角色
			Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');   	   //角色 - 权限页面
			Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permissionStore');   //角色添加权限	
		});
		Route::group(['middleware' => 'can:post'],function(){
			//文章管理
			Route::get('/posts','\App\Admin\Controllers\PostController@index');  				 //文章管理列表页面
			Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');  //文章操作逻辑		
		});
		Route::group(['middleware' => 'can:topic'],function(){
			//专题管理
			Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>['index','create','store','destroy']]);//专题列表页、添加专题页面、添加专题页面、删除专题
		});
		Route::group(['middleware' => 'can:notice'],function(){
			//通知管理
			Route::resource('notices','\App\Admin\Controllers\NoticeController',['only'=>['index','create','store']]);//通知列表页面、通知添加页面、通知添加逻辑

			// Route::get('/notices','\App\Admin\Controllers\NoticeController@index');       //通知列表页面
			// Route::get('/notices/create','\App\Admin\Controllers\NoticeController@create');       //通知添加页面
			// Route::post('/notices','\App\Admin\Controllers\NoticeController@store');       //通知添加逻辑
		});	
	});
});