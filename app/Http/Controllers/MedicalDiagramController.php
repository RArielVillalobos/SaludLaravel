<?php

namespace App\Http\Controllers;

use App\MedicalDiagram;
use Illuminate\Http\Request;

class MedicalDiagramController extends Controller
{
    //
    public function store(Request $request){

        $medicalDiagram=new MedicalDiagram();
        $medicalDiagram->episode_id=$request->input('epi');
        $medicalDiagram->medical_shift_id=$request->input('turno_id');
        $medicalDiagram->mes=$request->input('mes');
        $medicalDiagram->anio=$request->input('anio');

        $medicalDiagram->save();
        return back();
    }

    public function delete(Request $request){
        //dd($request->all());
        $medicalDiagram=MedicalDiagram::findOrFail($request->input('medical_digrama_id_eli'));
        $medicalDiagram->delete();

        return back();

    }
}
