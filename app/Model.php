<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//对应表posts
class Model extends BaseModel
{
    protected $guarded = [];//不可以使用数组注入哪些数据
//    protected $fillable = ['title', 'content'];//可以使用数组注入哪些数据

}
