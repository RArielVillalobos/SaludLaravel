<?php

namespace App\Http\Controllers;

use App\SocialWork;
use Illuminate\Http\Request;

class SocialWorkController extends Controller
{
    //

    public function form(){

        $obrasSocial=SocialWork::paginate(10);

        return view('partials.admin.obra_social.form',['obras'=>$obrasSocial]);

    }

    public function store(Request $request){

        $mensajes=[
            'nombre.required'=>'El nombre social de la obra es requerido'
        ];
        $this->validate($request,[
            'nombre'=>'required'
        ],$mensajes);

        $obraSocial=new SocialWork();
        $obraSocial->nombre=$request->input('nombre');
        $obraSocial->telefono=$request->input('telefono');
        $obraSocial->direccion=$request->input('direccion');
        $obraSocial->email=$request->input('email');
        $obraSocial->save();

        return back();

    }
}
