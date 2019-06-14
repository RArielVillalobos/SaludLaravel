<?php

use Illuminate\Database\Seeder;
use App\Patients;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Patients::create([
            'nombre'=>'marcelo',
            'segundo_nombre'=>'martin',
            'apellido'=>'quinteros',
            'dni'=>'103458770',
            'familiar_responsable'=>'mirna herrera',
            'numero_tel_familiar'=>'2994532323',
           // 'obra_social'=>'IOSFA',
            'numero_afiliado_obra'=>'23212',
            'sexo'=>'M',
            'estado_civil'=>'casado',
            'telefono'=>'2994532334',
            'direccion'=>'campana_mahuida',
            'localidad'=>'Loncopue',
            'fecha_nacimiento'=>'1952-05-19'
        ]);

       /* Patients::create([
            'nombre'=>'Susana',
            'segundo_nombre'=>'Mirna',
            'apellido'=>'Herrera',
            'dni'=>'18518256',
            'familiar_responsable'=>'Gustavo Herrera',
            'numero_tel_familiar'=>'299231478',
            //'obra_social'=>'ISSn',
            'numero_afiliado_obra'=>'2300',
            'sexo'=>'F',
            'estado_civil'=>'casado',
            'telefono'=>'29932658',
            'direccion'=>'campana_mahuida',
            'localidad'=>'Loncopue',
            'fecha_nacimiento'=>'1965-12-15'
        ]);*/
    }
}
