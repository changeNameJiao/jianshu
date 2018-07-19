<?php 
namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{
	//专题列表页
	public function index()
	{
		$topics = Topic::paginate(10);
		return view('admin/topic/topic',compact('topics'));	
	}

	//添加专题页面
	public function create()
	{
		return view('admin/topic/topicAdd');
	}

	//添加专题逻辑
	public function store()
	{
		//验证
		$this->validate(request(),[
			'name' => 'required|string|min:2'
		]);
		//逻辑
		$name = request('name');
		if(Topic::where('name',$name)->count() > 0){
			return back()->withErrors('专题名称已存在');
		}
		$result = Topic::create(compact('name'));
		if(!$result){
			return back()->withErrors('专题添加失败');
		}
		//重定向
		return redirect('admin/topics');
	}

	//删除专题
	public function destroy(Topic $topic)
	{
		$result = $topic->delete();
		if($result){
			return [
				'error' => 0,
				'message' => ''
			];
		}

	}
}
