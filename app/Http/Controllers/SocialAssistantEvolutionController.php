<?php

namespace App\Http\Controllers;
use App\Cita;
use App\SocialAssistantEvolution;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class SocialAssistantEvolutionController extends Controller
{
    //

    public function show(Request $request){

        $cita_id=$request->input('cita_id');
        $nombre_paciente=$request->input('nombre_paciente');
        $apellido_paciente=$request->input('apellido_paciente');
        $fecha_cita=$request->input('fecha_cita');
        return view('citas.asistente_social.form_evolution',['cita_id'=>$cita_id,'nombre_paciente'=>$nombre_paciente,'apellido_paciente'=>$apellido_paciente,'fecha_cita'=>$fecha_cita]);
    }

    public function store(Request $request){

        $cita_id=$request->input('cita_id');
        $cita=Cita::findOrFail($cita_id);
        $episode_id=$cita->episode->id;


        /*$ta=$request->input('ta');
        $fr=$request->input('fr');
        $fc=$request->input('fc');
        $temp=$request->input('temp');
        $hgt=$request->input('hgt');
        $spo=$request->input('spo');
        $diuresis=$request->input('diuresis');
        $catarsis=$request->input('catarsis');*/
        $evolucion=$request->input('evolucion');

        $asis_evolution=new SocialAssistantEvolution();
        $asis_evolution->cita_asis_social_id=$cita_id;
        $asis_evolution->episode_id=$episode_id;

        $asis_evolution->evolucion=$evolucion;

        $asis_evolution->save();

        return redirect('/citasasistesocial/'.$cita_id);

    }

    public function pdfEvolucion($idEvo){
        $asisEvolution=SocialAssistantEvolution::findOrFail($idEvo);

        $edad = Carbon::parse($asisEvolution->episode->patient->fecha_nacimiento)->age;
        $episode=$asisEvolution->episode;
        $pdf = PDF::loadView('patients.pdf.socialAssistantEvolution',['edad'=>$edad,'asisEvolution'=>$asisEvolution,'episode'=>$episode]);
        return $pdf->stream();


    }
}
