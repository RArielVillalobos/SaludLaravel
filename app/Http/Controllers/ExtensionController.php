<?php

namespace App\Http\Controllers;

//use App\CitaMedicalVisit;
use App\Doctor;
use App\Episode;
use App\Extension;
use App\MedicalIncome;
use App\Recipe;
use App\Indication;
use App\Medicine;
use App\MedicalProvisions;
use App\NursingProvisions;
use App\KinesiologyProvisions;
use App\PsycologyProvision;
use App\Provisions;
use App\MedicalReport;
use App\SocialContext;
use App\MedicineRecipe;
use App\Treatment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;


class ExtensionController extends Controller
{
    //

    public function asignar(){

          $episodesActivos=Episode::where('episode_state_id','=',2)->get();
          $doctores=Doctor::all();

          $fechaActual=Carbon::now();
          $mesActual=$fechaActual->format('m');

          $dia='23';
          $anoActual=$fechaActual->format('Y');

          $nuevaFecha=$anoActual.'-'.$mesActual.'-'.$dia;



        return view('admin.prorrogas.asignar',['fechaActual'=>$nuevaFecha,'doctores'=>$doctores,'episodiosActivos'=>$episodesActivos]);
    }

    public function store(Request $request){
        $doctor_id=$request->input('doctor');
        $idepisodio=$request->input('episodio');
        $fechaProrroga=$request->input('fecha');


        /*
         * Version vieja
         * $ingresoMedico=DB::table('cita_medical_visits')
            ->join('cita_medicas','cita_medical_visits.id','=','cita_medicas.id')
            ->join('episodes','cita_medicas.episode_id','=','episodes.id')
            ->select('cita_medical_visits.id')
            ->where('cita_medicas.episode_id','=',$idepisodio)->get()->first();

        $ingresoMedi=CitaMedicalVisit::findOrFail($ingresoMedico->id);
        */
        $ingresoMedico=MedicalIncome::where('episode_id','=',$idepisodio)->get()->first();



        //dd($ingresoMedico);

        $medicalIncome_id=$ingresoMedico->id;



        //$medicalIncomeEpi=

        $prorroga=new Extension();
        $prorroga->fecha_prorroga=$fechaProrroga;
        $prorroga->medical_income_id=$medicalIncome_id;
        $prorroga->doctor_id=$doctor_id;
        $prorroga->save();

        return redirect('/prorrogas');



    }

    public function showprorogas(){
        $fechaActual=Carbon::now();
        $mesActual=$fechaActual->month;

        $prorrogas=Extension::whereMonth('fecha_prorroga','=',$mesActual)->get();


        return view('admin.prorrogas.show',['prorrogas'=>$prorrogas]);
    }

    public function showOpciones($idprorroga){
        $prorroga=Extension::findOrFail($idprorroga);
        //$citaMedicalReport=MedicalIncomeExist::findOrFail($id);



        return view('partials.doctor.prorroga.show',['prorroga'=>$prorroga]);
    }

