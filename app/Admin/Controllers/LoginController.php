<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;

class LoginController extends Controller
{
	public function index()
	{
		return view('admin/login/login');
	}

	public function login()
	{
		//验证
		$this->validate(request(),[
			'name' => 'required|string|min:3',
			'password' => 'required|string|min:6'
		]);
		//逻辑
		$user = request()->except('_token');
		if(\Auth::guard('admin')->attempt($user)){
			return redirect('admin/home');
		}
		//重定向
		return back()->withErrors('用户名密码不匹配');
	}

	public function logout()
	{
		return \Auth::guard('admin')->logout();
	}
}