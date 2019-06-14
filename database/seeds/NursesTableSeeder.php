<?php

use Illuminate\Database\Seeder;
use App\Nurse;

class NursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Nurse::create([
            'user_id'=>3,
            'numero_matricula'=>'34322',
            'cod_diagrama'=>'rf'



        ]);

    }
}
