<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasKinesiologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_kinesiologias', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('citas');
            $table->integer('kinesiology_diagram_id')->unsigned();
            $table->foreign('kinesiology_diagram_id')->references('id')->on('kinesiology_diagrams');
            $table->integer('kinesiologist_id')->unsigned();
            $table->foreign('kinesiologist_id')->references('id')->on('kinesiologists');
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
        Schema::dropIfExists('citas_kinesiologias');
    }
}
