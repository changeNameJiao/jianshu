<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户关联的文章
    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at','desc');
    }
    //用户关联的赞
    public function zans()
    {
        return $this->hasMany('App\Zan');
    }
    //用户的粉丝
    public function fans()
    {
        return $this->hasMany('App\Fan','star_id','id');
    }
    //用户关注的人
    public function stars()
    {
        return $this->hasMany('App\Fan','fan_id','id');
    }
    //关注
    public function doFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id; 
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id; 
        return $this->stars()->delete($fan);
    }
    //是否关注了user_id用户
    public function hasStar($user_id)
    {
        return $this->stars()->where('star_id',$user_id)->count();
    }

    //是否关注了user_id用户
    public function hasFan($user_id)
    {
        return $this->fans()->where('fan_id',$user)->count();
    }
}
