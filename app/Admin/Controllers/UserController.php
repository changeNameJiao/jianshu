<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;
use App\AdminUser;
use App\AdminRole;

class UserController extends Controller
{
	public function index()
	{
		$users = AdminUser::paginate(10);
		return view('admin/user/index',compact('users'));
	}

	//添加用户管理页面
	public function create()
	{
		return view('admin/user/create');
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

	//用户的角色列表
	public function role(AdminUser $user)
	{
		$roles = AdminRole::all();
		$myRoles = $user->roles;
		return view('admin/user/role',compact('roles','myRoles','user'));
	}

	//用户添加角色
	public function roleStore(AdminUser $user)
	{
		//验证
		$this->validate(request(),[
			'roles' => 'required|array',
		]);
		//逻辑
		$roles = AdminRole::findMany(request('roles'));
		$myRoles = $user->roles;
		//添加
		$addRoles = $roles->diff($myRoles);
		foreach($addRoles as $role){
			$user->assignRole($role);
		}
		//删除
		$deleteRoles = $myRoles->diff($roles);
		foreach($deleteRoles as $role){
			$user->deleteRole($role);
		}
		//重定向
		return back();
		
	}
		
	
}