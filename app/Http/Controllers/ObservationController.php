<?php

namespace App\Http\Controllers;

use App\Observation;
use App\Episode;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    //

    public function store(Request $request){

        $episode_id=$request->input('episode_id');
        $observacion=$request->input('observacion');
        $observation=new Observation();
        $observation->episode_id=$episode_id;
        $observation->observacion=$observacion;
        $observation->save();

        return back();



    }

    public function observations($idepisodio){
        $observaciones=Observation::where('episode_id','=',$idepisodio)->get();
        $output="";

        //return $episode->observations;
        foreach ($observaciones as $key => $observacion) {
            $output.='<p>'.
                $observacion->created_at->format('d-m-Y')." ; ".
                $observacion->observacion.
               
                '</p>';
        }
        return Response($output);


    }
}
