<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAssistantEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_assistant_evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_asis_social_id')->unsigned()->unique();
            $table->foreign('cita_asis_social_id')->references('id')->on('citas_asistente_socials');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
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
        Schema::dropIfExists('social_assistant_evolutions');
    }
}
