<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_evolution_medical_id')->unsigned()->unique();
            $table->foreign('cita_evolution_medical_id')->references('id')->on('cita_evolution_medicals');
            $table->integer('recipe_id')->unsigned()->nullable();
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->integer('indication_id')->unsigned()->nullable();
            $table->foreign('indication_id')->references('id')->on('indications');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('ta');
            $table->string('fr');
            $table->string('fc');
            $table->string('temp');
            $table->string('hgt');
            $table->string('spo');
            $table->string('diuresis');
            $table->string('catarsis');
            $table->text('evolucion');
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
        Schema::dropIfExists('medical_evolutions');
    }
}
