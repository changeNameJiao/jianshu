<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreLoginRequest;
class LoginController extends Controller
{
    //登录页面
    public function index()
    {
    	return view('login/login');
    }

    //登录逻辑
    public function login(StoreLoginRequest $request)
    {
        $user = request()->only('email','password');
        $is_remember = boolval(request('is_remember'));
        if(\Auth::attempt($user,$is_remember)){
            return redirect('posts');
        }else{
            return back()->withErrors(['message'=>'邮箱密码不匹配']);
        }

    }

    //退出逻辑
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
