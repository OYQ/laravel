<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;

use App\AdminPermission;

class PermissionController extends Controller{
    //权限列表
    public function index(){
        $permissions = AdminPermission::paginate(10);
        return view('/admin/permission/index',compact('permissions'));
    }

    //创建权限
    public function create(){
        return view('/admin/permission/add');
    }

    //创建权限行为
    public function store(){
        $this->validate(request(),[
           'name' => 'required|min:3',
           'description' => 'required'
        ]);

        AdminPermission::create(request(['name','description']));
        return redirect('/admin/permissions');
    }
}