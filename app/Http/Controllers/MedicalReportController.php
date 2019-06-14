<?php

namespace App\Http\Controllers;


use App\CitaMedica;
//use App\CitaMedicalVisit;
use App\Episode;
use App\Indication;
use App\KinesiologyProvisions;
use App\MedicalIncome;
use App\MedicalProvisions;
use App\MedicalReport;
use App\Medicine;
use App\MedicineRecipe;
use App\NursingProvisions;
use App\Provisions;
use App\PsycologyProvision;
use App\Recipe;
use App\SocialContext;
use App\Treatment;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;





class MedicalReportController extends Controller
{
    //
    public function showOpcionesMedicalReport($id){
        $citaMedicalReport=MedicalIncome::findOrFail($id);
        //$citaMedicalReport=MedicalIncomeExist::findOrFail($id);


        return view('partials.doctor.medical_report.show',['cita'=>$citaMedicalReport]);

    }

    public function show($id, Request $request)
    {
        $visitaMedica = MedicalIncome::findOrFail($id);

        $medicamentosActivos = Medicine::all()->where('activo', '=', 'si');

        if (!Session::has('medi')) {
            Session::put('medi', []);

        }
        if (!Session::has('indicacion')) {
            Session::put('indicacion', []);

        }
        $medi = Session::get('medi');
        $indicaciones = Session::get('indicacion');
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($indicaciones);
        $perPage = 4;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $indicaciones = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $indicaciones->setPath($request->url());

        return view('partials.doctor.medical_report.form', ['indicaciones' => $indicaciones, 'medi' => $medi, 'medicamentosActivos' => $medicamentosActivos, 'visitaMedica' => $visitaMedica]);
    }

    public function searchmedicacion(Request $request)
    {
        if ($request->ajax()) {

            $output="";
            //$medicamentos = DB::table('medicines')->where('nombre', 'LIKE', "%{$request->search}%")->get();
            $medicamentos=Medicine::where('nombre','LIKE',"%{$request->search}%")->take(6)->get();
            if ($medicamentos) {
                foreach ($medicamentos as $key => $medicamento) {
                    $output .= '<tr>' .
                        '<td>' . $medicamento->id . '</td>' .
                        '<td>' . $medicamento->nombre . '</td>' .
                        '<td><a href="#"  class="btn btn-success btn-sm bton"  data-medicamento='.$medicamento->id .' data-nombremedi="'.$medicamento->nombre.'" data-target="#exampleModal">Agregar</a>' .
                        '</tr>';
                }

                return Response($output);
            }


        }



    }

    public function agregar(Request $request){


        $cart=Session::get('medi');

        $idMedicamento=$request->input('medicamento_id');
        $medicine=Medicine::find($idMedicamento);
        $cart[$medicine->id]['id']=$medicine->id;
        $cart[$medicine->id]['nombre']=$medicine->nombre;
        $cart[$medicine->id]['dosis']=$request->input('dosis');
        $cart[$medicine->id]['via']=$request->input('via');
        $cart[$medicine->id]['int']=$request->input('int');
        $cart[$medicine->id]['observaciones']=$request->input('observaciones');
        //actualizamos la variable de sesion
        Session::put('medi',$cart);

        return back();
    }

    public function quitar(Medicine $medicine){
        $cart=Session::get('medi');
        unset($cart[$medicine->id]);
        Session::put('medi',$cart);
        //dd($cart);
        return back();
    }

