<?php

namespace App\Http\Controllers;
use App\CitasAsistenteSocial;
use App\Episode;
use App\PsychoSocialIncome;
use App\SocialAssistant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class SocialAssistantController extends Controller
{
    //

    public function diagrama(Request $request){
        $pacientesActivos=Episode::where('episode_state_id','=',2)->get();
        $asistentes_soc=SocialAssistant::all();
        $mes=$request->input('mes');
        $anio=$request->input('anio');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);
        return view('citas.asistente_social.diagrama',['asistentes_soc'=>$asistentes_soc,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio]);
    }







    public function calendario(){
        $events=[];
        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;


        $citasIngresoAsistenteSocial=PsychoSocialIncome::all()->where('social_assistant_id','=',auth()->user()->socialAssistant->id);

        //$citasIngresoAsistenteSocial=DB::table('psycho_social_incomes')->where('social_assistant_id','=',auth()->user()->socialAssistant->id)->whereMonth('fecha','=',$mesActual)->get();

        $visitasParaEvoluciones=CitasAsistenteSocial::join('citas','citas_asistente_socials.id','citas.id')
            ->where('citas_asistente_socials.social_assistant_id','=',auth()->user()->socialAssistant->id)->get();




        foreach($citasIngresoAsistenteSocial as $c){



            $nombre=$c->episode->patient->nombre;
            $nombre.=" ".$c->episode->patient->apellido;
            $fechaCarbon=carbon::createFromFormat('Y-m-d',$c->fecha);
            $mesCita=$fechaCarbon->month;
            //comprobando que solamente el calendario devuelva las citas correspondiente al mes actual
            if($mesCita==$mesActual){
                $events[]=\Calendar::event(
                    $nombre,
                    false,
                    $c->fecha,
                    $c->fecha,
                    // $c->cita->hora,
                    null,

                    ['color'=>'red','url'=>"ingresoasistentesocial/".$c->id]
                );
            }
        }

        foreach($visitasParaEvoluciones as $c){


            $nombre=$c->cita->episode->patient->nombre;
            $nombre.=" ".$c->cita->episode->patient->apellido;
            $fechaCarbon=carbon::createFromFormat('Y-m-d',$c->cita->fecha);
            $mesCita=$fechaCarbon->month;
            //comprobando que solamente el calendario devuelva las citas correspondiente al mes actual
            if($mesCita==$mesActual){
                $events[]=\Calendar::event(
                    $nombre,
                    false,
                    $c->fecha,
                    $c->fecha,
                    // $c->cita->hora,
                    null,

                    ['color'=>'green','url'=>"citasasistesocial/".$c->id]
                );
            }
        }

        $calendar = \Calendar::addEvents($events);
        return view('partials.social_assistant.calendar',compact('calendar'));
    }

    public function listadoAsistentes(){
        $asistentes=SocialAssistant::all();


        //$edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        //$episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('admin.prestadores.asistentes_sociales.pdfAsistentes',['asistentes'=>$asistentes]);
        return $pdf->stream();
    }
}
