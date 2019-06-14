<?php

use Illuminate\Database\Seeder;
use App\MedicalProvisions;

class MedicalProvisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MedicalProvisions::create([
            'semana'=>1

        ]);
    }
}
