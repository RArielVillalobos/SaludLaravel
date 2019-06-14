<?php

use Illuminate\Database\Seeder;
use App\Kinesiologist;

class KinesiologistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Kinesiologist::create([
            'user_id'=>5,
            'numero_matricula'=>'88888',
            'dni'=>'396321',
            'fecha_de_nacimiento'=>'1992-9-02',
            'numero_de_telefono'=>'2323123',
            'domicilio'=>'remigio bosch 380',
            'cod_diagrama'=>'ms'


        ]);
        Kinesiologist::create([
            'user_id'=>9,
            'numero_matricula'=>'0000000',
            'dni'=>'3333333',
            'fecha_de_nacimiento'=>'1991-9-02',
            'numero_de_telefono'=>'122121212',
            'domicilio'=>'remigio bosch 380',
            'cod_diagrama'=>'re'


        ]);

    }
}
