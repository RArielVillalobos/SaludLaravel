<?php

namespace App\Http\Controllers;

use App\CitaEnfermeria;
use App\CitaEvolutionMedical;
use App\CitaMedica;

use App\Coordinator;

use App\Doctor;
use App\Episode;
use App\Extension;
use App\HighMedical;
use App\HighType;
use App\Http\Middleware\Admin;
use App\Kinesiologist;
use App\KinesiologistEvolution;
use App\MedicalEvolution;
use App\MedicalIncome;
use App\MedicalReport;

use App\Nurse;
use App\NurseEvolution;
use App\Patients;

//use Barryvdh\DomPDF\PDF;
use App\Provisions;
use App\Psychologist;
use App\PsychologistEvolution;
use App\PsychoSocialIncome;
use App\Role;
use App\SocialAssistant;
use App\SocialAssistantEvolution;
use App\SocialWork;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Cita;
use Illuminate\Support\Facades\DB;





class AdminController extends Controller
{
    //
    public function homeGeneral(){
        return view('layouts.app');
    }
    public function listadoPacientesActivos(){
        $episodiosActivos=Episode::where('episode_state_id','=',2)->orderBy('id','desc')->paginate(12);


        return view('partials.admin.pacientesActivos',['episodiosActivos'=>$episodiosActivos]);

    }

    public function evoluciones($idepisodio)
    {


        $episode = Episode::findOrFail($idepisodio);


        $informeMedico = MedicalReport::where('episode_id', '=', $idepisodio)->get()->last();



        $provision = $informeMedico->provision;


        $evolucionesMedicasEpi=MedicalEvolution::all()->where('episode_id','=',$idepisodio);
        $ultimaEvoEnfermeriaEpi=NurseEvolution::where('episode_id','=',$idepisodio)->get()->last();
        $ultimaEvoKinesiologia=KinesiologistEvolution::where('episode_id','=',$idepisodio)->get()->last();
        $ultimaEvoPsico=PsychologistEvolution::where('episode_id','=',$idepisodio)->get()->last();
        $ultimaEvoAsistente=SocialAssistantEvolution::where('episode_id','=',$idepisodio)->get()->last();



        $medicalIncome=MedicalIncome::join("medical_reports","medical_incomes.medical_report_id","=","medical_reports.id")
            ->join('episodes','medical_reports.episode_id','=','episodes.id')
            ->where('episodes.id','=',$idepisodio)->get()->first();


        $prorrogasDeEsteEpi = Extension::join("medical_reports","extensions.medical_report_id","=","medical_reports.id")
            ->join('episodes','medical_reports.episode_id','=','episodes.id')
            ->select('extensions.id','extensions.fecha_prorroga')
            ->where('episodes.id','=',$idepisodio)->get();

        return view('patients.evoluciones',['ultimaEvoAsistente'=>$ultimaEvoAsistente,'ultimaEvoPsico'=>$ultimaEvoPsico,'ultimaEvoKine'=>$ultimaEvoKinesiologia,'ultimaEvoEnfermeria'=>$ultimaEvoEnfermeriaEpi,'medicalIncome'=>$medicalIncome,'prorrogasEpi'=>$prorrogasDeEsteEpi,'episode'=>$episode,'informeMedico'=>$informeMedico,'provision'=>$provision,'evolucionesMedicas'=>$evolucionesMedicasEpi]);
}


    public function form(){
        $medicos=\App\Doctor::all();
        $asistentes_social_activos=SocialAssistant::all();
        $obras_social=SocialWork::all();


        return view('patients.form',['obras'=>$obras_social,'medicos'=>$medicos,'asistenes_soc'=>$asistentes_social_activos]);
    }

