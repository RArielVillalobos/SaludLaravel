<?php

namespace App\Http\Controllers;

use App\CitaEvolutionMedical;
use App\CitaMedica;
use App\CitaMedicalVisit;
use App\Indication;
use App\MedicalEvolution;
use App\Medicine;
use App\MedicineRecipe;
use App\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Treatment;


class MedicalEvolutionController extends Controller
{
    //

    public $idEpisodio;

    public $ultimaRecetaMedica;

    public $cita;

    public function getidEpi(){
        return $this->idEpisodio;
    }
    public function setidEpi($nuevoValor){
        $this->idEpisodio=$nuevoValor;
    }

    public function ultimaRecetaMedica(){
        return $this->ultimaRecetaMedica;
    }
    public function setultimaRecetaMedica($nuevoValor){
        $this->ultimaRecetaMedica=$nuevoValor;
    }



    public function __construct()

    {
        //Session::forget('ultimaRecetaMedica');


    }



    public function cargar(){

        $cita_id=request()->input('cita_evolution_medical_id');
        $fecha_cita=request()->input('fecha_cita');
        $nombre_paciente=request()->input('nombre_paciente');
        $apellido_paciente=request()->input('apellido_paciente');
        $citaMedicaEvolution=CitaMedica::where('id','=',$cita_id)->get()->first();
        $idEpisodio=$episodio=$citaMedicaEvolution->episode->id;
        $this->setidEpi($idEpisodio);
        /*$totalCitasMedicas=$episodio->citasMedicas->count();
        $anteUltimaVisitaMedica=$totalCitasMedicas-1;
        $instanciaAnteUltimaVisitaMedica=$episodio->citasMedicas[$anteUltimaVisitaMedica-1];
        $ultimaReceta=$instanciaAnteUltimaVisitaMedica->recipe;*/
        //query Builder
        /*$RecetaMedica = DB::table('medicine_recipe')
            ->join('recipes', 'medicine_recipe.recipe_id', '=', 'recipes.id')
            ->join('medicines', 'medicine_recipe.recipe_id', '=', 'medicines.id')
            ->join('episodes', 'recipes.cita_medica_id', '=', 'episodes.id')
            ->select('medicine_recipe.dosis','medicine_recipe.recipe_id', 'recipes.cita_medica_id', 'medicines.nombre')

            ->get();*/
        //otro
        $RecetaMedica = DB::table('recipes')
            ->join('cita_medicas', 'recipes.cita_medica_id', '=', 'cita_medicas.id')
            ->join('episodes', 'cita_medicas.episode_id', '=', 'episodes.id')
            ->select('recipes.id','recipes.cita_medica_id')
            ->where('episodes.id','=',$idEpisodio)->get()->last();


        //este es el que serviria
        $ultimaRecetaMedicaDelEpisodio=Recipe::find($RecetaMedica->id);
        $this->setultimaRecetaMedica($ultimaRecetaMedicaDelEpisodio);


        $sesionCarrito=$this->cargarBdaCartMed($ultimaRecetaMedicaDelEpisodio);

        //$sesionCarrito=Session::get('cartMedi');


        $medicacionDisponible=Medicine::where('activo','=','si');
        dd($medicacionDisponible);

        return view('medicalEvolutions.form',['medicacionDisp'=>$medicacionDisponible,'sesionCarrito'=>$sesionCarrito,'citaMedicaEvolution'=>$citaMedicaEvolution,'cita_id'=>$cita_id,'fecha_cita'=>$fecha_cita,'nombre_paciente'=>$nombre_paciente,'apellido_paciente'=>$apellido_paciente]);

    }

