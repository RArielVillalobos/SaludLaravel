<?php

namespace App\Http\Controllers;

use App\CitasAsistenteSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cita;


class CitasAsistenteSocialController extends Controller
{
    //
    public function store(Request $request){




        $asis_diagram=$request->input('asis_digrama_id');
        $episode_id=$request->input('episode_id');
        $asis_id=$request->input('asis_id');


        $fecha=$request->input('fecha');


        $error = null;
        DB::beginTransaction();
        try{

            $cita=new Cita();
            $cita->episode_id=$episode_id;
            $cita->fecha=$fecha;
            if($request->input('hora')!=null){
                $cita->hora=$request->input('hora');
            }else{
                $cita->hora=null;
            }
            $cita->save();



            $citaAsis=new CitasAsistenteSocial();
            $citaAsis->id=$cita->id;
            $citaAsis->social_assistant_id=$asis_id;
            $citaAsis->social_assistant_diagram_id=$asis_diagram;

            $citaAsis->save();


            DB::commit();
            $success=true;




        }catch (\Exception $e){
            $success=false;
            $error=$e->getMessage();
            DB::rollback();




        }


        return back();



    }

    public function update(Request $request){

        $error = null;
       DB::beginTransaction();

       try{
           $citaEvo=CitasAsistenteSocial::findOrFail($request->input('cita_id'));

           if($request->input('hora')!=null){
               $cita=Cita::findOrFail($request->input('cita_id'));
               $cita->hora=$request->input('hora');
               $cita->save();




           }
           $citaEvo->social_assistant_id=$request->input('asis_id');
           $citaEvo->save();
           DB::commit();
           $success=true;


       }catch (\Exception $e){
           $success=false;
           $error=$e->getMessage();
           DB::rollback();
           dd($error);
       }





        return back();
    }

    public function delete(Request $request){
        $error=null;

        DB::beginTransaction();
        try{
            $citaEvo=CitasAsistenteSocial::findOrFail($request->input('cita_id_eli'));
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

    public function cargarCita($idCita){

        $cita_asis=CitasAsistenteSocial::findOrFail($idCita);


        return view('citas.asistente_social.asistente_social',compact('cita_asis'));
    }
}
