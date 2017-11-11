<?php

namespace App;

use App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

//对应表users
class User extends Authenticatable
{
    protected $fillable = ['name','email','password'];

    //获取文章
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }

    //获取我的粉丝
    public function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    //获取我关注的粉丝
    public function stars(){
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    //我关注某人
    public function dofan($uid){
        $fan = new  \App\Fan();
        $fan->star_id = $uid;
        //在我关注的人里面，增加一个信息
        return $this->stars()->save($fan);
    }

    //我取消关注某人
    public function doUnfan($uid){
        $fan = new  \App\Fan();
        $fan->star_id = $uid;
        //在我关注的人里面，删除一个信息
        return $this->stars()->delete($fan);
    }

    //当前用户，是否被某一个uid关注
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户，是否关注某个uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }
}
