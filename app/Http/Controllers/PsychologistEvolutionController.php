<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PsychologistEvolution;
use App\Cita;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;

class PsychologistEvolutionController extends Controller
{
    //
    public function show(Request $request){
        $cita_id=$request->input('cita_id');
        $nombre_paciente=$request->input('nombre_paciente');
        $apellido_paciente=$request->input('apellido_paciente');
        $fecha_cita=$request->input('fecha_cita');
        return view('citas.psicologia.form_evolution',['cita_id'=>$cita_id,'nombre_paciente'=>$nombre_paciente,'apellido_paciente'=>$apellido_paciente,'fecha_cita'=>$fecha_cita]);
    }

    public function store(Request $request){

        $cita_id=$request->input('cita_id');
        $cita=Cita::findOrFail($cita_id);
        $episode_id=$cita->episode->id;


        $evolucion=$request->input('evolucion');

        $psycho_evolution=new PsychologistEvolution();
        $psycho_evolution->cita_psicologia_id=$cita_id;
        $psycho_evolution->episode_id=$episode_id;

        $psycho_evolution->evolucion=$evolucion;

        $psycho_evolution->save();

        return redirect('/citaspsicologia/'.$cita_id);

    }

    public function pdfEvolucion($idEvo){
        $kineEvolution=PsychologistEvolution::findOrFail($idEvo);

        $edad = Carbon::parse($kineEvolution->episode->patient->fecha_nacimiento)->age;
        $episode=$kineEvolution->episode;
        $pdf = PDF::loadView('patients.pdf.psychologistEvolution',['edad'=>$edad,'psychoEvo'=>$kineEvolution,'episode'=>$episode]);
        return $pdf->stream();





    }
}
