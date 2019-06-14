<?php

use Illuminate\Database\Seeder;
use App\NursingShift;

class NursingShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NursingShift::create([
            'nombre'=>'maniana',
            'hora_desde'=>'07:00:00',
            'hora_hasta'=>'13:00:00',

        ]);
        NursingShift::create([
            'nombre'=>'tarde',
            'hora_desde'=>'15:00:00',
            'hora_hasta'=>'20:30:00',

        ]);
        NursingShift::create([
            'nombre'=>'24',
            'hora_desde'=>'06:00:00',
            'hora_hasta'=>'14:00:00',

        ]);
        NursingShift::create([
            'nombre'=>'24',
            'hora_desde'=>'14:00:00',
            'hora_hasta'=>'22:00:00',

        ]);
        NursingShift::create([
            'nombre'=>'24',
            'hora_desde'=>'22:00:00',
            'hora_hasta'=>'06:00:00',

        ]);
        NursingShift::create([
            'nombre'=>'24',
            'hora_desde'=>'00:00:00',
            'hora_hasta'=>'06:00:00',

        ]);

    }
}
