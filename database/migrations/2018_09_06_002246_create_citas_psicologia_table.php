<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasPsicologiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_psicologia', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('citas');
            $table->integer('psychology_diagram_id')->unsigned();
            $table->foreign('psychology_diagram_id')->references('id')->on('psychology_diagrams');
            $table->integer('psychologist_id')->unsigned();
            $table->foreign('psychologist_id')->references('id')->on('psychologists');


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
        Schema::dropIfExists('cita_psicologias');
    }
}