    public function show(Extension $prorroga ){

        Session::forget('ultimaRecetaMedica');


        $idEpisodio=$prorroga->medicalIncome->informeMedico->episode->id;

        $ultimoInformeMedicoDelEpi=MedicalReport::all()->where('episode_id','=',$idEpisodio)->last();



        //probandp
        $recetaMedica=DB::table('recipes')
            ->join('episodes','recipes.episode_id','=','episodes.id')
            ->select('recipes.id')
            ->where('episodes.id','=',$idEpisodio)->get()->last();


        if($recetaMedica!=null){
            $ultimaRecetaMedicaDelEpisodio=Recipe::find($recetaMedica->id);
        }



        $indicacion=DB::table('indications')
            ->join('episodes','indications.episode_id','=','episodes.id')
            ->select('indications.id')
            ->where('episodes.id','=',$idEpisodio)->get()->last();
       // dd($indicacion);
        if($indicacion!=null){
            $ultimaIndicacionDelEpisodio=Indication::find($indicacion->id);
        }


        if(!Session::has('cartMediProrroga')){
            Session::put('cartMediProrroga',array());
            if(isset($ultimaRecetaMedicaDelEpisodio) && $ultimaRecetaMedicaDelEpisodio!=null){
                $sesionCarrito=$this->cargarBdaCartMed($ultimaRecetaMedicaDelEpisodio);
            }


        }
        /*if(!Session::has('ultimaRecetaMedica')){
            Session::put('ultimaRecetaMedica',$ultimaRecetaMedicaDelEpisodio);
        }*/
        if(!Session::has('indiProrroga')){
            Session::put('indiProrroga',[]);
            if(isset($ultimaIndicacionDelEpisodio)&&$ultimoInformeMedicoDelEpi!=null){
                $sesionIndicacion=$this->cargarBdaCartIndi($ultimaIndicacionDelEpisodio);
            }



        }
        $sesionCarrito=Session::get('cartMediProrroga');
        $sesionCarritoIndi=Session::get('indiProrroga');




        return view('partials.doctor.prorroga.form',['ultimoInformeMedico'=>$ultimoInformeMedicoDelEpi,'sesionCarritoIndi'=>$sesionCarritoIndi,'sesionCarrito'=>$sesionCarrito,'prorroga'=>$prorroga]);

    }
    public function cargarBdaCartMed(Recipe $ultimaRecetaMedicaDelEpi){

        $cartMed=Session::get('cartMediProrroga');
        foreach($ultimaRecetaMedicaDelEpi->medicines as $medicine){
            $cartMed[$medicine->id]['id']=$medicine->id;
            $cartMed[$medicine->id]['nombre']=$medicine->nombre;
            $cartMed[$medicine->id]['dosis']=$medicine->pivot->dosis;
            $cartMed[$medicine->id]['via']=$medicine->pivot->via;
            $cartMed[$medicine->id]['int']=$medicine->pivot->int;
            $cartMed[$medicine->id]['observaciones']=$medicine->pivot->observaciones;
        }
        Session::put('cartMediProrroga',$cartMed);

        return $cartMed;


    }
    public function cargarBdaCartIndi(Indication $ultimaIndicacionDelEpi){
        $cartIndi=Session::get('indiEvoProrroga');
        foreach($ultimaIndicacionDelEpi->treatments as $tratamiento){
            $cartIndi[$tratamiento->nombre]['id']=$tratamiento->id;
            $cartIndi[$tratamiento->nombre]['nombre']=$tratamiento->nombre;
            $cartIndi[$tratamiento->nombre]['descripcion']=$tratamiento->descripcion;

        }
        Session::put('indiProrroga',$cartIndi);

        return $cartIndi;
    }

    public function agregarMediPr(){

        $cart=Session::get('cartMediProrroga');
        $idMedicamento=request()->input('medicamento_id');
        $medicine=Medicine::find($idMedicamento);
        $cart[$medicine->id]['id']=$medicine->id;
        $cart[$medicine->id]['nombre']=$medicine->nombre;
        $cart[$medicine->id]['dosis']=request()->input('dosis');
        $cart[$medicine->id]['via']=request()->input('via');
        $cart[$medicine->id]['int']=request()->input('int');
        $cart[$medicine->id]['observaciones']=request()->input('observaciones');
        //actualizamos la variable de sesion
        Session::put('cartMediProrroga',$cart);

        return back();
    }

    public function removeMedPr(Medicine $medicine){
        $cart=Session::get('cartMediProrroga');
        unset($cart[$medicine->id]);
        Session::put('cartMediProrroga',$cart);
        //dd($cart);
        return back();
    }

    public function resetMedicacionPr(){
        //Session::forget('ultimaRecetaMedica');
        Session::forget('cartMediProrroga');
       // Session::forget('ultimaRecetaMedica');

        //$ultimaRecetaMedica=(Session::get('ultimaRecetaMedica'));
        //$nuevoCar=$this->cargarBdaCartMed($ultimaRecetaMedica);
        //dd($nuevoCar);

        return back();
    }

    public function agregarIndiPr(){
        $cart=Session::get('indiProrroga');
        $cart[request()->input('nombre')]['nombre']=request()->input('nombre');
        $cart[request()->input('nombre')]['descripcion']=request()->input('descripcion');

        //actualizamos la variable de sesion
        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");
        Session::put('indiProrroga',$cart);

        return back();
    }

    public function removeIndiPr($indicacion){
        $cart=Session::get('indiProrroga');
        unset($cart[$indicacion]);
        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");
        Session::put('indiProrroga',$cart);

        return back();
    }

    public function resetIndicacionPr(){
        Session::forget('indiProrroga');

        return back();
    }





