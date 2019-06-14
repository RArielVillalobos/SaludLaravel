<?php

use Illuminate\Database\Seeder;
use App\MedicalReport;
use Carbon\Carbon;

class MedicalReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MedicalReport::create([
            

            'provision_id'=>1,
            'fecha'=>'2018-07-20',
            'hora'=>'15:00:00',
            'antecedentes'=>'paciente con glaucoma',
            'diagnostico_principal'=>'paciente con glaucoma y cataratas',
            'estado_actual'=>'el paciente tiene glaucoma agudo esta al cuidado de su familia',
            'created_at'=>Carbon::now()

        ]);
    }
}
