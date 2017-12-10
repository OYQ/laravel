<?php

namespace App\admin\Controllers;

use App\EnvInformation as env;
use Illuminate\Support\Facades\Input;

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

    //返回所有数据
    public function info(){
        $model = env::all();
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

    public function tableInfo(){
        $draw = Input::get('draw');
        $start= Input::get('start');
        $length = Input::get('length');

        $getSearch =  Input::get('search');

        $count = env::all()->count();

        if(!empty($getSearch['value'])){
            $search = '%'.$getSearch['value'].'%';

            $temperature = env::where('temperature','like',$search)->get();
            $humidity = env::where('humidity','like',$search)->get();
            $lightIntensity = env::where('lightIntensity','like',$search)->get();
            $soilMoisture = env::where('soilMoisture','like',$search)->get();
            $rainfall = env::where('rainfall','like',$search)->get();
            $time = env::where('time','like',$search)->get();

            $array1 = $temperature->toArray();
            $array2 = $humidity->toArray();
            $array3 = $lightIntensity->toArray();
            $array4 = $soilMoisture->toArray();
            $array5 = $rainfall->toArray();
            $array6 = $time->toArray();

            $collection = collect([$array1,$array2,$array3,$array4,$array5,$array6]);
            $collapsed = $collection->collapse()->unique('id');

            $data = $collapsed->slice($start,$length);

            $temp = $data->toArray();
            $array=[];
            foreach ($temp as $value){
                $array[] = $value;
            }
            $data = collect($array);


            return response()->json([
                'draw' => (integer)$draw,
                'recordsTotal' => (integer)$count,
                'recordsFiltered' => (integer)$collapsed->count(),
                'data' => $data
            ]);


        }else{

            $model = env::orderBy('time', 'desc')->skip($start)->take($length)->get();
            return response()->json([
                'draw' => (integer)$draw,
                'recordsTotal' => (integer)$count,
                'recordsFiltered' => (integer)$count,
                'data' => $model
            ]);
        }


    }

}