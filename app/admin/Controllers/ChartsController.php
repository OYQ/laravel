<?php

namespace App\admin\Controllers;

class ChartsController extends Controller{
    public function chartStatistics(){
        return view('admin.charts.statistics');
    }

    public function temperature(){
        return view('admin.charts.realTimeTemperature');
    }

    public function humidity(){
        return view('admin.charts.realTimeHumidity');
    }

    public function lightIntensity(){
        return view('admin.charts.realTimeLightIntensity');
    }

    public function soilMoisture(){
        return view('admin.charts.realTimeSoilMoisture');
    }

    public function rainfall(){
        return view('admin.charts.realTimeRainfall');
    }


}