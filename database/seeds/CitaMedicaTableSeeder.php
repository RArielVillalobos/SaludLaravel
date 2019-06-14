<?php

use Illuminate\Database\Seeder;
use App\CitaMedica;

class CitaMedicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CitaMedica::create([
            'episode_id'=>1,
            'comentarios'=>'cita para ingreso medico',
            'fecha'=>'2018-09-01',
            'hora'=>'12:00:00'

        ]);

       /* CitaMedica::create([
            'episode_id'=>1,
            'comentarios'=>'cita para evolucion medica',
            'fecha'=>'2018-08-04',
            'hora'=>'14:00:00'

        ]);*/
    }
}
