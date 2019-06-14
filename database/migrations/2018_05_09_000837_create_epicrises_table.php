<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpicrisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epicrises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episode_id')->unsigned()->unique();
            $table->foreign('episode_id')->references('id')->on('episodes');
            //el doctor que genera la epicrsis
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->date('fecha_epicrisis');
            $table->time('hora_epicrisis');
            $table->date('fecha_egreso')->nullable();
            /*$table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');*/
            $table->text('diagnostico_egreso');

            //los motivos de egreso
            $table->enum('alta_de_internacion',['si','no'])->nullable();
            $table->enum('fallecimiento',['si','no'])->nullable();
            $table->enum('derivacion_int_nosocomial',['si','no'])->nullable();
            $table->string('institucion')->nullable();
            $table->string('causa_derivacion')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('epicrisis');

           // $table->text('causa_derivacion')->nullable();
            //$table->text('epicrisis');
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
        Schema::dropIfExists('epicrises');
    }
}
