<?php

namespace App\Http\Controllers;

use App\CitaEvolutionMedical;
use App\CitaMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaEvolutionMedicalController extends Controller
{
    //

    public function store(Request $request){


        $error=null;
        DB::beginTransaction();

        try{
            $citaMedi=new CitaMedica();
            $citaMedi->episode_id=$request->input('episode_id');
            $citaMedi->fecha=$request->input('fecha');
            if($request->input('hora')!=null){
                $citaMedi->hora=$request->input('hora');

            }
            $citaMedi->save();

            $citaEvolucionMedica=new CitaEvolutionMedical();
            $citaEvolucionMedica->id=$citaMedi->id;
            $citaEvolucionMedica->medical_diagram_id=$request->input('medical_digrama_id');
            $citaEvolucionMedica->doctor_id=$request->input('medico_id');
            $citaEvolucionMedica->save();
            DB::commit();
            $success=true;


        }catch (\Exception $e){
            $error=$e->getMessage();
            //return $error;
            DB::rollback();
            //return $error;

        }

        return back();


    }

    public function update(Request $request){


        $citaEvo=CitaEvolutionMedical::findOrFail($request->input('cita_id'));

        if($request->input('hora')!=null){
            $cita=CitaMedica::findOrFail($request->input('cita_id'));
            $cita->hora=$request->input('hora');
            $cita->save();
        }


        $citaEvo->doctor_id=$request->input('medico_id');
        $citaEvo->save();

        return back();
    }

    public function delete(Request $request){
        $error=null;

        DB::beginTransaction();
        try{
            $citaEvo=CitaEvolutionMedical::findOrFail($request->input('cita_id_eli'));
            $citaEvo->delete();

            $cita=CitaMedica::findOrFail($request->input('cita_id_eli'));
            $cita->delete();

            DB::commit();
            $success=true;

        }catch (\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
        }

        return back();

    }
}
