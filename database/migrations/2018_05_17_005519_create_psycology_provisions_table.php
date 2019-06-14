<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsycologyProvisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psycology_provisions', function (Blueprint $table) {
            $table->increments('id');
           // $table->integer('semana');
            $table->integer('valor')->nullable();
            $table->enum('tipo',['dia','semana'])->nullable();

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
        Schema::dropIfExists('psycology_provisions');
    }
}
