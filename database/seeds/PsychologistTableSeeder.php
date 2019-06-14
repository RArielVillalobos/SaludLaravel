<?php

use Illuminate\Database\Seeder;
use App\Psychologist;

class PsychologistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Psychologist::create([
            'user_id'=>6,
            'numero_matricula'=>6666,
            'dni'=>'34353465',
            'fecha_de_nacimiento'=>'1986-08-02',
            'numero_de_telefono'=>'2994567225',
            'cod_diagrama'=>'er',
            'domicilio'=>'remigio bosch 380'
            //'estado'=>1

        ]);
    }
}
