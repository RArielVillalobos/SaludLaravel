<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_incomes', function (Blueprint $table) {

            /*
            VERSION VIEJA
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('cita_medical_visits');*/
                    
            $table->increments('id');
            $table->integer('episode_id')->unsigned()->unique();
            $table->foreign('episode_id')->references('id')->on('episodes')->unique();
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->integer('medical_report_id')->unsigned()->nullable()->unique();
            $table->foreign('medical_report_id')->references('id')->on('medical_reports');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->text('comentarios')->nullable();
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
        Schema::dropIfExists('medical_incomes');
    }
}
