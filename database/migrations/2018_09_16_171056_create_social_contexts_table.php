<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_contexts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psycho_social_income_id')->unsigned()->unique();
            $table->foreign('psycho_social_income_id')->references('id')->on('psycho_social_incomes');
            $table->string('vivienda_adecuada');
            $table->string('cuidadores');
            $table->string('cumple_requi_int_domiciliaria');
            $table->longText('informe');



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
        Schema::dropIfExists('social_contexts');
    }
}
