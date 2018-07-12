<?php

namespace App;

use App\Model;

class Comment extends Model
{
	//关联文章
    public function post()
    {
    	return $this->belongsTo('App\Post','post_id','id');
    } 

    //关联用户
    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

}
