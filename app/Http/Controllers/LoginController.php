<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录页面
    public function index(){
        return view('login/index');
    }

    //登录行为
    public function login(){
        $this->validate(request(),[
            //unique表明表中字段唯一
            'email' => 'required|email',
            'password' => 'required|min:5|max:255',
            'is_remember' => 'integer',
        ]);

        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($user, $is_remember)){
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors("用户不存在或者密码不正确！");

    }

    //登出行为
    public function logout(){
        \Auth::logout();
        return redirect('/login');
    }
}
