<?php

namespace App\admin\Controllers;

use App\EnvInformation as env;

class EnvInformationController extends Controller{
    //返回第一条所有数据
    public function firstInfo(){
        $model = env::first();

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $model
            ]);
    }

    public function temperature($number){
        $model = env::first();
        $temp = $model->temperature;
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $temp
        ]);
    }

    public function humidity(){
        $model = env::first();
        $temp = $model->humidity;
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $temp
        ]);
    }

    public function lightIntensity(){
        $model = env::first();
        $temp = $model->lightIntensity;
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $temp
        ]);
    }

    public function soilMoisture(){
        $model = env::first();
        $temp = $model->soilMoisture;
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $temp
        ]);
    }

    public function rainfall(){
        $model = env::first();
        $temp = $model->rainfall;
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $temp
        ]);
    }

}