<?php

namespace App\admin\Controllers;


use App\EnvAlert as env_alert;
use Illuminate\Support\Facades\Input;

class EnvAlertsController extends Controller{
    function allAlerts(){
        $alerts = env_alert::all();

        $arr = array();
        foreach($alerts as $alert){
            $arr[] = $alert->hasOneInfo;
        }

        return response()->json([
            'status' => 1,
            'error' => 0,
            'msg' => '',
            'data' => $arr
        ]);

    }

    function firstAlert(){
        $alert = env_alert::orderBy('time', 'desc')->first();
        if ($alert){
            $info = $alert->hasOneInfo;
            $style = '';
            $zhi = '';

            switch ($alert->style)
            {
                case 0:
                    $style = '温度';
                    $zhi = $info->temperature;
                    break;
                case 1:
                    $style = '湿度';
                    $zhi = $info->humidity;
                    break;
                case 2:
                    $style = '光照强度';
                    $zhi = $info->lightIntensity;
                    break;
                case 3:
                    $style = '土壤湿度';
                    $zhi = $info->soilMoisture;
                    break;
                case 4:
                    $style = '雨量';
                    $zhi = $info->rainfall;
                    break;
                default:
                    $style = '未知';
            }


            return response()->json([
                'status' => 1,
                'error' => 0,
                'msg' => '',
                'data' => [
                    'style' => $style,
                    'zhi' => $zhi,
                    'time' => $alert->time
                ]
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'error' => 1,
                'msg' => '无警报信息',
                'data' => ''
            ]);
        }

    }
}