<?php

use Illuminate\Database\Seeder;
use App\EpisodeState;

class EpisodeStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        EpisodeState::create([
            'nombre'=>'provisorio',
            'descripcion'=>'para episodios provisorios'
        ]);

        EpisodeState::create([
            'nombre'=>'activo',
            'descripcion'=>'para episodios activos'
        ]);

        EpisodeState::create([
            'nombre'=>'inactivo',
            'descripcion'=>'para episodios que no ingresaron'
        ]);
        EpisodeState::create([
            'nombre'=>'epicrisis',
            'descripcion'=>'para episodios con epicrisis generada'
        ]);

        EpisodeState::create([
            'nombre'=>'alta',
            'descripcion'=>'para episodios dados de alta'
        ]);
    }
}
