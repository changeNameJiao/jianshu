<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * 文章列表页
     * [index description]
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function index(Post $post)
    {
    	$posts = $post->orderBy('created_at','desc')->paginate(10);
    	return view('post/index',compact('posts'));
    }
    /**
     * 创建文章展示页
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
    	return view('post/create');
    }

    /**
     * 创建文章逻辑处理
     * [store description]
     * @param  Post             $post    [description]
     * @param  StorePostRequest $request [description]
     * @return [type]                    [description]
     */
    public function store(Post $post,StorePostRequest $request)
    {
    	$result = $post->create($request->except('_token'));
    	if(!$result) return $this->error('文章创建失败');
    	return redirect('posts');
    }

    /**
     * 文章详情页
     * [show description]
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function show(Post $post)
    {   
    	return view('post/show',compact('post'));
    }

    /**
     * 文章编辑渲染页
     * [edit description]
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function edit(Post $post)
    {
    	return view('post/edit',compact('post'));
    }

    /**
     * 文章编辑逻辑处理
     * [update description]
     * @param  Post             $post    [description]
     * @param  StorePostRequest $request [description]
     * @return [type]                    [description]
     */
    public function update(Post $post,StorePostRequest $request)
    {
        $result = $post->update($request->except('_token'));
        if(!$result){
            return $this->error('文章编辑失败');
        }
        return redirect('posts/'.$post->id);
    }

    /**
     * 文章删除
     * [destroy description]
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        if(!$result){
            return $this->error('文章删除失败');
        }
        return redirect('posts');
    }

    /**
     * 图片上传处理
     * [imageUpload description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('/storage/'.$path);
    }
}
