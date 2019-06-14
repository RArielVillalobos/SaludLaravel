<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKinesiologistEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinesiologist_evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_kinesiologia_id')->unsigned()->unique();
            $table->foreign('cita_kinesiologia_id')->references('id')->on('citas_kinesiologias');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
           /* $table->string('ta');
            $table->string('fr');
            $table->string('fc');
            $table->string('temp');
            $table->string('hgt');
            $table->string('spo');
            $table->string('diuresis');
            $table->string('catarsis');*/
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
        Schema::dropIfExists('kinesiologist_evolutions');
    }
}
