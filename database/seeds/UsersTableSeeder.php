<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        User::create([
            'role_id'=>1,
            'name'=>'admin',
            'last_name'=>'admin',
            'email'=>'admin@salud.com',
            'password'=>bcrypt('1234'),
            'is_admin'=>1,
            'status_id'=>1,
            'domicilio'=>null,
            'fecha_nacimiento'=>null,
            'telefono'=>null,
            'dni'=>'00000000',

           // 'cod_diagrama'=>'gi'
        ]);

        //2
        User::create([
            'role_id'=>2,
            'name'=>'martin doc',
            'last_name'=>'rivera',
            'email'=>'martin@salud.com',
            'password'=>bcrypt('1234'),
            'is_admin'=>0,
            'status_id'=>1,
            'domicilio'=>'remigio bosch',
            'fecha_nacimiento'=>'1996-08-09',
            'telefono'=>'294255892',
            'dni'=>'39523328',

           // 'cod_diagrama'=>'vr'
        ]);
        //3
        User::create([
            'role_id'=>3,
            'name'=>'fernando',
            'last_name'=>'rivas',
            'email'=>'fernando@salud.com',
            'password'=>bcrypt('1234'),
            'is_admin'=>0,
            'status_id'=>1,
            'dni'=>'39523321',


        ]);


        /*User::create([
            'role_id'=>2,
            'name'=>'Melanie',
            'last_name'=>'Guerrero',
            'email'=>'mely@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
           // 'cod_diagrama'=>'gm'
        ]);

        //4




        //5
        User::create([
            'role_id'=>4,
            'name'=>'santiago',
            'last_name'=>'maurin',
            'email'=>'santimaurin@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
           // 'cod_diagrama'=>'ms'


        ]);
        //6

        User::create([
            'role_id'=>5,
            'name'=>'Erik',
            'last_name'=>'Reggio',
            'email'=>'erik@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
           // 'cod_diagrama'=>'re'

        ]);
        //7

        User::create([
            'role_id'=>6,
            'name'=>'martina',
            'last_name'=>'dicaprio',
            'email'=>'martina@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
            //'cod_diagrama'=>'dm'

        ]);

        User::create([
            'role_id'=>3,
            'name'=>'matias',
            'last_name'=>'higuera',
            'email'=>'matias@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
            //'cod_diagrama'=>'hm'

        ]);

        User::create([
            'role_id'=>4,
            'name'=>'eugenia',
            'last_name'=>'rolon',
            'email'=>'eugenia@gmail.com',
            'password'=>bcrypt('ar1el123'),
            'is_admin'=>0,
            'status_id'=>1,
            //'cod_diagrama'=>'hm'

        ]);

*/
    }
}
