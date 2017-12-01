<?php

namespace App\admin\Controllers;

class DashboardController extends Controller{
    public function index(){
        return view('admin.dashboard.index');
    }
}