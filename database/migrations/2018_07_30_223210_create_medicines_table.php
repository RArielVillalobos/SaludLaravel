<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            //un medicamento pertenece a una clasificacion, esa clasificacion tiene muchos medicamentos
            $table->integer('medication_classification_id')->unsigned()->nullable();
            $table->foreign('medication_classification_id')->references('id')->on('medication_classifications');
            $table->string('droga')->nullable();
            $table->string('presentacion')->nullable();
            //si es antibiotico 1, de lo contrario 0
            $table->boolean('antibiotico')->nullable();
            $table->boolean('opioide')->nullable();
            $table->boolean('psicotropico')->nullable();
            $table->enum('deposito',['deposito','farmacia']);

            $table->string('activo')->nullable();
            $table->integer('stock')->nullable();


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
        Schema::dropIfExists('medicines');
    }
}
