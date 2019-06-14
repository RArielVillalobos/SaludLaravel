<?php

namespace App\Http\Middleware;

use App\CitasKinesiologia;
use Carbon\Carbon;
use Closure;

class KinesiologyEvolutionExist
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
        $citaKine=CitasKinesiologia::findOrFail($request->idCita->id);

        $kinesiologo_autenticado=auth()->user()->kinesiologist->id;

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
        if($citaKine->cita->fecha>$fechaActual){
            return redirect('/calendariokinesiologia');
        }
        elseif ($citaKine->kinesiologist->id!=$kinesiologo_autenticado){
            return redirect('/calendariokinesiologia');
        }


        return $next($request);
        //return $next($request);
    }
}
