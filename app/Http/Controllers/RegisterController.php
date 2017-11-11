<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
        return view('register/index');
    }

    //注册行为
    public function register(){
        $this->validate(request(),[
            //unique表明表中字段唯一
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            //password和password_confirmation相同认证
            'password' => 'required|min:5|max:255|confirmed'
        ]);

        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));//默认加密方法

        $user = User::create(compact('name','email','password'));

        return redirect('/login');
    }
}
