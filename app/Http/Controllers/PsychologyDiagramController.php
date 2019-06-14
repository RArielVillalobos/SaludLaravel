<?php

namespace App\Http\Controllers;

use App\PsychologyDiagram;
use Illuminate\Http\Request;

class PsychologyDiagramController extends Controller
{
    //

    public function store(Request $request){
        //dd($request->all());
        $psychologyDiagram=new PsychologyDiagram();
        $psychologyDiagram->episode_id=$request->input('epi');
        $psychologyDiagram->psychology_shift_id=$request->input('turno_id');
        $psychologyDiagram->mes=$request->input('mes');
        $psychologyDiagram->anio=$request->input('anio');

        $psychologyDiagram->save();
        return back();
    }

    public function delete(Request $request){
        //dd($request->all());

        $psychologyDiagram=PsychologyDiagram::findOrFail($request->input('psychology_digrama_id_eli'));
        $psychologyDiagram->delete();

        return back();

    }
}
