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

}