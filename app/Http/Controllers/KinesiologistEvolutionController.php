<?php

namespace App\Http\Controllers;

use App\KinesiologistEvolution;
use Illuminate\Http\Request;
use App\Cita;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;

class KinesiologistEvolutionController extends Controller
{
    //

    public function show(Request $request){
        $cita_id=$request->input('cita_id');
        $nombre_paciente=$request->input('nombre_paciente');
        $apellido_paciente=$request->input('apellido_paciente');
        $fecha_cita=$request->input('fecha_cita');
        return view('citas.kinesiologia.form_evolution',['cita_id'=>$cita_id,'nombre_paciente'=>$nombre_paciente,'apellido_paciente'=>$apellido_paciente,'fecha_cita'=>$fecha_cita]);
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

        $kine_evolution=new KinesiologistEvolution();
        $kine_evolution->cita_kinesiologia_id=$cita_id;
        $kine_evolution->episode_id=$episode_id;

        $kine_evolution->evolucion=$evolucion;

        $kine_evolution->save();

        return redirect('/citaskinesiologia/'.$cita_id);

    }

    public function pdfEvolucion($idEvo){
        $kineEvolution=KinesiologistEvolution::findOrFail($idEvo);

        $edad = Carbon::parse($kineEvolution->episode->patient->fecha_nacimiento)->age;
        $episode=$kineEvolution->episode;
        $pdf = PDF::loadView('patients.pdf.kineEvolution',['edad'=>$edad,'kineEvolution'=>$kineEvolution,'episode'=>$episode]);
        return $pdf->stream();





    }
}
