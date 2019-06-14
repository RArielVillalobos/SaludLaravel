<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaEvolutionMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_evolution_medicals', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('cita_medicas');
            $table->integer('medical_diagram_id')->unsigned();
            $table->foreign('medical_diagram_id')->references('id')->on('medical_diagrams');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');

            //0 pendiente, 1 realizada
            //$table->boolean('estado')->nullable();
            //$table->date('fecha');
            //$table->time('hora');
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
        Schema::dropIfExists('cita_evolution_medicals');
    }
}
