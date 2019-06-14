<?php

namespace App\Http\Controllers;


use App\CitaEvolutionMedical;
//use App\CitaMedicalVisit;
use App\Doctor;
use App\Episode;

use App\Extension;
use App\MedicalIncome;
use App\Patients;
use App\Tratamient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Calendar;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;

class DoctorController extends Controller
{
    //

    public function asignados(){

        $episode=Episode::all()->where('doctor_id','=',auth()->user()->doctor->id)->where('episode_state_id','=',2);

        return view('partials.doctor.asignados',compact('episode'));

    }



    public function cronograma(){
        //borramos las variables de session para que no
        //ingreso
        Session::forget('medi');
        Session::forget('indicacion');
        //evo
        Session::forget('cartMedi');
        Session::forget('indiEvo');

        //prorroga
        Session::forget('cartMediProrroga');
        Session::forget('indiProrroga');


       $events=[];



        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;
        $citasMedicasEvo=CitaEvolutionMedical::join('cita_medicas','cita_evolution_medicals.id','cita_medicas.id')
            ->where('cita_evolution_medicals.doctor_id','=',auth()->user()->doctor->id)
            ->whereMonth('cita_medicas.fecha','=',$mesActual)->get();


       /* $citas_visitas_medicas=CitaMedicalVisit::join('cita_medicas','cita_medical_visits.id','cita_medicas.id')
            ->where('cita_medical_visits.doctor_id','=',auth()->user()->doctor->id)->get();*/


         ///filtrado por fecha
        //$visitasIngresoMedico=MedicalIncome::whereMonth('fecha','=',$mesActual)->where('doctor_id','=',auth()->user()->doctor->id)->get();

        $visitasIngresoMedico=MedicalIncome::where('doctor_id','=',auth()->user()->doctor->id)->get();



        $prorrogasAsignadas=Extension::whereMonth('fecha_prorroga','=',$mesActual)->where('doctor_id','=',auth()->user()->doctor->id)->get();
        //$prorrogasAsignadas=Extension::all()->where('doctor_id','=',auth()->user()->doctor->id)::whereMonth('fecha_prorroga','=',$mesActual);



        //estas citas corresponden a episodios activos(son para evoluciones medicas)
        foreach($citasMedicasEvo as $c){


            $events[]=\Calendar::event(
               $c->citaMedica->episode->patient->apellido." ".$c->citaMedica->episode->patient->nombre,

               false,
               $c->citaMedica->fecha,
               $c->citaMedica->fecha,
               null,
               ['color'=>'green','url'=>"citas/".$c->id]
            );

        }
        foreach($prorrogasAsignadas as $prorroga){
            $events[]=\Calendar::event(
                $prorroga->medicalIncome->informeMedico->episode->patient->apellido." ".$prorroga->medicalIncome->informeMedico->episode->patient->nombre,
                false,
                $prorroga->fecha_prorroga,
                $prorroga->fecha_prorroga,
                null,
                ['color'=>'red','url'=>"prorroga/".$prorroga->id]

            );

        }


        //estas citas corresponden a episodios provisorios(son para hacer el informe medico)
        foreach($visitasIngresoMedico as $visita_medica){
                //$fecha=$visita_medica->citaMedica->fecha;
                //carbon=Carbon::createFromFormat('Y-m-d',$fecha);
                //$mesDeLaVisita=$carbon->month;

                    $events[]=\Calendar::event(
                        $visita_medica->episode->patient->apellido." ".$visita_medica->episode->patient->nombre,
                        false,
                        $visita_medica->fecha,
                        $visita_medica->fecha,
                        null,
                        ['color'=>'blue','url'=>"ingresomedico/".$visita_medica->id]
                    );



        }


        $calendar = \Calendar::addEvents($events);


        return view('partials.doctor.calendar',compact('calendar'));
    }

    public function cargarTratamiento(){

        return view('partials.doctor.carga_tratamientos_form');
    }

    public function postcargarTratamiento(Request $request){
        //dd($request->all());
        $servername ="localhost";
        $username = "root";
        $password = "";
        $dbname = "alegra";

        $id=$request->input('id');
        $nombre_tratamiento=$request->input('nombre_tratamiento');

        $arregloColumnas=$request->input('input_dinamico');
        $total_columnas=count($request->input('input_dinamico'));



        //dd($severidad);


        $conn = new \mysqli($servername, $username, $password, $dbname);

        if($conn){
            $tratamiento=new Tratamient();
            $tratamiento->nombre_tratamiento=$nombre_tratamiento;
            $tratamiento->save();
            dd($tratamiento->id);

            $sql="CREATE TABLE {$nombre_tratamiento}(
                id INT(11) PRIMARY KEY AUTO_INCREMENT,
                tratamiento_id INT NOT NULL
                 ";


            foreach($arregloColumnas as $valor){
                $sql.=",{$valor} VARCHAR(24) NOT NULL ";

            }

            $sql.=")";


            if($conn->query($sql)){
                echo 'correcto' ;
            }else{
                echo 'incorrecto'.$conn->error;
            }


        }

    }

    public function cargarmedicacion(){
        return view('partials.doctor.carga_medicacion_form');



    }

    public function diagramaMed(Request $request){
        $pacientesActivos=Episode::where('episode_state_id','=',2)->get();
        $doctores=Doctor::all();
        $mes=$request->input('mes');
        $anio=$request->input('anio');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);
        return view('citas.medicas.diagrama',['medicos'=>$doctores,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio]);
    }


    public function listadoDoctores(){
        $doctores=Doctor::all();


        //$edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        //$episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('admin.prestadores.doctores.pdfDoctor',['doctores'=>$doctores]);
        return $pdf->stream();
    }
}
