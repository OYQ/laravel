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
        $models = env::all();
        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $models
        ]);
    }


    public function infoTemperature(){
        $models = env::select('temperature','time')->orderBy('time', 'desc')->get();

        $source=[];
        $time=[];
        foreach ($models as $model){
            $source[] = $model->temperature;
            $time[] = substr($model->time,5,14);
        }

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                        'count' => $models->count(),
                        'source' => $source,
                        'time' => $time
            ]
        ]);
    }

    public function infoHumidity(){
        $models = env::select('humidity','time')->orderBy('time', 'desc')->get();
        $source=[];
        $time=[];
        foreach ($models as $model){
            $source[] = $model->humidity;
            $time[] = substr($model->time,5,14);
        }

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                'count' => $models->count(),
                'source' => $source,
                'time' => $time
            ]
        ]);
    }

    public function infoLightIntensity(){
        $models = env::select('lightIntensity','time')->orderBy('time', 'desc')->get();
        $source=[];
        $time=[];
        foreach ($models as $model){
            $source[] = $model->lightIntensity;
            $time[] = substr($model->time,5,14);
        }

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                'count' => $models->count(),
                'source' => $source,
                'time' => $time
            ]
        ]);
    }

    public function infoSoilMoisture(){
        $models = env::select('soilMoisture','time')->orderBy('time', 'desc')->get();
        $source=[];
        $time=[];
        foreach ($models as $model){
            $source[] = $model->soilMoisture;
            $time[] = substr($model->time,5,14);
        }

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                'count' => $models->count(),
                'source' => $source,
                'time' => $time
            ]
        ]);
    }

    public function infoRainfall(){
        $models = env::select('rainfall','time')->orderBy('time', 'desc')->get();
        $source=[];
        $time=[];
        foreach ($models as $model){
            $source[] = $model->rainfall;
            $time[] = substr($model->time,5,14);
        }

        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                'count' => $models->count(),
                'source' => $source,
                'time' => $time
            ]
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