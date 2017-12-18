<?php

namespace App\admin\Controllers;

use App\EnvInformation as env;
use App\EnvAlert as env_alert;
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
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');

        $models = env::select('temperature','time')->whereBetween('time',[$startTime,$endTime])->orderBy('time', 'asc')->get();

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
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');
        $models = env::select('humidity','time')->whereBetween('time',[$startTime,$endTime])->orderBy('time', 'asc')->get();
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
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');
        $models = env::select('lightIntensity','time')->whereBetween('time',[$startTime,$endTime])->orderBy('time', 'asc')->get();
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
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');
        $models = env::select('soilMoisture','time')->whereBetween('time',[$startTime,$endTime])->orderBy('time', 'asc')->get();
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
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');
        $models = env::select('rainfall','time')->whereBetween('time',[$startTime,$endTime])->orderBy('time', 'asc')->get();
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



    public function averageInfo(){
        //0小时，1日，2月
        $style = Input::get('style');
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');

        $x=[];
        $temperature=[];
        $humidity=[];
        $lightIntensity=[];
        $soilMoisture=[];
        $rainfall=[];
        $text='';

        if ($style == 0){
            $models = env::selectRaw('DATE_FORMAT(time,\'%Y%m%d%H\') hours,
                                    avg(temperature) temperature, 
                                    avg(humidity) humidity, 
                                    avg(lightIntensity) lightIntensity, 
                                    avg(soilMoisture) soilMoisture, 
                                    avg(rainfall) rainfall')
                ->whereBetween('time',[$startTime,$endTime])
                ->groupBy('hours')
                ->get();


            foreach ($models as $model){
                $x[] = substr($model->hours,4,2).'月'.substr($model->hours,6,2).'日'.substr($model->hours,8,2).'时';
                $temperature[] = (int)$model->temperature;
                $humidity[] = (int)$model->humidity;
                $lightIntensity[] = (int)$model->lightIntensity;
                $soilMoisture[] = (int)$model->soilMoisture;
                $rainfall[] = (int)$model->rainfall;
            }
            $text = '小时平均数据';
        }

        if ($style == 1){
            $models = env::selectRaw('DATE_FORMAT(time,\'%Y%m%d\') days,
                                    avg(temperature) temperature, 
                                    avg(humidity) humidity, 
                                    avg(lightIntensity) lightIntensity, 
                                    avg(soilMoisture) soilMoisture, 
                                    avg(rainfall) rainfall')
                ->whereBetween('time',[$startTime,$endTime])
                ->groupBy('days')
                ->get();


            foreach ($models as $model){
                $x[] = substr($model->days,4,2).'月'.substr($model->days,6,2).'日';
                $temperature[] = (int)$model->temperature;
                $humidity[] = (int)$model->humidity;
                $lightIntensity[] = (int)$model->lightIntensity;
                $soilMoisture[] = (int)$model->soilMoisture;
                $rainfall[] = (int)$model->rainfall;
            }
            $text = '日平均数据';
        }

        if ($style == 2){
            $models = env::selectRaw('DATE_FORMAT(time,\'%Y%m\') months,
                                    avg(temperature) temperature, 
                                    avg(humidity) humidity, 
                                    avg(lightIntensity) lightIntensity, 
                                    avg(soilMoisture) soilMoisture, 
                                    avg(rainfall) rainfall')
                ->whereBetween('time',[$startTime,$endTime])
                ->groupBy('months')
                ->get();


            foreach ($models as $model){
                $x[] = substr($model->months,0,4).'年'.substr($model->months,4,2).'月';
                $temperature[] = (int)$model->temperature;
                $humidity[] = (int)$model->humidity;
                $lightIntensity[] = (int)$model->lightIntensity;
                $soilMoisture[] = (int)$model->soilMoisture;
                $rainfall[] = (int)$model->rainfall;
            }
            $text = '月平均数据';
        }



        return response()->json(['status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => [
                'text' => $text,
                'xAxis' => $x,
                'temperature' => $temperature,
                'humidity' => $humidity,
                'lightIntensity' => $lightIntensity,
                'soilMoisture' => $soilMoisture,
                'rainfall' => $rainfall,
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


    public function alertInfo()
    {
        $draw = Input::get('draw');
        $start = Input::get('start');
        $length = Input::get('length');

//        $getSearch = Input::get('search');
        $count = env_alert::all()->count();

        $alerts = env_alert::orderBy('time', 'desc')->skip($start)->take($length)->get();
//        return $alerts;
        $arr = array();
        foreach($alerts as $alert){
            $temp = $alert->hasOneInfo;
            $temp->alertid = $alert->id;
            $arr[] = $temp;
//            $arr[] = $alert->hasOneInfo;
        }
        return response()->json([
            'draw' => (integer)$draw,
            'recordsTotal' => (integer)$count,
            'recordsFiltered' => (integer)$count,
            'data' => $arr
        ]);

    }

    public function deleteAlertInfo(){
        $id = Input::get('id');
        $num =  env_alert::where('id',$id)->delete();

        if ($num == 1){
            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => ''
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'error' => 1,
                'msg' => '删除时发生错误',
                'data' => ''
            ]);
        }


    }

}