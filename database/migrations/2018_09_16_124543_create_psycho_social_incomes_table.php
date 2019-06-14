<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsychoSocialIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psycho_social_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_assistant_id')->unsigned();
            $table->foreign('social_assistant_id')->references('id')->on('social_assistants');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->text('comentarios')->nullable();

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
        Schema::dropIfExists('psycho_social_incomes');
    }
}
