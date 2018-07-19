<?php

namespace App;

use App\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    //当前角色的所有权限
    public function permissions()
    {
    	return $this->belongsToMany('\App\AdminPermission','admin_permission_role','role_id','permission_id')->withPivot(['role_id','permission_id']);
    }

    //给某个角色赋予权限
    public function grantPermission($permission)
    {
    	return $this->permissions()->save($permission);
    }

    //角色取消某个权限
    public function deletePermission($permission)
    {
    	return $this->permissions()->detach($permission);
    }

    //角色是否有某个权限
    public function hasPermission($permission)
    {
    	return $this->permissions->contains($permission); //$this->permission集合中是否有$permission权限
    }
}
