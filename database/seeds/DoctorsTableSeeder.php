<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Doctor::create([
           'user_id'=>2,
            'numero_matricula'=>1896,
            /*'dni'=>'39523328',
            'fecha_de_nacimiento'=>'1996-08-02',
            'numero_de_telefono'=>'2994567225',
            'domicilio'=>'remigio bosch 380',*/
            'cod_diagrama'=>'va'

            //'activo'=>1
        ]);

     /*   Doctor::create([
            'user_id'=>3,
            'numero_matricula'=>1899,
            'dni'=>'787899',
            'fecha_de_nacimiento'=>'1992-04-12',
            'numero_de_telefono'=>'29943457215',
            'domicilio'=>'remigio bosch 380',
            'cod_diagrama'=>'gm'

            //'activo'=>1
        ]);*/
    }
}
