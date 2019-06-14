<?php

use Illuminate\Database\Seeder;
use App\Provisions;

class ProvisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Provisions::create([
          'autorizado_desde'=>'2018-07-21',
          'autorizado_hasta'=>'2018-07-31',
          'medical_provision_id'=>1,
          'nursing_provision_id'=>1,
          'kinesiology_provision_id'=>1,
          'psycology_provision_id'=>1


        ]);

    }
}
