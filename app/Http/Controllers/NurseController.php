<?php

namespace App\Http\Controllers;

use App\Cita;
use App\CitaEnfermeria;
use App\Episode;
use App\NursingDiagram;
use App\NursingShift;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Nurse;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class NurseController extends Controller
{
    //
    public function cronograma(){
        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;
        $events=[];

        //$citasEnfermeria=CitaEnfermeria::all()->where('nurse_id','=',auth()->user()->nurse->id);
        $citasEnfermeria=CitaEnfermeria::join('citas','citas_enfermeria.id','citas.id')
            ->where('citas_enfermeria.nurse_id','=',auth()->user()->nurse->id)
            ->whereMonth('citas.fecha','=',$mesActual)->get();


        foreach($citasEnfermeria as $c){

            $nombre=$c->cita->episode->patient->nombre;
            $nombre.=" ".$c->cita->episode->patient->apellido;



            $events[]=\Calendar::event(
                $nombre,
                false,
                $c->cita->fecha,
                $c->cita->fecha,
                null,

                ['url'=>"citasenfermeria/".$c->id]
            );


        }
        $calendar = \Calendar::addEvents($events);
        return view('partials.nurse.calendar',compact('calendar'));
    }

    public function diagramaEnf(Request $request){

        $pacientesActivos=Episode::where('estado','=',1)->get();
        $enfermeros=Nurse::all()->where('activo','=',1);
        $mes=$request->input('mes');
        $anio=$request->input('anio');
        $turno=$request->input('turno');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);




        /*$citasEnfEnMesDado=CitaEnfermeria::join("citas","citas_enfermeria.id","=","citas.id")
            ->join('episodes','citas.episode_id','=','episodes.id')
            ->select('citas_enfermeria.id','citas_enfermeria.nurse_id')
            ->where('episodes.id','=',$idEpi)
            ->whereMonth('citas.fecha','=',$mes)->get();*/

        return view('citas.enfermeria.diagrama',['enf'=>$enfermeros,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio,'turno'=>$turno]);

    }

    public function diagramaEnfPrueba(Request $request){
        $pacientesActivos=Episode::where('episode_state_id','=',2)->get();
        $enfermeros=Nurse::all();
        $mes=$request->input('mes');
        $anio=$request->input('anio');
        $turno=$request->input('turno');

        $idEpi=$request->input('episodio');

        $episodio=Episode::find($idEpi);




        /*$citasEnfEnMesDado=CitaEnfermeria::join("citas","citas_enfermeria.id","=","citas.id")
            ->join('episodes','citas.episode_id','=','episodes.id')
            ->select('citas_enfermeria.id','citas_enfermeria.nurse_id')
            ->where('episodes.id','=',$idEpi)
            ->whereMonth('citas.fecha','=',$mes)->get();*/

        return view('citas.enfermeria.diagrama',['enf'=>$enfermeros,'episodiosActivos'=>$pacientesActivos,'mes'=>$mes,'anio'=>$anio,'epi'=>$episodio,'turno'=>$turno]);
    }
    public function citasMasiva(Request $request){
        $turno=$request->input('turno');


        $fecha_desde=$request->input('fecha_desde');

        $fecha_hasta=Carbon::parse($request->input('fecha_hasta'));

        //rango fecha
        $period = CarbonPeriod::create($fecha_desde,$fecha_hasta );
        foreach ($period as $date) {
            $fecha=$date->format('Y-m-d');
            $cita=new Cita();
            $cita->episode_id=$request->input('episode_id');

            $cita->fecha=$fecha;
            $cita->save();
            $citaEnfermeria=new CitaEnfermeria();
            $citaEnfermeria->id=$cita->id;
            $citaEnfermeria->nurse_id=$request->input('id_enf');
            $citaEnfermeria->turno=$turno;
            $citaEnfermeria->save();

        }


        //
        /*$mes=$fecha_hasta->month;
        $mes='0'.$mes;

        $anio=$fecha_hasta->year;


        $diferencia=$fecha_hasta->diffInDays($fecha_desde);
        $diferencia++;
        $turno=$request->input('turno');*/



        return back();

    }

    public function diagramadorEnf(Request $request){
        $fecha_desde=$request->input('fecha_desde');

        $fecha_hasta=Carbon::parse($request->input('fecha_hasta'));
        $period = CarbonPeriod::create($fecha_desde,$fecha_hasta );
        foreach ($period as $date) {
            $fecha=$date->format('Y-m-d');
            $encontrado=buscacitaEnfermeria($request->input('nursing_diagram_id'),$fecha);

            //si no se encontro una cita ya en la misma fecha y en el mismo diagrama(turno y mes) se guarda la cita
           if($encontrado==false){
               $error = null;
               DB::beginTransaction();
               try{

                   $cita=new Cita();
                   $cita->episode_id=$request->input('episode_id');

                   $cita->fecha=$fecha;
                   $cita->save();
                   $citaEnfermeria=new CitaEnfermeria();
                   $citaEnfermeria->id=$cita->id;
                   $citaEnfermeria->nurse_id=$request->input('id_enf');
                   $citaEnfermeria->nursing_diagram_id=$request->input('nursing_diagram_id');
                   $citaEnfermeria->save();
                   DB::commit();
                   $success=true;

               }catch (\Exception $e){
                   $success = false;
                   $error = $e->getMessage();
                   DB::rollback();
               }



           }
           //die();




        }

        return back();


    }

    public function agregarturnoEpi(Request $request){

        $nursing_diagram=new NursingDiagram();
        $nursing_diagram->episode_id=$request->input('episode_id');
        $nursing_diagram->nursing_shift_id=$request->input('turno_id');
        $nursing_diagram->mes=$request->input('mes');
        $nursing_diagram->anio=$request->input('anio');
        $nursing_diagram->save();

        return back();
    }

    public function agregarturnomanianaEpi(Request $request){

        //como el turno mañana es el id 1 , lo seteamos desde aca

        $nursing_shift=1;
        $nursing_diagram=new NursingDiagram();
        $nursing_diagram->episode_id=$request->input('episode_id');
        $nursing_diagram->nursing_shift_id=$nursing_shift;
        $nursing_diagram->mes=$request->input('mes');
        $nursing_diagram->anio=$request->input('anio');
        $nursing_diagram->save();

        return back();
    }

    public function agregarturnotardeEpi(Request $request){
        $nursing_shift=2;
        $nursing_diagram=new NursingDiagram();
        $nursing_diagram->episode_id=$request->input('episode_id');
        $nursing_diagram->nursing_shift_id=$nursing_shift;
        $nursing_diagram->mes=$request->input('mes');
        $nursing_diagram->anio=$request->input('anio');
        $nursing_diagram->save();

        return back();

    }

    public function editarCitaEnf(Request $request){
        //dd($request->all());
        $cita=Cita::findOrFail($request->input('cita_id'));
        if(!$request->input('hora')==null){
            $cita->hora=$request->input('hora');
            $cita->save();
        }

        $citaEnfermeria=CitaEnfermeria::findOrFail($request->input('cita_id'));
        $citaEnfermeria->nurse_id=$request->input('nurse_id');
        $citaEnfermeria->save();

        return back();


    }

    public function agregarCitaUnitaria(Request $request){
       // dd($request->all());

        $dia=$request->input('dia');
        $anio=$request->input('anio');
        $mes=$request->input('mes');
        $nursing_diagram=$request->input('nursing_diagram_id');
        $episode_id=$request->input('episode');
        $nurse_id=$request->input('nurse_id');


        $fecha=$anio.'-'.$mes.'-'.$dia;


        $error = null;
        DB::beginTransaction();
        try{

            $cita=new Cita();
            $cita->episode_id=$episode_id;
            $cita->fecha=$fecha;
            if($request->input('hora')!=null){
                $cita->hora=$request->input('hora');
            }else{
                $cita->hora=null;
            }
            $cita->save();



            $citaEnfermeria=new CitaEnfermeria();
            $citaEnfermeria->id=$cita->id;
            $citaEnfermeria->nurse_id=$nurse_id;
            $citaEnfermeria->nursing_diagram_id=$nursing_diagram;

            $citaEnfermeria->save();


            DB::commit();
            $success=true;




        }catch (\Exception $e){
            $success=false;
            $error=$e->getMessage();
            DB::rollback();



        }


        return back();


    }


    public function listadoEnfermeros(){

        //$enf=[];
        $enfermeros=Nurse::all();


        //$edad = Carbon::parse($nurseEvolution->episode->patient->fecha_nacimiento)->age;
        //$episode=$nurseEvolution->episode;
        $pdf = PDF::loadView('admin.prestadores.enfermeros.pdfNurse',['enfermeros'=>$enfermeros]);
        return $pdf->stream();

    }
}
