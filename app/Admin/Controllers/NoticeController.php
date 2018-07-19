<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;
use App\Notice;

class NoticeController extends Controller
{
	//通知列表页面
	public function index()
	{
		$notices = Notice::paginate(10);
		return view('admin/notice/notice',compact('notices'));
	}

	//通知添加页面
	public function create()
	{
		return view('admin/notice/noticeAdd');
	}
	//通知添加逻辑
	public function store()
	{
		//验证
		$this->validate(request(),[
			'title' => 'required|string',
			'content' => 'required|string'
		]);
		//逻辑
		$result = Notice::create(request(['title','content']));
		if(!$result){
			return back()->withErrors('通知添加失败');
		}
		dispatch(new \App\jobs\SendMessage($result));//将通知分发给队列
		//重定向
		return redirect('admin/notices');
	}
}	