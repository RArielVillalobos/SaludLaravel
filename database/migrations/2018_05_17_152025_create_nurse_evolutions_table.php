<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNurseEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_enfermeria_id')->unsigned()->unique();
            $table->foreign('cita_enfermeria_id')->references('id')->on('citas_enfermeria');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
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
        Schema::dropIfExists('nurse_evolutions');
    }
}
