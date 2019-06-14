<?php

use Illuminate\Database\Seeder;
use App\CitasKinesiologia;

class CitaKinesiologiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CitasKinesiologia::create([
            'id'=>2,
            'kinesiologist_id'=>1
        ]);
    }
}
