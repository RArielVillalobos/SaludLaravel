<?php

namespace App\Http\Controllers;

use App\CitaEnfermeria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cita;


class CitaEnfermeriaController extends Controller
{
    //
    public function cargar (CitaEnfermeria $id){


        $cita_enfermerias=CitaEnfermeria::findOrFail($id)->last();








        return view('citas.enfermeria.enfermeria',compact('cita_enfermerias'));
    }

    public function delete(Request $request){
        //dd($request->all());
        $error=null;

        DB::beginTransaction();
        try{
            $citaEnf=CitaEnfermeria::findOrFail($request->input('cita_id_eli'));
            $citaEnf->delete();

            $cita=Cita::findOrFail($request->input('cita_id_eli'));
            $cita->delete();

            DB::commit();
            $sucess=true;

        }catch (\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
        }

        return back();


    }
}
