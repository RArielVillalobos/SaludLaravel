<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('provision_id')->unsigned();
            $table->foreign('provision_id')->references('id')->on('provisions');
            $table->integer('recipe_id')->unsigned()->nullable();
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->integer('indication_id')->unsigned()->nullable();
            $table->foreign('indication_id')->references('id')->on('indications');

            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->text('antecedentes')->nullable();
            $table->text('enfermerdad_actual');
            //$table->text('diagnostico_pasivo');
            //$table->text('diagnostico_activo');
            $table->string('ta')->nullable();
            $table->string('fr')->nullable();
            $table->string('fc')->nullable();
            $table->string('temp')->nullable();
            $table->string('hgt')->nullable();
            $table->string('spo')->nullable();
            $table->string('diuresis')->nullable();
            $table->string('catarsis')->nullable();


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
        Schema::dropIfExists('medical_reports');
    }
}
