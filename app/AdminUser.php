<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = '';
    protected $fillable = ['name'];
    protected $hidden = ['password'];

    //用户有哪些角色
    public function roles()
    {
    	return $this->belongsToMany('\App\AdminRole','admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    //用户是否有某个角色
    public function isInRole($role)
    {
    	return !!$role->intersect($this->roles)->count(); //$role角色和$this->roles这个集合的交集，返回bool值
    }

    //用户添加角色
    public function assignRole($role)
    {
    	return $this->roles()->save($role);
    }

    //删除用户的某个角色
    public function deleteRole($role)
    {
    	return $this->roles()->detach($role);
    }

    //用户是否有某些权限
    public function hasPermissions($permission)
    {
    	return $this->isInRole($permission->roles);
    }
}
