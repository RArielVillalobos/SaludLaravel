<?php

use Illuminate\Database\Seeder;
use App\NurseEvolution;


class NursingEvolutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NurseEvolution::create([
            'cita_enfermeria_id'=>1,
            'ta'=>'1',
            'fr'=>'jjeje',
            'fc'=>'asdasd',
            'temp'=>'asdas',
            'hgt'=>'asdsad',
            'spo'=>'ss',
            'diuresis'=>'sss',
            'catarsis'=>'ss',
            'evolucion'=>'el paciente responde bien al tratamiento'

        ]);

    }
}
