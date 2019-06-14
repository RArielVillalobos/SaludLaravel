<?php

namespace App\Http\Middleware;

use App\CitasAsistenteSocial;
use Closure;
use Carbon\Carbon;

class SocialAssistantEvolutionExist
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


        $citaAsis=CitasAsistenteSocial::findOrFail($request->idCita);


        $asistente_autenticado=auth()->user()->socialAssistant->id;

        $carbon=Carbon::now();
        $fechaActual=$carbon->format('Y-m-d');

        //solamente se pueden cargar evoluciones de citas del dia actual o anterior, nunca evoluciones a citas futuras
        if($citaAsis->cita->fecha>$fechaActual){
            return redirect('/calendarioasistentesocial');
        }
        elseif ($citaAsis->asis_social->id!=$asistente_autenticado){
            return redirect('/calendarioasistentesocial');
        }


        return $next($request);
        //return $next($request);
    }
}
