<?php 
namespace App\Admin\Controllers;
use App\AdminPermission;

class PermissionController extends Controller
{
	//权限列表页
	public function index()
	{
		$permissions = AdminPermission::paginate(10);
		return view('admin/permission/index',compact('permissions'));
	}

	//添加权限页面
	public function create()
	{
		return view('admin/permission/create');
	}

	//添加权限逻辑
	public function store()
	{
		//验证
		$this->validate(request(),[
			'name' => 'required|string',
			'description' => 'required|string'
		]);
		//逻辑
		$name = request('name');
		if(AdminPermission::where('name',$name)->count() > 0){
			return back()->withErrors('权限已存在');
		}
		$result = AdminPermission::create(request(['name','description']));
		if(!$result){
			return back()->withErrors('权限添加失败');
		}
		//重定向
		return redirect('admin/permissions');
	}
}