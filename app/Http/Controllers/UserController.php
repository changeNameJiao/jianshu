<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	//个人设置页面
    public function setting()
    {
    	return view('user/setting');
    }

    //个人设置逻辑
    public function storeSetting()
    {

    }

    //个人中心
    public function index(User $user)
    {
   		//用户信息，用户的关注、粉丝、文章数
   		$user = User::withCount(['stars','fans','posts'])->find($user->id);
   		//用户的所有文章
    	$user->load('posts');
    	//关注用户的信息、关注、粉丝、文章数
    	$stars = $user->stars;
    	$susers = User::whereIn('id',$stars->pluck('star_id'))->orderBy('created_at','desc')->withCount(['stars','fans','posts'])->get(); 
    	//粉丝用户的信息、关注、粉丝、文章数
    	$fans = $user->fans;
    	$fusers = User::whereIn('id',$fans->pluck('fan_id'))->orderBy('created_at','desc')->withCount(['stars','fans','posts'])->get();
    	return view('user/index',compact('user','susers','fusers'));
    }

    public function fan(User $user)
    {
    	$me = \Auth::user();
    	$me->doFan($user->id);
    	return[
    		'error' => 0,
    		'msg' => ''
    	];
    }
    public function unfan(User $user)
    {
    	$me = \Auth::user();
    	$me->doUnFan($user->id);
    	return[
    		'error' => 0,
    		'msg' => ''
    	];
    }
}
