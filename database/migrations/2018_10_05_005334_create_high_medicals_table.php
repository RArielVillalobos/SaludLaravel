<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('high_medicals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('epicrisis_id')->unsigned()->nullable()->unique();
            $table->foreign('epicrisis_id')->references('id')->on('epicrises');
             $table->integer('high_type_id')->unsigned();
             $table->foreign('high_type_id')->references('id')->on('high_types');
             $table->date('fecha_alta')->nullable();
             $table->time('hora_alta')->nullable();
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
        Schema::dropIfExists('high_medicals');
    }
}
