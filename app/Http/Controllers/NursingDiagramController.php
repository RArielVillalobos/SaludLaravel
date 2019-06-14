<?php

namespace App\Http\Controllers;

use App\NursingDiagram;
use Illuminate\Http\Request;

class NursingDiagramController extends Controller
{
    //

    public function delete(Request $request){


        $nursingDiagram=NursingDiagram::findOrFail($request->input('nursing_digrama_id_eli'));
        $nursingDiagram->delete();

        return back();

    }
}
