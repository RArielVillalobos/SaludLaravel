<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name'=>'admin',
            'description'=>'rol perteneciente a admines'
        ]);

        Role::create([
            'name'=>'doctor',
            'description'=>'rol perteneciente a doctores'
        ]);

        Role::create([
            'name'=>'enfermero',
            'description'=>'rol perteneciente a enfermeros'
        ]);

        Role::create([
            'name'=>'kinesiologo',
            'description'=>'rol perteneciente a kinesiologos'
        ]);
        Role::create([
            'name'=>'psicologo',
            'description'=>'rol perteneciente a psicologos'
        ]);
        Role::create([
            'name'=>'asistente_social',
            'description'=>'rol perteneciente a asistentes social'
        ]);

        Role::create([
            'name'=>'coordinacion',
            'description'=>'rol perteneciente a cordinadores'
        ]);
    }
}
