<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Post;
use Carbon\Carbon;
use App\User;
use App\Comment;
use App\Zan;

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
    	$posts = $post->orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(10);
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
        $user_id = \Auth::id();
    	$result = $post->create(array_merge($request->except('_token'),compact('user_id')));
    	if(!$result) return $this->error('文章创建失败');
    	return redirect('posts');
    }

    /**
     * 文章详情页
     * [show description]
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function show(Post $post,Comment $comment)
    {   
        $post->load('comments');
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
        $this->authorize('update', $post);
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
        $this->authorize('destroy',$post);
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

    /**
     * 发表评论
     * [comment description]
     * @param  Post                $post    [description]
     * @param  Comment             $comment [description]
     * @param  StoreCommentRequest $request [description]
     * @return [type]                       [description]
     */
    public function comment(Post $post,Comment $comment,StoreCommentRequest $request)
    {
        //验证
        //逻辑 
        $comment->content = request('content'); 
        $comment->user_id  = \Auth::id();
        $result = $post->comments()->save($comment);
        //重定向
        if(!$result){
            return back()->withErrors('评论添加失败');
        }
        return back();
    }

    public function zan(Post $post)
    {
        $param['user_id'] = \Auth::id();
        $param['post_id'] = $post->id;
        $result = Zan::firstOrCreate($param);
        if(!$result){
            return back()->withErrors('点赞失败');
        }
        return back();
    }

    public function unzan(Post $post)
    {
        $result = $post->zan(\Auth::id())->delete();
        if(!$result)
        {
            return back()->withErrors('取消赞失败');
        }
        return back();
    }

}
