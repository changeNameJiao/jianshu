<?php

namespace App;
use App\Model;

class Post extends Model
{
	//关联用户
   public function user()
   {
   		return $this->belongsTo('App\User','user_id','id');
   }
   //关联评论
   public function comments()
   {
   		return $this->hasMany('App\Comment')->orderBy('created_at','desc');
   }

   //关联暂
   public function zan($user_id)
   {
   		return $this->hasOne('App\Zan')->where('user_id',$user_id);
   }

   public function zans()
   {
   		return $this->hasMany('App\Zan');
   }
}
