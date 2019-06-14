<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('autorizado')->nullable();
            $table->date('fecha_prorroga');
            $table->integer('medical_income_id')->unsigned();
            $table->foreign('medical_income_id')->references('id')->on('medical_incomes');
            $table->integer('medical_report_id')->unsigned()->nullable();
            $table->foreign('medical_report_id')->references('id')->on('medical_reports');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
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
        Schema::dropIfExists('extensions');
    }
}
