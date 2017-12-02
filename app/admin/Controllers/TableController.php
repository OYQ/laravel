<?php

namespace App\admin\Controllers;

class TableController extends Controller{
    public function dataTable(){
        return view('admin.tables.dataTable');
    }
}