<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;

class RoleController extends Controller{
    //角色列表
    public function index(){
        $roles = AdminRole::paginate(10);
        return view('/admin/role/index',compact('roles'));
    }

    //创建角色
    public function create(){
        return view('/admin/role/add');
    }

    //存储角色
    public function store(){
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required',
        ]);

        AdminRole::create(request(['name','description']));
        return redirect('/admin/roles');
    }


    //角色和权限关系
    public function permission(AdminRole $role){
        //获取所有权限
        $permissions = AdminPermission::all();
        //获取当前角色的权限
        $myPermissions = $role->permissions;
        return view('/admin/role/permission',compact('permissions','myPermissions','role'));
    }

    //存储角色和权限行为
    public function storePermission(AdminRole $role){
        $this->validate(request(),[
           'permissions' => 'required|array'
        ]);

        $permissions = AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;

        //删除和增加权限
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermission($permission);
        }

        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission){
            $role->deletePermission($permission);
        }

        return back();
    }
}