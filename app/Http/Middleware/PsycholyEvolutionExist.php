<?php

namespace App\Http\Middleware;

use App\CitaPsicologia;
use Closure;
use Carbon\Carbon;

class PsycholyEvolutionExist
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
        //dd($request->idCita->id);
        $citaPsicologia=CitaPsicologia::findOrFail($request->idCita->id);

        $psicologo_autenticado=auth()->user()->psychologist->id;

        $carbon=Carbon::now();
        $fechaActual=$carbon->format('Y-m-d');
        //dd($fechaActual);
        //dd($citaEvolutionMedical->doctor->id);
        //dd($citaEvolutionMedical->citaMedica->fecha);



        /*if($citaPsicologia->psychologistEvolution){
           // return redirect('/citaspsicologia/'.$request->idCita->id);
            return 'hola';
        }*/
        //solamente se pueden cargar evoluciones de citas del dia actual o anterior, nunca evoluciones a citas futuras
        if($citaPsicologia->cita->fecha>$fechaActual){
            return redirect('/calendariopsicologia');
        }
        elseif ($citaPsicologia->psychologist->id!=$psicologo_autenticado){
            return redirect('/calendariopsicologia');
        }


        return $next($request);
        //return $next($request);
    }
}
