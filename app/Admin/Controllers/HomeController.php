<?php
/**
 * Created by PhpStorm.
 * User: ouyangquan
 * Date: 2017/11/14
 * Time: 下午12:47
 */

namespace App\Admin\Controllers;

class HomeController extends Controller{
    public function index(){
        return view('admin/home/index');
    }


}