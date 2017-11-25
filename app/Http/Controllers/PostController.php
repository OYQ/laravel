<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Comment;
use \App\Zan;

class PostController extends Controller
{
    //文章列表
    public function index(){
//        打印日志
        //获取当前app
//        $app = app();
//        //通过log获取注册在容器中的log实例
//        $log = $app-> make('log');
//        $log->info("post_index",['data' => 'this is post index']);

        //预加载用户
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->with('user')->paginate(6);

//        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
//        $posts->load('user');
        
        return view("post/index",compact('posts'));
//        return view("post/index",['posts' => $posts]);
    }

    //文章详情
    public function show(Post $post){
        //在这里提前加载comments，在渲染的时候，就不会进行查询操作
        $post->load('comments');
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
            'content' => 'required|string|min:1',
        ]);
        //2.逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']), compact('user_id'));
        //如果有error的话，会给视图传入errors参数
        Post::create($params);

        //3.渲染，跳转等
        return redirect("/posts");
    }
    //编辑页面
    public function edit(Post $post){
        return view("post/edit", compact('post'));
    }

    //编辑文章
    public function update(Post $post){
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:1',
            'content' => 'required|string|min:10',
        ]);
        $this->authorize('update',$post);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/{$post->id}");
    }
    //删除文章
    public function delete(Post $post){
        $this->authorize('delete',$post);
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

    //评论
    public function comment(Post $post){
        $this->validate(request(),[
            'content' => 'required|string|min:3',
        ]);
        $comment = new  Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');

        //这个会给comment设置post_id
        $post->comments()->save($comment);
//        $comment->save();


        return back();
    }


    //赞和取消赞
    public function zan(Post $post){
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    public function unzan(Post $post){
        $post->zan(\Auth::id())->delete();
        return back();
    }


}
