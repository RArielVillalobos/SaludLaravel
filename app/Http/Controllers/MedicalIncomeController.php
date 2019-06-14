<?php

namespace App\Http\Controllers;

use App\Cita;
use App\CitaMedica;
use App\MedicalIncome;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalIncomeController extends Controller
{
    // para editar el doctor y fecha de la visita medica
    public function ingresosMedicos(){

        $visitasMedicas=MedicalIncome::orderBy('id','desc')->paginate(10);
        $medicos=Doctor::all();



        return view('partials.admin.ingresosMedicos',['visitas_medicas'=>$visitasMedicas,'medicos'=>$medicos]);
    }


    public function update(Request $request){
        $cita_id=$request->input('cita_id');
        $error=null;

        try{
            $cita=CitaMedica::find($cita_id);
            $cita->fecha=$request->input('fecha_visita');
            if($request->input('hora_visita')!=null){
                $cita->hora=$request->input('hora_visita');
            }else{
                $cita->hora=null;
            }
            $cita->save();

            $visitaMedica=CitaMedicalVisit::find($cita_id);
            $visitaMedica->doctor_id=$request->input('doctor_id');

            $visitaMedica->save();
            DB::commit();
            return back()->with('clase','success')->with('message','Visita Médica Actualizada correctamente');
        }catch (\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
            $success=false;
            //dd($error);
            return back()->with('clase','danger')->with('message','Hubo un error intente nuevamente');
        }




    }
}
