<?php

namespace App;
use App\Model;
use Illuminate\Database\Eloquent\Builder;

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
   //属于某个作者的文章
   public function scopeAuthtorBy(Builder $query,$user_id)
   {
      return $query->where('user_id',$user_id);
   }

   public function postTopics()
   {
      return $this->hasMany('App\PostTopic','post_id','id');
   }
   //不属于某个专题的文章
   public function scopeTopicNotBy(Builder $query,$topic_id)
   {
      return $query->doesntHave('posttopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
      });
   }


}
