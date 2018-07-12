<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //被关注的用户
    public function fuser()
    {
    	return $this->hasOne('App\User','id','star_id');
    }

     //关注的用户
    public function suser()
    {
    	return $this->hasOne('App\User','id','fan_id');
    }

    
}
