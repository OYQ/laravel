<?php

namespace App;

use App\Model;

//对应表posts
class Post extends Model
{
    //
    //protected  $table = "post2";修改对应的表名为post2
    //给文章关联用户
    public function user(){
        //第一个是model，第二个自己表是外键，第三个是model表的主键
        return $this->belongsTo('App\User','user_id','id');
    }

    //评论模型
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}
