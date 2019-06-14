<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasAsistenteSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_asistente_socials', function (Blueprint $table) {

            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('citas');
            $table->integer('social_assistant_diagram_id')->unsigned();
            $table->foreign('social_assistant_diagram_id')->references('id')->on('social_assistant_diagrams');
            $table->integer('social_assistant_id')->unsigned();
            $table->foreign('social_assistant_id')->references('id')->on('social_assistants');
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
        Schema::dropIfExists('citas_asistente_socials');
    }
}
