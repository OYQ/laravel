<?php

namespace App\admin\Controllers;

class ChartsController extends Controller{
    public function chartStatistics(){
        return view('admin.charts.statistics');
    }

    public function chartRealTime(){
        return view('admin.charts.realTime');
    }

}