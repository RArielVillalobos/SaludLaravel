<?php

use Illuminate\Database\Seeder;
use App\CitaEvolutionMedical;
use Carbon\Carbon;

class CitaEvolutionMedicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CitaEvolutionMedical::create([
            'id'=>2,
            'doctor_id'=>1,
            'created_at'=>Carbon::now()

        ]);

    }
}
