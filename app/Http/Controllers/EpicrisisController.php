<?php

namespace App\Http\Controllers;
use App\Epicrisis;
use App\Episode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class EpicrisisController extends Controller
{
    //
    public function show($idepisode){
        $episode=Episode::findOrFail($idepisode);

        return view('partials.doctor.dar_alta',['episode'=>$episode]);
    }

    public function store(Request $request){
        //dd($request->all());

       $episode_id=$request->input('episode_id');
        $mensajes=[
          'epicrisis.required'=>'La epicrisis es requerida'
        ];
        $this->validate($request,[
         'epicrisis'=>'required'
        ],$mensajes);

        $error=null;
        DB::beginTransaction();

        try{
            $epicrisis=new Epicrisis();
            $epicrisis->episode_id=$episode_id;
            //el doctor autenticado generara la epicrisis
            $epicrisis->doctor_id=auth()->user()->doctor->id;
            $epicrisis->fecha_epicrisis=$request->input('fecha_epicrisis');
            $epicrisis->hora_epicrisis=$request->input('hora_epicrisis');
            $epicrisis->diagnostico_egreso=$request->input('diagnostico_egreso');
            $epicrisis->alta_de_internacion=$request->input('alta_internacion');
            $epicrisis->fallecimiento=$request->input('fallecimiento');
            $epicrisis->derivacion_int_nosocomial=$request->input('int_nosocomial');
            $epicrisis->institucion=$request->input('institucion');
            $epicrisis->causa_derivacion=$request->input('causa_derivacion');
            $epicrisis->observaciones=$request->input('observaciones');
            $epicrisis->epicrisis=$request->input('epicrisis');

            $epicrisis->save();

            $episodio=Episode::find($episode_id);
            //marcamos el estado del episodio a epicrisis generada (4)
            $episodio->episode_state_id=4;
            $episodio->save();
            DB::commit();

            return redirect('asignados')->with('clase','success')->with('message','Epicrisis Generada Correctamente');




        }catch(\Exception $e){
            $error=$e->getMessage();

            DB::rollback();
            //print_r($error);
           // die();
            $success=false;
            return redirect('asignados')->with('clase','danger')->with('message','Hubo un error al generar la epicrisis, intente de nuevo');

        }

    }

    public function pdfShow($idepicrisis){
        $epicrisis=Epicrisis::find($idepicrisis);
        $edad = Carbon::parse($epicrisis->episode->patient->fecha_nacimiento)->age;





        $pdf = PDF::loadView('patients.pdf.epicrisis',['epicrisis'=>$epicrisis,'edad'=>$edad]);
        return $pdf->stream();
    }
}
