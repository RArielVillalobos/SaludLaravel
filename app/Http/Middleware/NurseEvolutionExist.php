<?php

namespace App\Http\Middleware;

use App\CitaEnfermeria;
use Carbon\Carbon;
use Closure;

class NurseEvolutionExist
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
        $citaEnf=CitaEnfermeria::findOrFail($request->id->id);
       // dd($citaEnf);

        $enf_autenticado=auth()->user()->nurse->id;

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
        if($citaEnf->cita->fecha>$fechaActual){
            return redirect('/cronogramaenfermeria');
        }
        elseif ($citaEnf->nurse->id!=$enf_autenticado){
            return redirect('/cronogramaenfermeria');
        }


        return $next($request);
        //return $next($request);
    }
}
