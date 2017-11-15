<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;



use App\Topic;

class TopicController extends Controller{
    public function index(){
        $topics = Topic::all();
        return view('/admin/topic/index',compact('topics'));
    }

    public function create(){
        return view('/admin/topic/create');
    }

    public function store(){
        $this->validate(request(),[
           'name' => 'required|string'
        ]);

        Topic::create(['name' => request('name')]);

        return redirect("/admin/topics");
    }

    public function destroy(Topic $topic){
        $topic->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

}