    public function store(Request $request){


        $fechaActual= Carbon::now('America/Argentina/Buenos_Aires')->format('Y-m-d');


        $error = null;
        $mensajes=[
            'nombre.required'=>'El nombre es requerido',
            'apellido.required'=>'El apellido es requerido',
            'dni.required'=>'El D.N.I es requerido',
            'dni.unique'=>'El paciente ya existe, debe agregarle un episodio nuevo',
            'fecha_nac.required'=>'La fecha de nacimiento es requerida',
            'localidad.required'=>'La localidad es requerida',
            'direccion.required'=>'la dirección es requerida',
            'telefono.required'=>'El teléfono es requerido',
            'num_afiliado.required'=>'El numero de afiliado es requerido',
            'fecha_visita_medica.required'=>'Debe asignar una fecha de ingreso médico',
            'doctor_id.required'=>'El episodio debe tener un médico responsable.'


        ];
        $this->validate($request,[
            'nombre'=>'required',
            //'segundo_nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'required|unique:patients',
            'fecha_nac'=>'required',
            'localidad'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'num_afiliado'=>'required',
            'fecha_visita_medica'=>'required',
            'doctor_id'=>'required'

        ],$mensajes);
        DB::beginTransaction();
        try{
            $paciente=new Patients();
            $paciente->nombre=strtolower(request()->input('nombre'));
            $paciente->segundo_nombre=strtolower(request()->input('segundo_nombre'));
            $paciente->apellido=strtolower(request()->input('apellido'));
            $paciente->dni=request()->input('dni');
            $paciente->familiar_responsable=strtolower(request()->input('fam_responsable'));
            $paciente->numero_tel_familiar=request()->input('num_fam_responsable');
            //$paciente->obra_social=request()->input('obra_social');
            $paciente->numero_afiliado_obra=request()->input('num_afiliado');
            $paciente->sexo=request()->input('sexo');


            $paciente->telefono=request()->input('telefono');
            $paciente->direccion=request()->input('direccion');
            $paciente->localidad=strtolower(request()->input('localidad'));
            $paciente->fecha_nacimiento=request()->input('fecha_nac');

            $paciente->sexo=request()->input('sexo');
            $paciente->estado_civil=request()->input('estado_civil');

            $paciente->save();

            $episode=new Episode();
            $episode->patient_id=$paciente->id;
            $episode->doctor_id=request()->input('doctor_id');
            //guardamos el episodio como provisorio
            $episode->episode_state_id=1;
            $episode->social_work_id=request()->input('obra_social');
            $episode->fecha_ingreso_provisorio=$fechaActual;
            $episode->fecha_ingreso_medico=null;
            $episode->fecha_activacion=null;
            $episode->fecha_fin=null;

            $episode->save();

            /*
             * Viejo
             * $citaMedica=new CitaMedica();
            $citaMedica->episode_id=$episode->id;
            $citaMedica->comentarios=request()->input('comentario');
            $citaMedica->fecha=request()->input('fecha_visita_medica');
            $citaMedica->hora=request()->input('hora_visita_medica');
            $citaMedica->save();

            $visita_medica=new CitaMedicalVisit();
            $visita_medica->id=$citaMedica->id;
            $visita_medica->doctor_id=request()->input('doctor_id');
            $visita_medica->save();*/
            $medicalIncome=new MedicalIncome();
            $medicalIncome->episode_id=$episode->id;
            $medicalIncome->doctor_id=request()->input('doctor_id');
            //este cambio se seteara cuando ya se cargue el informe;
            $medicalIncome->medical_report_id=null;
            $medicalIncome->fecha=request()->input('fecha_visita_medica');
            $medicalIncome->hora=request()->input('hora_visita_medica');
            $medicalIncome->comentarios=request()->input('comentario');
            $medicalIncome->save();


            $asis_social=request()->input('asist_social');

            if(isset($asis_social) && $asis_social!=null){
                $visita_asis_social=new PsychoSocialIncome();
                $visita_asis_social->social_assistant_id=$asis_social;
                $visita_asis_social->episode_id=$episode->id;
                $visita_asis_social->fecha=request()->input('fecha_visita_asis_social');
                $visita_asis_social->hora=request()->input('hora_visita_asis_social');
                $visita_asis_social->comentarios=request()->input('comentario_asis');
                $visita_asis_social->save();

            }

            DB::commit();
            $success=true;
        }catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage();
            DB::rollback();
            dd($error);
        }
        if($success){
            return redirect('/home')->with('message','Paciente Cargado Correctamente')->with('class','success');
        }else{
            return redirect('/home')->with('message','Error al cargar el paciente intente de nuevo')->with('class','danger');
        }


    }

    public function citaMedica(){
        $medicos=Doctor::all();
        $episodiosActivos=Episode::all()->where('estado','=',1);

        return view('citas.form',['medicos'=>$medicos,'episodiosActivos'=>$episodiosActivos]);
    }
    public function citas()
    {
        return view('partials.admin.elegir');
    }

    public function tipoCita(){
        $tipo_cita=request()->input('tipo_cita');
        return view('partials.admin.elegir',['tipo_cita'=>$tipo_cita]);
    }

    public function storecita(){
    $episodio_id=request()->input('episodio_id');
    $doctor_id=request()->input('doctor_id');
    $fecha_cita=request()->input('fecha_cita');
    $hora_cita=request()->input('hora_cita');

    $cita=new Cita();
    $cita->episode_id=$episodio_id;
    $cita->doctor_id=$doctor_id;
    $cita->fecha=$fecha_cita;
    $cita->hora=$hora_cita;
    $cita->save();

    return redirect('/home');
}
    public function storecitaenfermeria(){
        $episodio_id=request()->input('episodio_id');
        $nurse_id=request()->input('nurse_id');
        $fecha_cita=request()->input('fecha_cita');
        $hora_cita=request()->input('hora_cita');

        $cita=new CitaEnfermeria();
        $cita->episode_id=$episodio_id;
        $cita->nurse_id=$nurse_id;
        $cita->fecha=$fecha_cita;
        $cita->hora=$hora_cita;
        $cita->save();

        return redirect('/home');
    }

    public function cronomedico(){
        return view('partials.admin.cronomedico');
    }

    public function cargarcronomedico(){
        $episodiosActivos=Episode::all()->where('estado','=',1);
        $mes=request()->input('mes');
        if($mes=='mayo'){
            $arregloMes=array('2018-04-30',5);
        }


        $junio=array('2018-05-28',5);
        $julio=array('2018-06-25',6);
        $agosto=array('2018-07-30',5);
        $septiembre=array('2018-08-27',5);
        $octubre=array('2018-10-1',5);
        $noviembre=array('2018-10-29',5);
        $diciembre=array('2018-11-16',5);
        return view('partials.admin.cronomedico',['mes'=>$mes,'arregloMes'=>$arregloMes,'episodiosActivos'=>$episodiosActivos]);
    }

    public function index(){
       // $episodes=Episode::all()->take(10);
        $episodes=Episode::orderBy('id', 'DESC')->where('episode_state_id','!=',3)
            ->take(10)
            ->get();;
       // $episodes=$episodes->sortBy('id')->take(10);

        return view('home',['episodes'=>$episodes]);


    }

    public function camavirtual(){

        return view('partials.admin.camavirtual');
    }

    public function pdfMedicalReport($idInforme){
        $informeMedico=MedicalReport::findOrFail($idInforme);

        $provision = $informeMedico->provision;


        $edad = Carbon::parse($informeMedico->episode->patient->fecha_nacimiento)->age;
        $episode=$informeMedico->episode;

        $pdf = PDF::loadView('patients.pdf.medicalReport',['edad'=>$edad,'provision'=>$provision,'informeMedico'=>$informeMedico,'episode'=>$episode]);
        return $pdf->stream();


    }

    public function pdfMedicalEvolution($idEvo){
        $medicalEvolution=MedicalEvolution::findOrFail($idEvo);

        $edad = Carbon::parse($medicalEvolution->episode->patient->fecha_nacimiento)->age;
        $episode=$medicalEvolution->episode;
        $pdf = PDF::loadView('patients.pdf.medicalEvolution',['edad'=>$edad,'medicalEvolution'=>$medicalEvolution,'episode'=>$episode]);
        return $pdf->stream();
    }

    public function activarEpi(){
        $episodiosProvisoriosConfechaDingreso=Episode::where('fecha_ingreso_medico','!=',null)->where('episode_state_id','=',1)->get();






        return view('partials.admin.form_activar',['episodiosProv'=>$episodiosProvisoriosConfechaDingreso]);
    }

    public function storeActivarEpi(Request $request){

        $id_episodio=$request->input('episode_id');
        $desde=$request->input('desde');
        $hasta=$request->input('hasta');

        $medicalIncome=MedicalIncome::join("medical_reports","medical_incomes.medical_report_id","=","medical_reports.id")
            ->join('episodes','medical_reports.episode_id','=','episodes.id')
            ->where('episodes.id','=',$id_episodio)->get()->first();

        //$medicalIncome=MedicalIncome::findOrFail($medicalIncome->id);

        $idProvision=$medicalIncome->informeMedico->provision->id;
        $provision=Provisions::findOrFail($idProvision);
        $provision->autorizado_desde=$desde;
        $provision->autorizado_hasta=$hasta;
        $provision->save();

        $episodio=Episode::findOrFail($id_episodio);
        $episodio->episode_state_id=2;
        $episodio->fecha_activacion=Carbon::now();
        $episodio->save();

        return redirect('/home');



    }

    public function prestadores(){
       // return 'hola';
        $usuarios=User::orderBy('role_id','desc')->paginate(10);

        return view('admin.prestadores.show',['usuarios'=>$usuarios]);
    }

    public function Prestadoresalta(){

        $roles=Role::all();

        return view('admin.prestadores.form_alta',['roles'=>$roles]);

    }

    public function PrestadoresStore(Request $request){
        //dd($request->all());
        $rol=$request->input('rol');
        $nombre=$request->input('nombre');
        $seg_nombre=$request->input('segundo_nombre');
        $apellido=$request->input('apellido');
        $fecha_nac=$request->input('fecha_nac');
        $num_tel=$request->input('num_tel');
        $domicilio=$request->input('domicilio');
        $num_matricula=$request->input('num_matricula');
        $cod_diagrama=$request->input('cod_diagrama');
        $correo=$request->input('correo');
        $clave=$request->input('clave');
        $dni=$request->input('dni');;


        $mensajes=[
            'nombre.required'=>'El campo nombre es requerido',
            'apellido.required'=>'El campo apellido es requerido',
            'dni.required'=>'El D.N.I es requerido',
            'dni.unique'=>'Ya existe el prestador que intenta ingresar',
            'fecha_nac.required'=>'La fecha de nacimiento es requerida',
            'num_tel.required'=>'El Numero de telefono es requerido',
            'domicilio.required'=>'El domicilio es requerido',
            'cod_diagrama.required'=>'El código de diagrama es requerido',
            //'cod_diagrama.unique'=>'Ya existe un prestador con el codigo de diagrama ingresado',
            'cod_diagrama.max'=>'El codigo de diagrama no debe superar los 3 caracteres',
            'num_matricula.required'=>'El numero de matricula es requerido',
            'correo.required'=>'El correo es requerido',
            'clave.required'=>'La clave del usuario es requerida'



        ];
        //si el rol no es admin ni coordinacion
        if($rol==7 or $rol==1){
            $this->validate($request,[
                'nombre'=>'required',
                'apellido'=>'required',
                'fecha_nac'=>'required',
                'dni'=>'required|unique:users',
                'num_tel'=>'required',
                'domicilio'=>'required',
                'correo'=>'required',
                'clave'=>'required',

            ],$mensajes);
        } else{

            $this->validate($request,[
                'nombre'=>'required',
                'apellido'=>'required',
                'fecha_nac'=>'required',
                'dni'=>'required|unique:users',
                'num_tel'=>'required',
                'domicilio'=>'required',
                'cod_diagrama'=>'required|max:3',
                'num_matricula'=>'required',
                'correo'=>'required',
                'clave'=>'required'


            ],$mensajes);
        }
        DB::beginTransaction();
        $error=null;


        try{

            $usuario=new User();

            //si es admin

                $usuario->status_id=1;
                $usuario->name=strtolower($nombre);
                $usuario->second_name=strtolower($seg_nombre);
                $usuario->last_name=strtolower($apellido);
                $usuario->email=$correo;
                $usuario->domicilio=strtolower($domicilio);
                $usuario->fecha_nacimiento=$fecha_nac;
                $usuario->telefono=$num_tel;
                $usuario->dni=$dni;
                if($rol==1){
                    $usuario->is_admin=1;
                    $usuario->role_id=1;
                }elseif ($rol==2){
                    $usuario->is_admin=0;
                    $usuario->role_id=2;
                }elseif ($rol==3){
                    $usuario->is_admin=0;
                    $usuario->role_id=3;
                }elseif($rol==4){
                    $usuario->is_admin=0;
                    $usuario->role_id=4;
                }elseif($rol==5){
                    $usuario->is_admin=0;
                    $usuario->role_id=5;
                }elseif ($rol==6){
                    $usuario->is_admin=0;
                    $usuario->role_id=6;
                }elseif ($rol==7){
                    $usuario->is_admin=0;
                    $usuario->role_id=7;

                }


                $usuario->password=bcrypt($clave);
                $usuario->save();

                if($rol==2){
                    $doctor=new Doctor();
                    $doctor->user_id=$usuario->id;
                    $doctor->numero_matricula=$num_matricula;
                    $doctor->cod_diagrama=$cod_diagrama;
                    $doctor->save();
                }elseif ($rol==3){
                    $enfermero=new Nurse();
                    $enfermero->user_id=$usuario->id;
                    $enfermero->numero_matricula=$num_matricula;
                    $enfermero->cod_diagrama=$cod_diagrama;
                    $enfermero->save();
                }elseif ($rol==4){
                    $kine=new Kinesiologist();
                    $kine->user_id=$usuario->id;
                    $kine->numero_matricula=$num_matricula;
                    $kine->cod_diagrama=$cod_diagrama;
                    $kine->save();

                }
                elseif ($rol==5){
                    $psi=new Psychologist();
                    $psi->user_id=$usuario->id;
                    $psi->numero_matricula=$num_matricula;
                    $psi->cod_diagrama=$cod_diagrama;
                    $psi->save();

                }elseif ($rol==6){
                    $asis=new SocialAssistant();
                    $asis->user_id=$usuario->id;
                    $asis->numero_matricula=$num_matricula;
                    $asis->cod_diagrama=$cod_diagrama;
                    $asis->save();

                }elseif ($rol==7){
                    $cor=new Coordinator();
                    $cor->user_id=$usuario->id;
                    $cor->save();

                }



            DB::commit();

            return redirect('/prestadores')->with('clase','success')->with('message','Usuario Cargado Correctamente');


        }catch (\Exception $e){
            $success=false;
            $error=$e->getMessage();

            DB::rollback();
           //die($error);
            return redirect('/prestadores')->with('clase','danger')->with('message','Error, Intente nuevamente');
        }

       /*$usuario=new User();
        //admin*/


    }
    
    public function listadoPacientesProvisorios(){


        $episodiosProvisorios=Episode::where('episode_state_id','=',1)->orderBy('id','desc')->paginate(12);


        return view('partials.admin.pacientesProvisorios',['epiosodiosProvisorios'=>$episodiosProvisorios]);
    }

    public function PacientesNoingresados(){
        $episodiosNoIngresados=Episode::where('episode_state_id','=',3)->paginate(12);

        return view('partials.admin.pacientesNoIngresados',['episodiosNoIngresados'=>$episodiosNoIngresados]);
    }

    public function pacientesEpicrisis(){
        $episodiosEpicrisisGenerada=Episode::where('episode_state_id','=',4)->paginate(12);
        $tiposAlta=HighType::all();

        return view('partials.admin.pacientesEpicrisis',['episodiosConEpicrisis'=>$episodiosEpicrisisGenerada,'tiposAlta'=>$tiposAlta]);
    }

    public function pacientesAlta(){
        $altas=HighMedical::orderBy('id','desc')->paginate(12);


        return view('partials.admin.pacientesAlta',['altas'=>$altas]);

    }




    public function listadoAdmin(){
        $admines=User::where('is_admin','=',1)->get();

        $pdf = PDF::loadView('admin.prestadores.admin.pdfAdmin',['admines'=>$admines]);
        return $pdf->stream();
    }

    public function editarIngresos($idepisodio){
        $medicos=Doctor::all();
        $episodio=Episode::findOrFail($idepisodio);
        $asistentes_soc=SocialAssistant::all();
        return view('partials.admin.contenidopacientenoingresado',['episodio'=>$episodio,'medicos'=>$medicos,'asistentes_soc'=>$asistentes_soc]);

    }

    public function updateIngresos(Request $request){
        $episodio=Episode::findOrFail($request->input('episode_id'));

        if($episodio->medicalIncome!=null){
            $medicalIncome=MedicalIncome::findOrFail($request->input('medicalIncome_id'));
            $medicalIncome->doctor_id=$request->input('doctor_id');
            $medicalIncome->fecha=$request->input('fecha_visita_medica');
            $medicalIncome->hora=$request->input('hora_visita_medica');
            $medicalIncome->comentarios=$request->input('comentario');

            $medicalIncome->save();


        }

      if($episodio->psycho_social_income!=null){

            $psychoSoIncome=PsychoSocialIncome::findOrFail($request->input('psychosocialIncome_id'));
            $psychoSoIncome->social_assistant_id=$request->input('asist_social');
            $psychoSoIncome->fecha=$request->input('fecha_visita_asis_social');
            $psychoSoIncome->hora=$request->input('hora_visita_asis_social');
            $psychoSoIncome->comentarios=$request->input('comentario_asis');

            $psychoSoIncome->save();


      }

     return redirect('pacientes/provisorios');


    }




}
