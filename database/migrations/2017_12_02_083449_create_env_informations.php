<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //EnvInformation
        Schema::create('env_informations', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('temperature')->comment('温度');
            $table->integer('humidity')->comment('湿度');
            $table->integer('lightIntensity')->comment('光照强度');
            $table->integer('soilMoisture')->comment('土壤湿度');
            $table->integer('rainfall')->comment('雨量');
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
        Schema::dropIfExists('env_informations');
    }
}