    public function storeExtension(Request $request){
        $error=null;
        DB::beginTransaction();

        try{
            $prorroga_id=$request->input('prorroga_id');
            $prorroga=Extension::findOrFail($prorroga_id);
            $idEpisodio=$prorroga->medicalIncome->informeMedico->episode->id;

            $medicalProvision=new MedicalProvisions();
            $medicalProvision->valor=$request->input('cantidad_prov_med');
            $medicalProvision->tipo=$request->input('tipo_med');
            $medicalProvision->save();

            $enfProvision=new NursingProvisions();
            $enfProvision->valor=$request->input('cant_prov_enf');
            $enfProvision->tipo=$request->input('tipo_enf');
            $enfProvision->save();

            $kineProvision=new KinesiologyProvisions();
            $kineProvision->valor=$request->input('cant_prov_kine');
            $kineProvision->tipo=$request->input('tipo_kine');
            $kineProvision->save();

            $psiProvision=new PsycologyProvision();
            $psiProvision->valor=$request->input('cant_prov_psi');
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

            if(count(Session::get('cartMediProrroga'))>=1){
                $recipe=new Recipe();
                $recipe->fecha=Carbon::now();
                $recipe->episode_id=$idEpisodio;
                //$recipe->observaciones='jejejejsdsa receta medica prorro';
                $recipe->save();
            }


            //$recipe->cita_medica_id=$cita_medica_id;
            //$recipe->doctor_id=auth()->user()->id;



            if(count(Session::get('indiProrroga'))>=1){
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
            $informeMedico->fecha=$prorroga->fecha_prorroga;
            $informeMedico->hora=null;
            $informeMedico->antecedentes=$request->input('antecedentes');
            $informeMedico->enfermerdad_actual=$request->input('enfermedad_actual');
            //$informeMedico->diagnostico_pasivo=$request->input('diagnostico_pasivo');
            //$informeMedico->diagnostico_activo=$request->input('diagnostico_activo');

            $informeMedico->save();

            //buscamos el episodio y le damos ingreso medico


            $prorroga->medical_report_id=$informeMedico->id;
            $prorroga->save();

            $cart=Session::get('cartMediProrroga');
            foreach($cart as $medicine){
                $medicine_recipe=new MedicineRecipe();
                $medicine_recipe->medicine_id=$medicine['id'];
                $medicine_recipe->recipe_id=$recipe->id;
                $medicine_recipe->dosis=$medicine['dosis'];
                $medicine_recipe->via=$medicine['via'];
                $medicine_recipe->int=$medicine['int'];
                $medicine_recipe->observaciones=$medicine['observaciones'];
                $medicine_recipe->save();


            }
            Session::forget('cartMediProrroga');
            $indi=Session::get('indiProrroga');

            if(count($indi)>=1){
                foreach($indi as $indicacion){

                    $treatment=new Treatment();
                    $treatment->indication_id=$indication->id;
                    $treatment->nombre=$indicacion['nombre'];
                    $treatment->descripcion=$indicacion['descripcion'];
                    $treatment->save();



                }
                Session::forget('indiProrroga');
            }
            DB::commit();
            $success=true;



        }catch(\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
            $success=false;

        }


        return  redirect('/prorroga/'.$prorroga_id);

    }

    public function pdfProrroga($idprorroga){
        $prorroga=Extension::findOrFail($idprorroga);





        $edad = Carbon::parse($prorroga->medicalReport->episode->patient->fecha_nacimiento)->age;
        $episode=$prorroga->medicalReport->episode;
        $provision = $prorroga->MedicalReport->provision;
        $informeMedico=$prorroga->medicalReport;

        $pdf = PDF::loadView('admin.prorrogas.pdf.medicalReport',['prorroga'=>$prorroga,'edad'=>$edad,'provision'=>$provision,'informeMedico'=>$informeMedico,'episode'=>$episode]);
        return $pdf->stream();
    }

    public function postAutorizarProrroga(Request $request){

        $prorroga_id=$request->input('prorroga_id');
        $desde=$request->input('desde');
        $hasta=$request->input('hasta');
        $autorizado=$request->input('autorizado');
        //dd($request->all());
        if($autorizado=='si'){


            $prorroga=Extension::findOrFail($prorroga_id);
            $prorroga->autorizado=$autorizado;
            $idprovisionDeEstaProrroga=$prorroga->medicalReport->provision->id;
            $prorroga->save();

            $provision=Provisions::findOrFail($idprovisionDeEstaProrroga);
            $provision->autorizado_desde=$desde;
            $provision->autorizado_hasta=$hasta;
            $provision->save();

            $prorroga->medicalReport->provision->autoridado_desde=$desde;
            $prorroga->medicalReport->provision->autoridado_hasta=$hasta;
        } elseif ($autorizado=='no'){

            $prorroga=Extension::findOrFail($prorroga_id);
            $prorroga->autorizado=$autorizado;
            $prorroga->save();

        }

        return redirect('home');





    }



}
