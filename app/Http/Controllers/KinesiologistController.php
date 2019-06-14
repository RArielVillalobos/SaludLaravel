<?php

namespace App\Http\Controllers;

use App\CitasKinesiologia;
use App\Episode;
use App\Kinesiologist;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class KinesiologistController extends Controller
{
    //

    public function calendario(){

        $events=[];
        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;



        //$citasKinesiologia=CitasKinesiologia::all()->where('kinesiologist_id','=',auth()->user()->kinesiologist->id);
        //solo mostramos las citas del mes actual
        $citasKinesiologia=CitasKinesiologia::join('citas','citas_kinesiologias.id','citas.id')
            ->where('citas_kinesiologias.kinesiologist_id','=',auth()->user()->kinesiologist->id)
            ->whereMonth('citas.fecha','=',$mesActual)->get();


        foreach($citasKinesiologia as $c){

            $nombre=$c->cita->episode->patient->nombre;
            $nombre.=" ".$c->cita->episode->patient->apellido;



            $events[]=\Calendar::event(
                $nombre,
                false,
                $c->cita->fecha,
                $c->cita->fecha,
               // $c->cita->hora,
                null,

                ['url'=>"citaskinesiologia/".$c->id]
            );


        }
        $calendar = \Calendar::addEvents($events);
        return view('partials.kinesiologist.calendar',compact('calendar'));
    }

    public function cargarCita (CitasKinesiologia $idCita){

        $cita_kinesiologia=CitasKinesiologia::findOrFail($idCita)->last();

        return view('citas.kinesiologia.kinesiologia',compact('cita_kinesiologia'));
    }

    public function diagramaKine(Request $request){
        $pacientesActivos=Episode::where('episode_state_id','=',2)->get();
        $kinesiologos=Kinesiologist::all();
        $mes=$request->input('mes');
        $anio=$request->input('anio');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);
        return view('citas.kinesiologia.diagrama',['kinesiologos'=>$kinesiologos,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio]);
    }


    public function listadoKine(){
        $kines=Kinesiologist::all();


        //$edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        //$episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('admin.prestadores.kinesiologos.pdfKine',['kines'=>$kines]);
        return $pdf->stream();
    }
}
