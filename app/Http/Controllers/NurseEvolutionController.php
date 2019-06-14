<?php

namespace App\Http\Controllers;

use App\Cita;
use App\NurseEvolution;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;



class NurseEvolutionController extends Controller
{
    //

    public function show(Request $request){

        $cita_id=$request->input('cita_id');

        $nombre_paciente=$request->input('nombre_paciente');
        $apellido_paciente=$request->input('apellido_paciente');
        $fecha_cita=$request->input('fecha_cita');
        return view('citas.enfermeria.form_evolution',['cita_id'=>$cita_id,'nombre_paciente'=>$nombre_paciente,'apellido_paciente'=>$apellido_paciente,'fecha_cita'=>$fecha_cita]);

    }

    public function store(Request $request){
       // dd($request);
        $cita_id=$request->input('cita_id');
        $cita=Cita::findOrFail($cita_id);
        $episode_id=$cita->episode->id;

        /*$this->validate($request,[
            'evolucion'=>'required'
        ]);*/


        $ta=$request->input('ta');
        $fr=$request->input('fr');
        $fc=$request->input('fc');
        $temp=$request->input('temp');
        $hgt=$request->input('hgt');
        $spo=$request->input('spo');
        $diuresis=$request->input('diuresis');
        $catarsis=$request->input('catarsis');
        $evolucion=$request->input('evolucion');



        $nurse_evolution=new NurseEvolution();
        $nurse_evolution->cita_enfermeria_id=$cita_id;
        $nurse_evolution->episode_id=$episode_id;

        $nurse_evolution->ta=$ta;
        $nurse_evolution->fr=$fr;
        $nurse_evolution->fc=$fc;
        $nurse_evolution->temp=$temp;
        $nurse_evolution->hgt=$hgt;
        $nurse_evolution->spo=$spo;
        $nurse_evolution->diuresis=$diuresis;
        $nurse_evolution->catarsis=$catarsis;
        $nurse_evolution->evolucion=$evolucion;

        $nurse_evolution->save();

        return redirect('/citasenfermeria/'.$cita_id);



    }

    public function pdfEvolucion($idEvo){
        $nurseEvolution=NurseEvolution::findOrFail($idEvo);

        $edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        $episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('patients.pdf.nurseEvolution',['edad'=>$edad,'nurseEvolution'=>$nurseEvolution,'episode'=>$episode]);
        return $pdf->stream();
    }
}
