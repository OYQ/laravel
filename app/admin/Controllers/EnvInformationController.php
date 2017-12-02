<?php

namespace App\admin\Controllers;

use App\EnvInformation as env;

class EnvInformationController extends Controller{
    public function first(){
        $model = env::first();

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $model

            ]);
//        return env::all();
    }



}