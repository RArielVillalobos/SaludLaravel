<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('doctor_id')->unsigned();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->integer('episode_state_id')->unsigned();
            $table->foreign('episode_state_id')->references('id')->on('episode_states');
            $table->integer('social_work_id')->unsigned();
            $table->foreign('social_work_id')->references('id')->on('social_works');

            //1 activo, 0 de alta, 2 provisorio,3 no ingresado
            //$table->boolean('estado')->default(2);
            $table->date('fecha_ingreso_provisorio')->nullable();
            $table->date('fecha_ingreso_medico')->nullable();
            $table->date('fecha_activacion')->nullable();

            $table->date('fecha_fin')->nullable();


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
        Schema::dropIfExists('episodes');
    }
}
