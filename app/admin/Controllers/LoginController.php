<?php

namespace App\admin\Controllers;

use Illuminate\Support\Facades\Input;

class LoginController extends Controller{
    public function index(){
        return view('admin.login.index');
    }

    public function login(){
        //验证
        $this->validate(request(),[
            'name' => 'required|min:2|max:30',
            'password' => 'required|min:5|max:255',
        ]);

        //逻辑
        $user = request(['name','password']);
        if (\Auth::guard("admin")->attempt($user)){
            return redirect('/admin/dashboard');
        }

        //渲染
        return \Redirect::back()->withErrors("用户名密码不匹配");
    }

    public function logout(){
        \Auth::guard("admin")->logout();
        return redirect('/');
    }

}