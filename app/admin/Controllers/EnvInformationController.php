<?php

namespace App\admin\Controllers;

use App\EnvInformation as env;
class EnvInformationController extends Controller{

    //检查number
    public function checkNumber($number){
        if($number <= 0){
            return false;
        }else{
            return true;
        }
    }


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
        if ($this->checkNumber($number)){
            $models = env::select('temperature')->orderBy('time', 'desc') ->take($number) ->get();
            $arr = array();
            foreach($models as $model){
                $arr[] = $model->temperature;
            }

            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => $arr
            ]);
        }else{
            return response()->json([
                'status' => 1,
                'error' => 1,
                'msg' => '发生错误',
                'data' => ''
            ]);
        }


    }

    public function humidity($number){
        if ($this->checkNumber($number)){
            $models = env::select('humidity')->orderBy('time', 'desc') ->take($number) ->get();
            $arr = array();
            foreach($models as $model){
                $arr[] = $model->humidity;
            }

            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => $arr
            ]);
        }else{
            return response()->json([
                'status' => 1,
                'error' => 1,
                'msg' => '发生错误',
                'data' => ''
            ]);
        }
    }

    public function lightIntensity($number){
        if ($this->checkNumber($number)){
            $models = env::select('lightIntensity')->orderBy('time', 'desc') ->take($number) ->get();
            $arr = array();
            foreach($models as $model){
                $arr[] = $model->lightIntensity;
            }

            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => $arr
            ]);
        }else{
            return response()->json([
                'status' => 1,
                'error' => 1,
                'msg' => '发生错误',
                'data' => ''
            ]);
        }
    }

    public function soilMoisture($number){
        if ($this->checkNumber($number)){
            $models = env::select('soilMoisture')->orderBy('time', 'desc') ->take($number) ->get();
            $arr = array();
            foreach($models as $model){
                $arr[] = $model->soilMoisture;
            }

            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => $arr
            ]);
        }else{
            return response()->json([
                'status' => 1,
                'error' => 1,
                'msg' => '发生错误',
                'data' => ''
            ]);
        }
    }

    public function rainfall($number){
        if ($this->checkNumber($number)){
            $models = env::select('rainfall')->orderBy('time', 'desc') ->take($number) ->get();
            $arr = array();
            foreach($models as $model){
                $arr[] = $model->rainfall;
            }

            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => $arr
            ]);
        }else{
            return response()->json([
                'status' => 1,
                'error' => 1,
                'msg' => '发生错误',
                'data' => ''
            ]);
        }
    }

}