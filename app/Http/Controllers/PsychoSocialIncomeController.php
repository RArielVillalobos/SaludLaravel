<?php

namespace App\Http\Controllers;

use App\PsychoSocialIncome;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PsychoSocialIncomeController extends Controller
{
    //

    public function cargar($id){


        $ingreso_psicosocial=PsychoSocialIncome::findOrFail($id);



        return view('citas.ingreso_asistente_social.asistente_social',compact('ingreso_psicosocial'));
    }

    public function pdfIngreso($idingreso){

        $psychoIncome=PsychoSocialIncome::findOrFail($idingreso);
        $edad = Carbon::parse($psychoIncome->episode->patient->fecha_nacimiento)->age;
        $pdf = PDF::loadView('patients.socialAssistantIncome',['psychoIncome'=>$psychoIncome,'edad'=>$edad]);
        return $pdf->stream();




    }
}
