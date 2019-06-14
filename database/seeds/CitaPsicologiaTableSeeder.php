<?php

use Illuminate\Database\Seeder;
use App\CitaPsicologia;

class CitaPsicologiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CitaPsicologia::create([
            'id'=>3,
            'psychologist_id'=>1
        ]);
    }
}
