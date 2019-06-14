<?php

namespace App\Http\Controllers;

use App\Cita;
use App\CitaPsicologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaPsicologiaController extends Controller
{
    //

    public function store(Request $request){
        $error=null;
        DB::beginTransaction();

        try{
            $cita=new Cita();
            $cita->episode_id=$request->input('episode_id');
            $cita->fecha=$request->input('fecha');
            if($request->input('hora')!=null){
                $cita->hora=$request->input('hora');

            }
            $cita->save();

            $citaPsi=new CitaPsicologia();
            $citaPsi->id=$cita->id;
            $citaPsi->psychology_diagram_id=$request->input('psychology_digrama_id');
            $citaPsi->psychologist_id=$request->input('psychologist_id');
            $citaPsi->save();
            DB::commit();
            $success=true;


        }catch (\Exception $e){
            $error=$e->getMessage();
           // return $error;
            //return $error;
            DB::rollback();
            //return $error;

        }

        return back();

    }

    public function update(Request $request){
        //dd($request->all());


        $citaEvo=CitaPsicologia::findOrFail($request->input('cita_id'));
        //dd($citaEvo->cita);

        if($request->input('hora')!=null){
            $cita=Cita::findOrFail($request->input('cita_id'));
            $cita->hora=$request->input('hora');
            $cita->save();
        }


        $citaEvo->psychologist_id=$request->input('psychologist_id');
        $citaEvo->save();

        return back();
    }

    public function delete(Request $request){

        $error=null;

        DB::beginTransaction();
        try{
            $citaEvo=CitaPsicologia::findOrFail($request->input('cita_id_eli'));
            $citaEvo->delete();

            $cita=Cita::findOrFail($request->input('cita_id_eli'));
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
