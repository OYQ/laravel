<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    //文章列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view("post/index",compact('posts'));
//        return view("post/index",['posts' => $posts]);
    }

    //文章详情
    public function show(Post $post){
        return view("post/show",compact('post'));
    }

    //创建文章
    public function create(){
        return view("post/create");
    }

    public function store(){
        //1.不要信息前端，要验证一下
        $this->validate(request(),[
                'title' => 'required|string|max:100|min:5',
                'content' => 'required|string|min:10'
            ]);
        //2.逻辑
        //如果有error的话，会给视图传入errors参数
        Post::create(request(['title','content']));

        //3.渲染，跳转等
        return redirect("/posts");
    }
    //编辑页面
    public function edit(){
        return view("post/edit");
    }

    //编辑文章
    public function update(){
        return;
    }
    //删除文章
    public function delete(Post $post){
        //验证用户权限
        $post->delete();
        return redirect("/posts");
    }


    //上传图片单张
    public function imageUpload(Request $request){
        $path = $request->file('OYQImageUpload')->storePublicly(md5(time()));
        return response()->json([
            'errno' => 0,
            'data' => [asset('storage/'.$path)]
        ]);
    }


}
