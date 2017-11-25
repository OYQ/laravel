<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;



use App\Jobs\SendMessage;
use App\Notice;

class NoticeController extends Controller{
    public function index(){
        $notices = Notice::all();
        return view('/admin/notice/index',compact('notices'));
    }

    public function create(){
        return view('/admin/notice/create');
    }

    public function store(){
        $this->validate(request(),[
           'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $notice = Notice::create(request(['title','content']));
        //分发消息
        dispatch(new SendMessage($notice));

        return redirect("/admin/notices");
    }


}