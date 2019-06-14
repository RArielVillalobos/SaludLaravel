<?php

use Illuminate\Database\Seeder;
use App\CitaEnfermeria;

class CitaEnfermeriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CitaEnfermeria::create([
            'id'=>1,
            'nurse_id'=>1,

        ]);
    }
}
