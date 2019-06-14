<?php

use Illuminate\Database\Seeder;
use App\Episode;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Episode::create([
            'patient_id'=>1,
            'doctor_id'=>1,
            //'estado'=>2,
            'episode_state_id'=>1,
            'social_work_id'=>1,
            'fecha_ingreso_provisorio'=>'2019-06-14',
            'fecha_ingreso_medico'=>null,
            'fecha_activacion'=>null,
            'fecha_fin'=>null,


        ]);

        /*Episode::create([
            'patient_id'=>2,
            'doctor_id'=>1,
            //'estado'=>2,
            'episode_state_id'=>1,
            'social_work_id'=>2,
            'fecha_ingreso_provisorio'=>'2018-07-17',
            'fecha_ingreso_medico'=>null,
            'fecha_activacion'=>null,
            'fecha_fin'=>null,


        ]);*/
    }
}
