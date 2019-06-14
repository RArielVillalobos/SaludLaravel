<?php

namespace App\Http\Middleware;

use App\CitaEvolutionMedical;
use Carbon\Carbon;
use Closure;

class MedicalEvolutionExist
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


        $citaEvolutionMedical=CitaEvolutionMedical::findOrFail($request->cita->id);
        $doctor_autenticado=auth()->user()->doctor->id;
        $carbon=Carbon::now();
        $fechaActual=$carbon->format('Y-m-d');
        //dd($fechaActual);
        //dd($citaEvolutionMedical->doctor->id);
        //dd($citaEvolutionMedical->citaMedica->fecha);



        if($citaEvolutionMedical->medicalEvolution ){
            return redirect('/citas/'.$request->cita->id);
        }
        //solamente se pueden cargar evoluciones de citas del dia actual o anterior, nunca evoluciones a citas futuras
        elseif($citaEvolutionMedical->citaMedica->fecha>$fechaActual){
            return redirect('/cronogramamedico');
        }
        elseif ($citaEvolutionMedical->doctor->id!=$doctor_autenticado){
            return redirect('/cronogramamedico');
        }


        return $next($request);

    }
}
