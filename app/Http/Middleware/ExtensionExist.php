<?php

namespace App\Http\Middleware;

use App\Extension;
use Carbon\Carbon;
use Closure;

class ExtensionExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //idprorroga
       // dd($request->prorroga->id);
        $extension=Extension::find($request->prorroga->id);
       // dd($extension->medicalReport);
        //dd($extension);
        //$cita_medical_visit=CitaMedicalVisit::find($request->id);
        $doctor_autenticado=auth()->user()->doctor->id;
        $fechaActual=Carbon::now();
        //dd($fechaActual);
        //dd($doctor_autenticado);
        //dd($cita_medical_visit);
        if($extension->medicalReport){
            return redirect('/prorroga/'.$request->prorroga->id);
        }
        elseif($extension->doctor_id!=$doctor_autenticado){

            return redirect('/general');


        }
        return $next($request);
    }
}
