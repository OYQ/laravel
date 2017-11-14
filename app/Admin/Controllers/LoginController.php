<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;

class LoginController extends Controller{
    public function index(){
        return view('admin/login/index');
    }

    public function login(){
        $this->validate(request(),[
            //unique表明表中字段唯一
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:255',
        ]);

        $user = request(['name','password']);
        if (\Auth::guard("admin")->attempt($user)){
            return redirect('/admin/home');
        }

        return \Redirect::back()->withErrors("用户不存在或者密码不正确！");
    }

    public function logout(){
        \Auth::guard("admin")->logout();
        return redirect('/admin/login');
    }
}