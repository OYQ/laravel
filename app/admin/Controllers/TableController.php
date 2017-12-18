<?php

namespace App\admin\Controllers;

class TableController extends Controller{
    public function dataTable(){
        return view('admin.tables.dataTable');
    }

    public function alertMsg(){
        return view('admin.tables.envAlert');
    }
}