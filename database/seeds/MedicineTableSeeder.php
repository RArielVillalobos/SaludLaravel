<?php

use Illuminate\Database\Seeder;
use App\Medicine;

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Medicine::create([
            'nombre'=>'Medicamento 1',
            'activo'=>'si',
            'cantidad'=>20,
            'observaciones'=>'asdasdasd',
            'contraindicaciones'=>'asdasdasd'
        ]);
        Medicine::create([
            'nombre'=>'Medicamento 2',
            'activo'=>'si',
            'cantidad'=>20,
            'observaciones'=>'asdasdasd',
            'contraindicaciones'=>'asdasdasd'
        ]);
        Medicine::create([
            'nombre'=>'Medicamento 3',
            'activo'=>'si',
            'cantidad'=>20,
            'observaciones'=>'asdasdasd',
            'contraindicaciones'=>'asdasdasd'
        ]);
        Medicine::create([
            'nombre'=>'Medicamento 4',
            'activo'=>'si',
            'cantidad'=>20,
            'observaciones'=>'asdasdasd',
            'contraindicaciones'=>'asdasdasd'
        ]);
        Medicine::create([
            'nombre'=>'Medicamento 5',
            'activo'=>'si',
            'cantidad'=>20,
            'observaciones'=>'asdasdasd',
            'contraindicaciones'=>'asdasdasd'
        ]);

    }
}
