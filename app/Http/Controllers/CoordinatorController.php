<?php

namespace App\Http\Controllers;

use App\Episode;
use App\MedicalEvolution;
use App\Medicine;
use App\NurseEvolution;
use App\Patients;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoordinatorController extends Controller
{
    //

    public function indicaciones(){

        $ultimasRecetas=Recipe::orderBy('id','desc')->take(20)->get();
        return view('partials.coordinator.indicaciones',['ultimasRecetas'=>$ultimasRecetas]);
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('patients')
                ->where('apellido', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                <li><a href="#">'.$row->nombre.' '.$row->apellido. '</a></li>
                    ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function autocomplete(Request $request){
        $term=$request->term;
        /*$data=DB::table('patients')
            ->where('apellido', 'LIKE', "%{$term}%")
            ->take(10)
            ->get();*/
        $data=Episode::join('patients','patients.id','episodes.patient_id')
            ->where('apellido', 'LIKE', "%{$term}%")
            ->where('episodes.episode_state_id','=',2)
            ->select('episodes.id','patients.apellido','patients.nombre')
            ->take(10)
            ->get();

        //return response()->json($data);



        $result=[];
        foreach ($data as $key=>$value){

            $result[]=['id'=>$value->id,'value'=>$value->apellido.' '.$value->nombre];
        }

        return response()->json($result);
    }

    public function buscaMedicacion(Request $request){
        //dd($request->all());
        $idPaciente=$request->input('id');
        $searchName=$request->input('searchname');

        //cuando no completa el texto de automcplete buscara las recetas de episodios activos
        if($idPaciente=='' or $searchName==null){
            $episodiosActivos=Episode::where('episode_state_id','=',2)->get();

            //ultimas 20 recetas Episodios Activos
           /* $medicalIncome=MedicalIncome::join("medical_reports","medical_incomes.medical_report_id","=","medical_reports.id")
                ->join('episodes','medical_reports.episode_id','=','episodes.id')
                ->where('episodes.id','=',$idepisodio)->get()->first();*/

           /* $recetas=Recipe::orderBy('episodes.id','desc')->join('episodes','recipes.episode_id','=','episodes.id')
                ->select('recipes.id')

                ->where('episode_state_id','=',2)
                ->where('recipes.created_at','=','(select Max(recipes.created_at) from recipes where recipes.id = episodes.id)')
                //->where('recipes.id','=',DB::raw('max(recipes.created_at)'))
                ->groupBy('episodes.id')
                ->get();

            dd($recetas);*/


            return view('partials.coordinator.indicaciones',['generalEpisodiosActivos'=>$episodiosActivos]);
        }

        $paciente=Patients::find($idPaciente);


        $ultimoIdEpisodioPaciente=$paciente->episodes->last()->id;


        $ultimaRecetaPaciente=Recipe::where('episode_id','=',$ultimoIdEpisodioPaciente)->get()->last();
        $nombrePaciente=$paciente->apellido.' '.$paciente->nombre;
        return view('partials.coordinator.indicaciones',['ultimaRecetaPaciente'=>$ultimaRecetaPaciente,'nombre'=>$nombrePaciente,'idpaciente'=>$ultimoIdEpisodioPaciente]);


    }

    public function evoluciones(){
        return view('partials.coordinator.evoluciones.general');
    }

    public function evolucionesSearch(Request $request){

        $tipoEvo=$request->input('tipo_evolucion');
        $idEpisodio=$request->input('id');
        $episodio=Episode::find($idEpisodio);
        $paciente=$episodio->patient;
        $nombrePaciente=$paciente->apellido.' '.$paciente->nombre;

        //para cuando seleccione una fecha en especifico
        $fecha=$request->input('fecha');
        //para cuando seleccione una fecha u año
        $mesAnio=$request->input('mes');



        if($tipoEvo==1){
            //busqueda
            if(isset($fecha)){

                $evolucionesMedicas=MedicalEvolution::where('episode_id','=',$idEpisodio)
                    ->where('medical_evolutions.fecha','=',$fecha)
                    ->get()
                ;
                return view('partials.coordinator.evoluciones.general',['evolucionesMedicas'=>$evolucionesMedicas,'nombre'=>$nombrePaciente,'fecha'=>$fecha,'idEpi'=>$idEpisodio,'mesAnio'=>$mesAnio,'tipoEvo'=>$tipoEvo]);
            }else{

                // como mes año el valor es 2018-11, tenemos que extraer el mes con la funcion substr
                $mesSeteado=substr($mesAnio,5);
                $anioSeteado=strtok($mesAnio,'-');

                $evolucionesMedicas=MedicalEvolution::where('episode_id','=',$idEpisodio)
                    ->whereMonth('medical_evolutions.fecha','=',$mesSeteado)
                    ->whereYear('medical_evolutions.fecha','=',$anioSeteado)
                    ->get();

                return view('partials.coordinator.evoluciones.general',['evolucionesMedicas'=>$evolucionesMedicas,'nombre'=>$nombrePaciente,'idEpi'=>$idEpisodio,'mesAnio'=>$mesAnio,'fecha'=>$fecha,'tipoEvo'=>$tipoEvo]);



            }


        }else{
            if(isset($fecha)){
                $evolucioesEnfermeria=NurseEvolution::join('citas_enfermeria','nurse_evolutions.cita_enfermeria_id','citas_enfermeria.id')
                    ->join('citas','citas_enfermeria.id','=','citas.id')
                    ->where('nurse_evolutions.episode_id','=',$idEpisodio)
                    ->where('citas.fecha','=',$fecha)
                    ->get();
                return view('partials.coordinator.evoluciones.general',['evolucionesEnfermeria'=>$evolucioesEnfermeria,'nombre'=>$nombrePaciente,'fecha'=>$fecha,'idEpi'=>$idEpisodio,'tipoEvo'=>$tipoEvo,'mesAnio'=>$mesAnio]);
            }else{
                $mesSeteado=substr($mesAnio,5);
                $anioSeteado=strtok($mesAnio,'-');
                $evolucioesEnfermeria=NurseEvolution::join('citas_enfermeria','nurse_evolutions.cita_enfermeria_id','citas_enfermeria.id')
                    ->join('citas','citas_enfermeria.id','=','citas.id')
                    ->where('nurse_evolutions.episode_id','=',$idEpisodio)
                    ->whereMonth('citas.fecha','=',$mesSeteado)
                    ->whereYear('citas.fecha','=',$anioSeteado)
                    ->get();

                return view('partials.coordinator.evoluciones.general',['evolucionesEnfermeria'=>$evolucioesEnfermeria,'nombre'=>$nombrePaciente,'fecha'=>$fecha,'idEpi'=>$idEpisodio,'mesAnio'=>$mesAnio,'tipoEvo'=>$tipoEvo]);

            }



           //

        }



    }

    public function medicacion(){

        //$medicamentos=Medicine::all();
        return view('partials.coordinator.medicacion.medicacion');
    }


}
