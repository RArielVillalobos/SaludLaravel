<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('autorizado_desde')->nullable();
            $table->date('autorizado_hasta')->nullable();
            $table->integer('medical_provision_id')->unsigned()->nullable();
            $table->integer('nursing_provision_id')->unsigned()->nullable();
            $table->integer('kinesiology_provision_id')->unsigned()->nullable();
            $table->integer('psycology_provision_id')->unsigned()->nullable();
            $table->foreign('medical_provision_id')->references('id')->on('medical_provisions');
            $table->foreign('nursing_provision_id')->references('id')->on('nursing_provisions');
            $table->foreign('kinesiology_provision_id')->references('id')->on('kinesiology_provisions');
            $table->foreign('psycology_provision_id')->references('id')->on('psycology_provisions');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provisions');
    }
}
