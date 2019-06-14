<?php

namespace App\Http\Controllers;


use App\CitaEvolutionMedical;
use App\CitaMedica;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    //


    public function cargar (CitaEvolutionMedical $cita){
          //dd($cita->episode);




        return view('citas.show',compact('cita'));
    }
}
