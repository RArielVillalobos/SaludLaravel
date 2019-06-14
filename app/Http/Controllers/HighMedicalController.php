<?php

namespace App\Http\Controllers;

use App\Episode;
use App\HighMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighMedicalController extends Controller
{
    //

    public function store(Request $request){


        $error=null;
        DB::beginTransaction();
        try{
            $altaMedica=new HighMedical();
            $altaMedica->epicrisis_id=$request->input('epicrisis_id');
            $altaMedica->fecha_alta=$request->input('fecha_alta');
            $altaMedica->hora_alta=$request->input('hora_alta');
            $altaMedica->high_type_id=$request->input('tipo_alta_id');
            $altaMedica->save();


            $episodio=Episode::find($request->input('episode_id'));
            $episodio->episode_state_id=5;
            //fecha de alta
            $episodio->fecha_fin=$altaMedica->fecha_alta;
            $episodio->save();
            DB::commit();
            return back()->with('clase','success')->with('message','Paciente dado de Alta Correctamente');

        }catch (\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
            $success=false;

            return back()->with('clase','danger')->with('message','Hubo un error Intente Nuevamente');

        }











    }
}
