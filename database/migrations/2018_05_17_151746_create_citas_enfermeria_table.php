<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasEnfermeriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_enfermeria', function (Blueprint $table) {
           // $table->increments('id');
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('citas');
           $table->integer('nurse_id')->unsigned();
           $table->foreign('nurse_id')->references('id')->on('nurses');
           $table->integer('nursing_diagram_id')->unsigned();
           $table->foreign('nursing_diagram_id')->references('id')->on('nursing_diagrams');
           //0 para mañana 1 para tarde
           //$table->integer('nursing_shift_id')->unsigned();
           //$table->foreign('nursing_shift_id')->references('id')->on('nursing_shifts');
           
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
        Schema::dropIfExists('cita_enfermerias');
    }
}
