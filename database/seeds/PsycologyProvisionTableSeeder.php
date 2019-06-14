<?php

use Illuminate\Database\Seeder;
use App\PsycologyProvision;

class PsycologyProvisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PsycologyProvision::create([
            'semana'=>1
        ]);

    }
}
