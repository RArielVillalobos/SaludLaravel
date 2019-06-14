<?php

use Illuminate\Database\Seeder;
use App\NursingProvisions;

class NursingProvisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NursingProvisions::create([
            'dia'=>1
        ]);
    }
}
