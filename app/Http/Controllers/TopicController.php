<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
    	//专题的文章数
    	$topic = Topic::withCount('postTopics')->find($topic->id);
    	//属于这个专题的所有文章
    	$topicposts = $topic->posts()->orderBy('created_at','desc')->get();
    	//属于我不属于这个专题的文章
    	$posts = \App\Post::authtorBy(\Auth::id())->topicNotBy($topic->id)->get();
    	//dump(\App\Post::AuthtorBy(\Auth::id()));die;
    	return view('topic/show',compact('topic','topicposts','posts'));
    }

    public function submit(Topic $topic)
    {
    	//验证
    	//逻辑
    	$post_ids = request('post_ids');
    	$topic_id = $topic->id;
    	foreach($post_ids as $post_id){
    		\App\PostTopic::firstOrCreate(compact('topic_id','post_id'));		
    	}
    	//重定向
    	return back();
    	
    }
}
