<?php

use Illuminate\Database\Seeder;
use App\Medicine;

class MedicineSeeder extends Seeder
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
            'nombre'=>'medicamento 1'
        ]);
        Medicine::create([
            'nombre'=>'medicamento 2'
        ]);
        Medicine::create([
            'nombre'=>'medicamento 3'
        ]);
        Medicine::create([
            'nombre'=>'medicamento 4'
        ]);
        Medicine::create([
            'nombre'=>'medicamento 5'
        ]);
    }
}
