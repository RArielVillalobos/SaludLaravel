<?php

namespace App\Http\Controllers;

use App\Episode;
use App\NoIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoIncomeController extends Controller
{
    //


    public function store(Request $request){
        //dd($request->all());
        $episodio_id=$request->input('episode_id');
        $mensajes=[
            'motivo.required'=>'El motivo de no ingreso es requerido'
        ];

        $this->validate($request,[
            'motivo'=>'required'
        ],$mensajes);

        $error=null;
        DB::beginTransaction();

        try{

            $noIngreso=new NoIncome();
            $noIngreso->episode_id=$episodio_id;
            $noIngreso->fecha_no_ingreso=$request->input('fecha_no_ingreso');
            $noIngreso->fecha_ingreso_medico=$request->input('fecha_ingreso_med');
            $noIngreso->motivo_no_ingreso=$request->input('motivo');
            $noIngreso->observaciones=$request->input('observaciones');

            $noIngreso->save();

            $episodio=Episode::find($episodio_id);
            //marcamos el episodio como ianctivo o no ingresado q es el id 3
            $episodio->episode_state_id=3;
            $episodio->save();

            DB::commit();
            return back()->with('clase','success')->with('message','No Ingreso Generado Correctamente');

        }catch(\Exception $e){
            $error=$e->getMessage();
            DB::rollback();

            $success=false;
            return back()->with('clase','danger')->with('message','Hubo un Error');
        }


    }


}
