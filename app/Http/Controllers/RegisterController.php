<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRegisterRequest;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
    	return view('register/register');
    }

    //注册逻辑
    public function register(StoreRegisterRequest $request)
    {
        //验证
        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name','email','password'));
        if(!$user){
            return $this->error('注册失败');
        }  
        //重定向     
    	return redirect('login');
    }
}
