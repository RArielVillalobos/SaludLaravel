<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //

    public function store(Request $request){


        $medicine=new Medicine();
        $medicine->nombre=$request->input('nombre');
        if($medicine->save()){
            return back()->with('message','Agregado Correctamente')->with('clase','success');
        }else{
            return back()->with('message','Hubo un error intente de nuevo')->with('clase','danger');
        }


    }

    public function contenido($id){


        $medicine=Medicine::find($id);

        return view ('partials.coordinator.medicacion.contenido',['medicine'=>$medicine]);
    }

    public function edit(Request $request){
        $id=$request->input('medicine');
        $nombre=$request->input('nombre');

        $medicine=Medicine::find($id);
        $medicine->nombre=$nombre;
        if($medicine->update()){
            return back()->with('message','Actualizado Correctamente')->with('clase','success');
        }else{
            return back()->with('message','Hubo un error intente de nuevo')->with('clase','danger');
        }


    }
}
