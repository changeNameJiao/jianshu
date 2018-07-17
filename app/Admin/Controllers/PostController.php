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
	public function status()
	{
		dd(request('post_id'));
	}
}