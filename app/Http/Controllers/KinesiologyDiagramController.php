<?php

namespace App\Http\Controllers;

use App\KinesiologyDiagram;
use Illuminate\Http\Request;

class KinesiologyDiagramController extends Controller
{
    //

    public function store(Request $request){
        //dd($request->all());
        //echo 'kine';
        //dd($request->all());
        $kinesiologyDiagram=new KinesiologyDiagram();
        $kinesiologyDiagram->episode_id=$request->input('epi');
        $kinesiologyDiagram->kinesiology_shift_id=$request->input('turno_id');
        $kinesiologyDiagram->mes=$request->input('mes');
        $kinesiologyDiagram->anio=$request->input('anio');

        $kinesiologyDiagram->save();
        return back();
    }

    public function delete(Request $request){

        //dd( $request->all());
        $kinesiologyDiagram=KinesiologyDiagram::findOrFail($request->input('kinesiology_digrama_id_eli'));
        $kinesiologyDiagram->delete();

        return back();
    }
}
