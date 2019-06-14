<?php

use Illuminate\Database\Seeder;
use App\KinesiologyProvisions;

class KinesiologyProvisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KinesiologyProvisions::create([
            'semana'=>1
        ]);
    }
}
