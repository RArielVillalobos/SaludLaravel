<?php

namespace App\Http\Controllers;

use App\SocialAssistantDiagram;
use Illuminate\Http\Request;

class SocialAssistantDiagramController extends Controller
{
    //

    public function store(Request $request){

        $socialAssistantDiagram=new SocialAssistantDiagram();
        $socialAssistantDiagram->episode_id=$request->input('epi');
        $socialAssistantDiagram->social_assistant_shift_id=$request->input('social_assistant_shift_id');
        $socialAssistantDiagram->mes=$request->input('mes');
        $socialAssistantDiagram->anio=$request->input('anio');
        $socialAssistantDiagram->save();
        return back();


    }

    public function delete(Request $request){
        $diagramaAsis=SocialAssistantDiagram::findOrFail($request->input('asis_digrama_id_eli'));

        $diagramaAsis->delete();
        return back();

    }
}
