<?php

use Illuminate\Database\Seeder;
use App\SocialAssistant;

class SocialAssistantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SocialAssistant::create([
            'user_id'=>7,

            'numero_matricula'=>2233,
            'dni'=>'111111',
            'fecha_de_nacimiento'=>'1996-08-23',
            'numero_de_telefono'=>'2934343',
            'domicilio'=>'remigio bosch',
            'activo'=>1
        ]);

    }
}
