<?php

namespace App\Http\Controllers;

use App\SocialContext;
use Illuminate\Http\Request;

class SocialContextController extends Controller
{
    //

     public function cargarform(Request $request){
         //variables que vienen ocultas
         $idCita=$request->input('cita_id');


         return view('citas.ingreso_asistente_social.form',['idCita'=>$idCita]);

     }

     public function store(Request $request){
         $idIngreso=$request->input('ingreso_psico_id');
         $contextoPsicosocial=new SocialContext();
         $contextoPsicosocial->psycho_social_income_id=$request->input('ingreso_psico_id');
         $contextoPsicosocial->vivienda_adecuada=$request->input('vivienda_adecuada');
         $contextoPsicosocial->cuidadores=$request->input('cuidadores');
         $contextoPsicosocial->cumple_requi_int_domiciliaria=$request->input('requi_int_dom');
         $contextoPsicosocial->informe=$request->input('informe');
         $contextoPsicosocial->save();

         return redirect('ingresoasistentesocial/'.$idIngreso);
     }
}
