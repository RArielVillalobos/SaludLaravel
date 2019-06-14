<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create([
            'nombre'=>'activo'
        ]);

        Status::create([
            'nombre'=>'inactivo'
        ]);

    }
}
