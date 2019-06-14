<?php

use Illuminate\Database\Seeder;
use App\Cita;

class CitaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cita::create([
            'episode_id'=>1,
            'comentarios'=>'cita 1 enferm para epi1',
            'fecha'=>'2018-08-31',
            'hora'=>'15:00:00'

        ]);
        Cita::create([
            'episode_id'=>1,
            'comentarios'=>'cita 1 kine epi 1',
            'fecha'=>'2018-08-31',
            'hora'=>'16:00:00'

        ]);
        Cita::create([
            'episode_id'=>1,
            'comentarios'=>'cita 1 psico epi 1',
            'fecha'=>'2018-09-6',
            'hora'=>'15:00:00'

        ]);
    }
}
