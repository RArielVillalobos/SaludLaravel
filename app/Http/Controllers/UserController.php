<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function habilitar(Request $request){
        //dd($request->all());
        $usuario_id=$request->input('usuario_id');
        $usuario=User::find($usuario_id);
        //habilitamos el usuario
        $usuario->status_id=1;
        $usuario->save();

        return back();

    }
    public function deshabilitar(Request $request){

        $usuario_id=$request->input('usuariodes_id');
        $usuario=User::find($usuario_id);
        //deshabilitamos el usuario
        $usuario->status_id=2;
        $usuario->save();

        return back();

    }

    public function update(Request $request){
        //dd($request->all());
        $usuario=User::find($request->input('usuarioedit_id'));

        if($request->input('pass')!=null){
            $usuario->password=bcrypt($request->input('pass'));
        }
        $usuario->telefono=$request->input('telefono');
        $usuario->domicilio=$request->input('direccion');
        if($usuario->save()){
            return back()->with('clase','success')->with('message','Usuario Correctamente Actualizado');
        }else{
            return back()->with('clase','danger')->with('message','Hubo un Error, Intente de Nuevo');
        }

    }
}