    public function cargarEvo(CitaMedica $cita ){
        //Session::forget('ultimaRecetaMedica');

        $citaMedicaEvolution=CitaMedica::where('id','=',$cita->id)->get()->first();
        $idEpisodio=$episodio=$citaMedicaEvolution->episode->id;
        $this->setidEpi($idEpisodio);
        $this->cita=$cita;



        //probandp
        $recetaMedica=DB::table('recipes')
            ->join('episodes','recipes.episode_id','=','episodes.id')
            ->select('recipes.id')
            ->where('episodes.id','=',$idEpisodio)->get()->last();
        //dd($recetaMedica);

        //antes
        //$RecetaMedica = DB::table('recipes')
          //  ->join('cita_medicas', 'recipes.cita_medica_id', '=', 'cita_medicas.id')
            //->join('episodes', 'cita_medicas.episode_id', '=', 'episodes.id')
            //->select('recipes.id','recipes.cita_medica_id')
            //->where('episodes.id','=',$idEpisodio)->get()->last();
        //este es el que serviria


        //$this->setultimaRecetaMedica($ultimaRecetaMedicaDelEpisodio);
        //ANTES
        /*$indicacion = DB::table('indications')
            ->join('cita_medicas', 'indications.cita_medica_id', '=', 'cita_medicas.id')
            ->join('episodes', 'cita_medicas.episode_id', '=', 'episodes.id')
            ->select('indications.id','indications.cita_medica_id')
            ->where('episodes.id','=',$idEpisodio)->get()->last();*/
        //ahora
        $indicacion=DB::table('indications')
            ->join('episodes','indications.episode_id','=','episodes.id')
            ->select('indications.id')
            ->where('indications.episode_id','=',$idEpisodio)->get()->last();

        if($indicacion!=null){
            $ultimaIndicacionDelEpisodio=Indication::find($indicacion->id);

        }
        if($recetaMedica!=null){
            $ultimaRecetaMedicaDelEpisodio=Recipe::find($recetaMedica->id);

        }


        if(!Session::has('cartMedi')){
            Session::put('cartMedi',array());
            if(isset($ultimaRecetaMedicaDelEpisodio) && $ultimaRecetaMedicaDelEpisodio !=null){
                $sesionCarrito=$this->cargarBdaCartMed($ultimaRecetaMedicaDelEpisodio);
            }


        }
        /*if(!Session::has('ultimaRecetaMedica')){
            Session::put('ultimaRecetaMedica',$ultimaRecetaMedicaDelEpisodio);
        }*/


        if(!Session::has('indiEvo')){
            Session::put('indiEvo',[]);
            if(isset($ultimaIndicacionDelEpisodio)&& $ultimaIndicacionDelEpisodio!=null){
                $sesionIndicacion=$this->cargarBdaCartIndi($ultimaIndicacionDelEpisodio);
            }


        }
        $sesionCarrito=Session::get('cartMedi');
        $sesionCarritoIndi=Session::get('indiEvo');


        $medicacionDisponible=Medicine::all()->where('activo','=','si');

        return view('medicalEvolutions.form',['medicacionDisp'=>$medicacionDisponible,'sesionCarritoIndi'=>$sesionCarritoIndi,'sesionCarrito'=>$sesionCarrito,'cita'=>$cita]);

    }



    public function cargarBdaCartMed(Recipe $ultimaRecetaMedicaDelEpi){
        //Session::forget('cartMedi');
        $cartMed=Session::get('cartMedi');
        foreach($ultimaRecetaMedicaDelEpi->medicines as $medicine){
            $cartMed[$medicine->id]['id']=$medicine->id;
            $cartMed[$medicine->id]['nombre']=$medicine->nombre;
            $cartMed[$medicine->id]['dosis']=$medicine->pivot->dosis;
            $cartMed[$medicine->id]['via']=$medicine->pivot->via;
            $cartMed[$medicine->id]['int']=$medicine->pivot->int;
            $cartMed[$medicine->id]['observaciones']=$medicine->pivot->observaciones;
        }
        Session::put('cartMedi',$cartMed);

        return $cartMed;


    }

    public function cargarBdaCartIndi(Indication $ultimaIndicacionDelEpi){
        $cartIndi=Session::get('indiEvo');
        foreach($ultimaIndicacionDelEpi->treatments as $tratamiento){
            $cartIndi[$tratamiento->nombre]['id']=$tratamiento->id;
            $cartIndi[$tratamiento->nombre]['nombre']=$tratamiento->nombre;
            $cartIndi[$tratamiento->nombre]['descripcion']=$tratamiento->descripcion;

        }
        Session::put('indiEvo',$cartIndi);

        return $cartIndi;
    }

