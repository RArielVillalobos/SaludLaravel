<?php

namespace App\Http\Middleware;


//use App\CitaMedicalVisit;
use App\MedicalIncome;

use Carbon\Carbon;
use Closure;


class MedicalIncomeExist
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
        //dd($request->id);
        //si el ingreso medico ya fue creado, este middleware lo redireccionara a otra pagina
        $medicalIncome=MedicalIncome::find($request->id);
        //$cita_medical_visit=CitaMedicalVisit::find($request->id);
        $doctor_autenticado=auth()->user()->doctor->id;
        $fechaActual=Carbon::now();
        //dd($fechaActual);
        //dd($doctor_autenticado);
        //dd($cita_medical_visit);
        if($medicalIncome->informeMedico){
            return redirect('/ingresomedico/'.$request->id);
        }
       elseif($medicalIncome->doctor_id!=$doctor_autenticado){

                return redirect('/general');


       }


        return $next($request);
    }
}
