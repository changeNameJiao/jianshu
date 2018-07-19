<?php 
namespace App\Admin\Controllers;
use App\AdminRole;

class RoleController extends Controller
{
	//角色列表页
	public function index()
	{
		$roles = AdminRole::paginate(10);
		return view('admin/role/index',compact('roles'));
	}

	//添加角色页面
	public function create()
	{
		return view('admin/role/create');
	}

	//添加角色逻辑
	public function store()
	{
		//验证
		$this->validate(request(),[
			'name' => 'required|string|min:3',
			'description' => 'required'
		]);
		//逻辑
		$name = request('name');
		if(AdminRole::where('name',$name)->count() > 0){
			return back()->withErrors('角色名称已存在');
		}
		$result = AdminRole::create(request(['name','description']));
		if(!$result){
			return back()->withErrors('角色添加失败');
		}
		//重定向
		return redirect('admin/roles');
	}

	//角色的权限列表
	public function permission(AdminRole $role)
	{
		$permissions = \App\AdminPermission::all();
		$myPermissions = $role->permissions;
		return view('admin/role/permission',compact('role','permissions','myPermissions'));
	}

	public function permissionStore(AdminRole $role)
	{
		//验证
		$this->validate(request(),[
			'permissions' => 'required|array'
		]);
		//逻辑
		$permissions = \App\AdminPermission::findMany(request('permissions')); //必须是个Collection(实例)
		$myPermissions = $role->permissions;
		//添加
		$addPermissions = $permissions->diff($myPermissions);
		foreach($addPermissions as $permission ){
			$role->grantPermission($permission);
		}
		//删除
		$delPermissions = $myPermissions->diff($permissions);
		foreach($delPermissions as $permission){
			$role->deletePermission($permission);
		}		
		
		//重定向
		return back();
	}
}