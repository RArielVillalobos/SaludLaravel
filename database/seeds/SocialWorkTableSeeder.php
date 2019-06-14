<?php

use Illuminate\Database\Seeder;
use App\SocialWork;

class SocialWorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SocialWork::create([
            'nombre'=>'iose'
        ]);

        SocialWork::create([
            'nombre'=>'issn'
        ]);

    }
}
