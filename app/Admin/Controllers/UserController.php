<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;
use App\AdminUser;

class UserController extends Controller
{
	public function index()
	{
		$users = AdminUser::paginate(10);
		return view('admin/user/user',compact('users'));
	}

	//添加用户管理页面
	public function create()
	{
		return view('admin/user/userAdd');
	}

	//添加用户管理逻辑
	public function store()
	{
		//验证
		$this->validate(request(),[
			'name' => 'required|string|min:3',
			'password' => 'required|string|min:6'
		]);
		//逻辑
		$name = request('name');
		$password = bcrypt(request('password'));
		if(AdminUser::where('name',$name)->count() > 0){
			return back()->withErrors('用户名已存在');
		}
		AdminUser::create(compact('name','password'));
		//重定向
		return redirect('admin/users');
	}
		
	
}