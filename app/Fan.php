<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //获取用户
    public function fuser(){
        return $this->hasOne(\App\User::class, 'id','fan_id');
    }
    //获取被关注的用户
    public function suser(){
        return $this->hasOne(\App\User::class, 'id','star_id');
    }
}
