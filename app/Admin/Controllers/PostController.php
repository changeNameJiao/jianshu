<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
	//文章列表页
	public function index()
	{
		$posts = Post::where('status',0)->paginate(10);
		return view('admin/post/post',compact('posts'));
	}

	//文章操作逻辑
	public function status(Post $post)
	{
		$this->authorize('post', $post);
		//验证
		$this->validate(request(),[
			'status' => 'required',
		]);
		//逻辑
		$status = request('status');
		$result = Post::where('id',$post->id)->update(['status'=>$status]);
		//重定向
		if($result){
			return json_encode([
				'error' => 0,
				'message' => ''
			]);
		}

	}
}