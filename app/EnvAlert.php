<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvAlert extends Model
{
    public function hasOneInfo()
    {
        return $this->hasOne('App\EnvInformation', 'id', 'env_id');
    }
}
