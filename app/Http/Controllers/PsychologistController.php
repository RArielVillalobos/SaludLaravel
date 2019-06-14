<?php

namespace App\Http\Controllers;

use App\CitaPsicologia;
use App\Kinesiologist;
use App\Psychologist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Episode;
use Barryvdh\DomPDF\Facade as PDF;

class PsychologistController extends Controller
{
    //
    public function calendario(){

        $events=[];
        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;
        $citasPsicologia=CitaPsicologia::join('citas','citas_psicologia.id','citas.id')
            ->where('citas_psicologia.psychologist_id','=',auth()->user()->psychologist->id)->get();
           // ->whereMonth('citas.fecha','=',$mesActual)->get();

        //$citasPsicologia=CitaPsicologia::all()->where('psychologist_id','=',auth()->user()->psychologist->id);


        foreach($citasPsicologia as $c){

            $nombre=$c->cita->episode->patient->nombre;
            $nombre.=" ".$c->cita->episode->patient->apellido;



            $events[]=\Calendar::event(
                $nombre,
                false,
                $c->cita->fecha,
                $c->cita->fecha,
                // $c->cita->hora,
                null,

                ['url'=>"citaspsicologia/".$c->id]
            );


        }
        $calendar = \Calendar::addEvents($events);
        return view('partials.psicologist.calendar',compact('calendar'));
    }

    public function cargarCita(CitaPsicologia $idCita){


        $cita_psico=CitaPsicologia::findOrFail($idCita)->last();

        return view('citas.psicologia.psicologia',compact('cita_psico'));
    }


    public function diagrama(Request $request){
        $pacientesActivos=Episode::where('episode_state_id','=',2)->get();
        $psicologos=Psychologist::all();
        $mes=$request->input('mes');
        $anio=$request->input('anio');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);
        return view('citas.psicologia.diagrama',['psicologos'=>$psicologos,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio]);
    }

    public function listadoPsi(){
        $psicologos=Psychologist::all();


        //$edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        //$episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('admin.prestadores.psicologos.pdfPsychology',['psicologos'=>$psicologos]);
        return $pdf->stream();
    }
}
