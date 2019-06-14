<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('apellido');

            $table->string('dni')->unique();
            $table->string('familiar_responsable')->nullable();
            $table->string('numero_tel_familiar');
           // $table->string('obra_social');
            $table->string('numero_afiliado_obra')->nullable();
            $table->string('sexo');
            $table->string('estado_civil')->nullable();

            $table->string('telefono');
            $table->string('direccion');
            $table->string('localidad');
            $table->date('fecha_nacimiento');

            /*$table->string('viv_adecuada');
            $table->string('cumple_reque_int');
            //familiares y responsables conocen el el dx?
            $table->string('grado_inf_enf_pac');
            $table->string('grado_inf_enf_fam');



            */
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
        Schema::dropIfExists('patients');
    }
}
