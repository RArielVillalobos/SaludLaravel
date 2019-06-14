<?php

use Illuminate\Database\Seeder;
use App\HighType;
class HighTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HighType::create([
            'nombre'=>'Alta Por Internacion Nosocomial'
        ]);

        HighType::create([
            'nombre'=>'Alta Por Fallecimiento'
        ]);
        HighType::create([
            'nombre'=>'Alta Médica'
        ]);
        HighType::create([
            'nombre'=>'Alta Voluntaria'
        ]);


    }
}