    public function livesearchmedi(Request $request){
        if ($request->ajax()) {

            $output="";
            //$medicamentos = DB::table('medicines')->where('nombre', 'LIKE', "%{$request->search}%")->get();
            $medicamentos=Medicine::where('nombre','LIKE',"%{$request->searchmedievo}%")->take(6)->get();
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
    public function agregar(){

        $cart=Session::get('cartMedi');
        $idMedicamento=request()->input('medicamento_id');
        $medicine=Medicine::find($idMedicamento);
        $cart[$medicine->id]['id']=$medicine->id;
        $cart[$medicine->id]['nombre']=$medicine->nombre;
        $cart[$medicine->id]['dosis']=request()->input('dosis');
        $cart[$medicine->id]['via']=request()->input('via');
        $cart[$medicine->id]['int']=request()->input('int');
        $cart[$medicine->id]['observaciones']=request()->input('observaciones');
        //actualizamos la variable de sesion
        Session::put('cartMedi',$cart);

        return back();
    }

    public function agregarIndi(){
        $cart=Session::get('indiEvo');
        $cart[request()->input('nombre')]['nombre']=request()->input('nombre');
        $cart[request()->input('nombre')]['descripcion']=request()->input('descripcion');

        //actualizamos la variable de sesion
        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");

        Session::put('indiEvo',$cart);

        return back();
    }

    public function remove(Medicine $medicine){
        $cart=Session::get('cartMedi');
        unset($cart[$medicine->id]);
        Session::put('cartMedi',$cart);
        //dd($cart);
        return back();
    }

    public function removeIndi($indicacion){
        $cart=Session::get('indiEvo');
        unset($cart[$indicacion]);
        Session::flash('claseUnoIndi', "active");
        Session::flash('claseDosIndi', "show active");
        Session::put('indiEvo',$cart);

        return back();


    }
    public function resetMedicacion(){
        //Session::forget('ultimaRecetaMedica');
        Session::forget('cartMedi');
        Session::forget('ultimaRecetaMedica');

        //$ultimaRecetaMedica=(Session::get('ultimaRecetaMedica'));
        //$nuevoCar=$this->cargarBdaCartMed($ultimaRecetaMedica);
        //dd($nuevoCar);

        return back();
    }
    public function resetIndicacion(){
        Session::forget('indiEvo');

        return back();
    }

    public function showCartMed(){
        $cartMed=Session::get('cart');
        return $cartMed;
    }

    public function storeEvolucion(Request $request){
        $mensajes=[
            'evolucion.required'=>'La evolución es requerida'
        ];
        $this->validate($request,[
            'evolucion'=>'required'
        ],$mensajes);

       // dd($request->all());
        $fecha_cita=request()->input('fecha');
        $cita_id=$request->input('cita_id');
        $citaEvolucionMedica=CitaEvolutionMedical::findOrFail($cita_id);
        $episode_id=$citaEvolucionMedica->citaMedica->episode->id;
        $horaCita=$citaEvolucionMedica->citaMedica->hora;

        $error=null;
        DB::beginTransaction();

        try{
            $cart=Session::get('cartMedi');
            if(count($cart)>=1){
                $recipe=new Recipe();
                $recipe->fecha=$fecha_cita;

                //$recipe->observaciones='sdsdsd';
                $recipe->episode_id=$episode_id;

                $recipe->save();

            }
            if(count($cart)>=1){
                foreach($cart as $medicine){
                    $medicine_recipe=new MedicineRecipe();
                    $medicine_recipe->medicine_id=$medicine['id'];
                    $medicine_recipe->recipe_id=$recipe->id;
                    $medicine_recipe->dosis=$medicine['dosis'];
                    $medicine_recipe->via=$medicine['via'];
                    $medicine_recipe->int=$medicine['int'];
                    $medicine_recipe->observaciones=$medicine['observaciones'];
                    $medicine_recipe->save();

                    Session::forget('cartMedi');
                }
            }

            $indicacionesEvo=Session::get('indiEvo');
            if(count($indicacionesEvo)>=1){
                $indication=new Indication();
                $indication->episode_id=$episode_id;
                $indication->save();
            }


            if(count($indicacionesEvo)>=1){
                foreach($indicacionesEvo as $indicacion){

                    $treatment=new Treatment();
                    $treatment->indication_id=$indication->id;
                    $treatment->nombre=$indicacion['nombre'];
                    $treatment->descripcion=$indicacion['descripcion'];
                    $treatment->save();



                }
                Session::forget('indiEvo');
            }


            $fecha_cita=request()->input('fecha');
            $ta=request()->input('ta');
            $fr=request()->input('fr');
            $fc=request()->input('fc');
            $temp=request()->input('temp');
            $hgt=request()->input('hgt');
            $spo=request()->input('spo');
            $diuresis=request()->input('diuresis');
            $catarsis=request()->input('catarsis');
            $evolucion=request()->input('evolucion');

            $medical_evolution=new MedicalEvolution();
            if(isset($indication)){
                $medical_evolution->indication_id=$indication->id;
            }
            if(isset($recipe)){
                $medical_evolution->recipe_id=$recipe->id;
            }
            $medical_evolution->cita_evolution_medical_id=$cita_id;
            $medical_evolution->fecha=$fecha_cita;

            $medical_evolution->episode_id=$episode_id;
            $medical_evolution->hora=$horaCita;
            $medical_evolution->ta=$ta;
            $medical_evolution->fr=$fr;
            $medical_evolution->fc=$fc;
            $medical_evolution->temp=$temp;

            $medical_evolution->hgt=$hgt;
            $medical_evolution->spo=$spo;
            $medical_evolution->diuresis=$diuresis;
            $medical_evolution->catarsis=$catarsis;
            $medical_evolution->evolucion=$evolucion;
            $medical_evolution->save();

            DB::commit();
            $success=true;


        }catch(\Exception $e){
            $error=$e->getMessage();
            DB::rollback();
            //dd($error);
            $success=false;

        }

        return redirect('citas/'.$cita_id);




    }


}
