<?php

namespace App;

use App\Model;
use PhpParser\Builder;

//对应表posts
class Post extends Model
{

    /*
     * 模型关联
     * 一对一 hasOne (用户对手机号) 自己有一个，对方有一个
     * 一对多 hasMany (文章-评论) 自己有一个，对方有多个
     * 一对多的反向 belongsTo (评论-文章) 自己有多个，对方有一个
     * 多对多 belongsToMany (用户-角色) 自己有多个，对方有多个
     * 远层一对多 hasManyThrough (国家-作者-文章)
     * 多态关联 morphMany(文章/视频-评论) 一个对方，关联多种自己
     * 多态多对多 morphToMany(文章/视频-标签) 多个对方，关联多种自己
     * */

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

    //赞关联
    public function zan($user_id){
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }

    //获取文章所有赞
    public function zans(){
        return $this->hasMany('App\zan');
    }

    //属于某个作者的文章
    public function scopeAuthorBy($query,$user_id){
        return $query->where('user_id',$user_id);
    }

    //关联
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy($query, $topic_id){
        return $query->doesntHave('postTopics','and',function ($q) use($topic_id){
            $q->where('topic_id', $topic_id);
        });
    }
}
