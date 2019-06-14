<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKinesiologistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinesiologists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('numero_matricula');
           // $table->string('dni');
            //$table->date('fecha_de_nacimiento');
            //$table->string('numero_de_telefono');
            //$table->string('domicilio')->nullable();
            $table->string('cod_diagrama',3)->unique();
            //$table->string('edad');
            //0 para inactivo, 1 activo
            //$table->boolean('estado');

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
        Schema::dropIfExists('kinesiologists');
    }
}
