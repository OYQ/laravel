<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvAlert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //EnvInformation
        Schema::create('env_alerts', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('env_id')->comment('报警信息id');
            $table->integer('style')->default(5)->comment('报警类型');
            //0温度1湿度2光照强度3土壤湿度4雨量5未知
            $table->dateTime('time')->default(\DB::raw('CURRENT_TIMESTAMP'))->comment('记录时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_alerts');
    }
}
