<?php

namespace App;

use App\Model;

class Topic extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('\App\Post','post_topics','topic_id','post_id');
    }

    //专题的文章数
    public function postTopics()
    {
    	return $this->hasMany('App\PostTopic','topic_id','id');
    }
}
