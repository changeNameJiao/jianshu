<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	//个人设置页面
    public function setting()
    {
    	return view('user/setting');
    }

    //个人设置逻辑
    public function storeSetting()
    {

    }

    //个人中心
    public function index(User $user)
    {
    	$user->load('posts');
    	return view('user/index',compact('user'));
    }
}
