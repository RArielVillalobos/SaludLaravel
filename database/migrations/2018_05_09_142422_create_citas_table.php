<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('citas',function (Blueprint $table){
                $table->increments('id');
                $table->integer('episode_id')->unsigned();
                $table->foreign('episode_id')->references('id')->on('episodes');
                /*$table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');*/

                //$table->text('comentarios')->nullable();
                $table->date('fecha');
                $table->time('hora')->nullable();
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
        //
    }
}