    public function store(Request $request){

        //dd($request->all());

        $mensajes=[
            'antecedentes.required'=>'El campo antecedentes es requerido',
            'enfermedad_actual.required'=>'El campo es enfermedad es requerido',

        ];

        $this->validate($request,[
            'antecedentes'=>'required',
            'enfermedad_actual'=>'required',

        ],$mensajes);
        DB::beginTransaction();
        $error=null;


        try{
            $cita_medica_id=$request->input('cita_medica_id');

            $citaMedica=MedicalIncome::find($cita_medica_id);
            $idEpisodio=$citaMedica->episode_id;

            $medicalProvision=new MedicalProvisions();
            $medicalProvision->valor=$request->input('cantidad_med');
            $medicalProvision->tipo=$request->input('tipo_med');
            $medicalProvision->save();


            $enfProvision=new NursingProvisions();
            $enfProvision->valor=$request->input('cantidad_enf');
            $enfProvision->tipo=$request->input('tipo_enf');
            $enfProvision->save();

            $kineProvision=new KinesiologyProvisions();
            $kineProvision->valor=$request->input('cantidad_kine');
            $kineProvision->tipo=$request->input('tipo_kine');
            $kineProvision->save();

            $psiProvision=new PsycologyProvision();
            $psiProvision->valor=$request->input('cantidad_psi');
            $psiProvision->tipo=$request->input('tipo_psi');
            $psiProvision->save();

            $provisionDelInforme=new Provisions();
            $provisionDelInforme->autorizado_desde=null;
            $provisionDelInforme->autorizado_hasta=null;
            $provisionDelInforme->medical_provision_id=$medicalProvision->id;
            $provisionDelInforme->nursing_provision_id=$enfProvision->id;
            $provisionDelInforme->kinesiology_provision_id=$kineProvision->id;
            $provisionDelInforme->psycology_provision_id=$psiProvision->id;
            $provisionDelInforme->save();

            if(count(Session::get('medi'))>=1){
                $recipe=new Recipe();
                $recipe->fecha=$citaMedica->fecha;
                $recipe->episode_id=$idEpisodio;
                //$recipe->observaciones='jejejejsdsa receta medica';
                $recipe->save();
            }

            //$recipe->cita_medica_id=$cita_medica_id;
        //$recipe->doctor_id=auth()->user()->id;



            if(count(Session::get('indicacion'))>=1){
            $indication=new Indication();
            $indication->episode_id=$idEpisodio;
            $indication->save();
            }

            $informeMedico=new MedicalReport();
            // $informeMedico->cita_medical_visit_id=$cita_medica_id;

            if(isset($indication)){
            $informeMedico->indication_id=$indication->id;
            }
            if(isset($recipe)){
            $informeMedico->recipe_id=$recipe->id;
            }

            $informeMedico->episode_id=$idEpisodio;
            $informeMedico->doctor_id=auth()->user()->doctor->id;
            $informeMedico->provision_id=$provisionDelInforme->id;
            $informeMedico->fecha=$citaMedica->fecha;
            $informeMedico->hora=$citaMedica->hora;
            $informeMedico->antecedentes=$request->input('antecedentes');
            $informeMedico->enfermerdad_actual=$request->input('enfermedad_actual');
            //$informeMedico->diagnostico_pasivo=$request->input('diagnostico_pasivo');
            //$informeMedico->diagnostico_activo=$request->input('diagnostico_activo');
            $informeMedico->ta=$request->input('ta');
            $informeMedico->fr=$request->input('fr');
            $informeMedico->fc=$request->input('fc');
            $informeMedico->temp=$request->input('temp');
            $informeMedico->hgt=$request->input('hgt');
            $informeMedico->spo=$request->input('spo');
            $informeMedico->diuresis=$request->input('diuresis');
            $informeMedico->catarsis=$request->input('catarsis');
            $informeMedico->save();

            //buscamos el episodio y le damos ingreso medico


            $medicalIncome=MedicalIncome::findOrFail($cita_medica_id);
            $medicalIncome->medical_report_id=$informeMedico->id;
            $medicalIncome->save();

            $episodio=Episode::find($idEpisodio);
            $episodio->fecha_ingreso_medico=$informeMedico->medicalIncome->fecha;
            $episodio->save();

            $cart=Session::get('medi');
            foreach($cart as $medicine) {
                $medicine_recipe = new MedicineRecipe();
                $medicine_recipe->medicine_id = $medicine['id'];
                $medicine_recipe->recipe_id = $recipe->id;
                $medicine_recipe->dosis = $medicine['dosis'];
                $medicine_recipe->via = $medicine['via'];
                $medicine_recipe->int = $medicine['int'];
                $medicine_recipe->observaciones = $medicine['observaciones'];
                $medicine_recipe->save();
            }

            Session::forget('medi');
            $indi=Session::get('indicacion');

            if(count($indi)>=1){
                    foreach($indi as $indicacion){

                        $treatment=new Treatment();
                        $treatment->indication_id=$indication->id;
                        $treatment->nombre=$indicacion['nombreIndi'];
                        $treatment->descripcion=$indicacion['descripcionIndi'];
                        $treatment->save();



                    }
                    Session::forget('indicacion');
            }




         DB::commit();
         $success=true;


        }catch (\Exception $e){
            $success=false;
            $error=$e->getMessage();
            DB::rollback();
            dd($error);

        }
        return redirect('ingresomedico/'.$cita_medica_id);

    }

    public function agregarIndi(Request $request){
        $nombreIndicacion=$request->input('nombre');
        $descripcionIndicacion=$request->input('descripcion');

        $indi=Session::get('indicacion');
        $indi[$nombreIndicacion]['nombreIndi']=$nombreIndicacion;
        $indi[$nombreIndicacion]['descripcionIndi']=$descripcionIndicacion;


        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");
        //$claseUno='active';
        //$claseDos='show active';


        Session::put('indicacion',$indi);

        return back();


    }

    public function quitarIndi($indicacion){

        $cart=Session::get('indicacion');

        unset($cart[$indicacion]);
        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");
        Session::put('indicacion',$cart);

        return back();
    }
}
