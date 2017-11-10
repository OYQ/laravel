<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //所有函数启动之后执行
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //所有函数启动之前执行
    }
}
