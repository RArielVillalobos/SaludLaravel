<?php

namespace App\Http\Controllers;

use App\Cita;
use App\CitasKinesiologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CitaKinesiologiaController extends Controller
{
    //

    public function store(Request $request){
        //dd($request->all());
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

            $citaKine=new CitasKinesiologia();
            $citaKine->id=$cita->id;
            $citaKine->kinesiology_diagram_id=$request->input('kinesiologist_diagrama_id');
            $citaKine->kinesiologist_id=$request->input('kinesiologist_id');
            $citaKine->save();
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


        $citaEvo=CitasKinesiologia::findOrFail($request->input('cita_id'));
        //dd($citaEvo->cita);

        if($request->input('hora')!=null){
            $cita=Cita::findOrFail($request->input('cita_id'));
            $cita->hora=$request->input('hora');
            $cita->save();
        }


        $citaEvo->kinesiologist_id=$request->input('kinesiologist_id');
        $citaEvo->save();

        return back();
    }

    public function delete(Request $request){
       // dd($request->all());

        $error=null;

        DB::beginTransaction();
        try{
            $citaEvo=CitasKinesiologia::findOrFail($request->input('cita_id_eli'));
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
