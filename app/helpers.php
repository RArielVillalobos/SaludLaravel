<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 16/05/2018
 * Time: 0:05
 */
function obtenerIntervaloArregloFechaDadaysumadeSemanas($fecha,$cantSemanas){
    //en formato Y-m-d ('2018-04-30');
    $date = new DateTime($fecha);
    $fechaFormateada=$date->format('Y-m-d');
    //sumo la cantidad de semanas requeridas
    $fechaNueva=date("Y-m-d",strtotime($fechaFormateada."+ $cantSemanas week"));
    //va a tirar la nueva fecha, con un dia de mas
    $fecha1=$fecha;
    $fecha2=$fechaNueva;
    $arregloFechas=[];

    for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
        $arregloFechas[]=$i;
        //aca puedes comparar $i a una fecha en la bd y guardar el resultado en un arreglo

    }

    array_pop($arregloFechas);

    return array_chunk($arregloFechas,7);


}
function semanax($semanax,$diaCita){
    $Doctor='si';

    foreach($semanax as $fecha){

        if($diaCita==$fecha && $Doctor=='si'){

            $Doctor='no';
            $encontrado=true;

        }
        if(!isset($encontrado)){
            $encontrado='-';

        }

    }
    return $encontrado;
}

function primerdiaSemanax($semanax){
    $primerDiaSemana=$semanax[0];
    return $primerDiaSemana;

}
//$primerDiaSemana1=$semana1[0];

function ultimodiaSemanax($semana){
    $ultimoDiaSemana=array_pop($semana);
    return $ultimoDiaSemana;
}

function obtenerCitaKineDia($mes,$anio,$dia,$idEpi){
    $citaKine=\App\CitasKinesiologia::join("citas","citas_kinesiologias.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')

        ->select('citas_kinesiologias.id','citas_kinesiologias.kinesiologist_id','citas.id')
        ->where('episodes.id','=',$idEpi)
        ->whereDay('citas.fecha','=',$dia)
        ->whereYear('citas.fecha','=',$anio)
       ->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaKine['id'];

    return $id;

}
function obtenerCitaEnfDiaTurno($mes,$anio,$dia,$idEpi,$turno){
    $citaEnf=\App\CitaEnfermeria::join("citas","citas_enfermeria.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')

        ->select('citas_enfermeria.id','citas_enfermeria.nurse_id','citas.id')
        ->where('episodes.id','=',$idEpi)
        ->where('citas_enfermeria.turno','=',$turno)
        ->whereDay('citas.fecha','=',$dia)
        ->whereYear('citas.fecha','=',$anio)
        ->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaEnf['id'];

    return $id;

}
function obtenerCitaEnFDiaTurnoNew($mes,$anio,$dia,$idEpi,$turno){
    $citaEnf=\App\CitaEnfermeria::join("citas","citas_enfermeria.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')
        ->join('nursing_diagrams','citas_enfermeria.nursing_diagram_id','=','nursing_diagrams.id')
        ->join('nursing_shifts','nursing_diagrams.nursing_shift_id','=','nursing_shifts.id')


        ->select('citas_enfermeria.id','citas_enfermeria.nurse_id','citas.id')
        ->where('nursing_diagrams.episode_id','=',$idEpi)
        ->where('nursing_diagrams.nursing_shift_id','=',$turno)

        ->where('nursing_diagrams.mes','=',$mes)
        ->where('nursing_diagrams.anio','=',$anio)
        ->whereDay('citas.fecha','=',$dia)
        ->whereMonth('citas.fecha','=',$mes)
        ->whereYear('citas.fecha','=',$anio)->get()->last();
        //->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaEnf['id'];

    return $id;

}

//busca la cita de enfermeria para validar que no se vuelva a cargar y subscribir()
//validador
function buscacitaEnfermeria($nursing_diagrama,$fecha){
    $encontrado=false;

    $citaEnfermeria=\App\CitaEnfermeria::join("citas","citas_enfermeria.id","=","citas.id")
        ->join('nursing_diagrams','nursing_diagram_id','=','nursing_diagrams.id')
        ->select('citas_enfermeria.id')
        ->where('citas.fecha','=',$fecha)
        ->where('citas_enfermeria.nursing_diagram_id','=',$nursing_diagrama)->get()->last();
    if($citaEnfermeria!=null){
        $encontrado=true;
    }

    //$id=$citaEnfermeria['id'];
    return $encontrado;

}
//medico
//busca la cita medica
function obtenerCitaMedDiaTurnoNew($mes,$anio,$dia,$idEpi,$turno){
    $citaMedica=\App\CitaEvolutionMedical::join("cita_medicas","cita_evolution_medicals.id","=","cita_medicas.id")
        ->join('episodes','cita_medicas.episode_id','=','episodes.id')
        ->join('medical_diagrams','cita_evolution_medicals.medical_diagram_id','=','medical_diagrams.id')
        ->join('medical_shifts','medical_diagrams.medical_shift_id','=','medical_shifts.id')


        ->select('cita_evolution_medicals.id','cita_evolution_medicals.doctor_id','cita_medicas.id')
        ->where('medical_diagrams.episode_id','=',$idEpi)
        ->where('medical_diagrams.medical_shift_id','=',$turno)

        ->where('medical_diagrams.mes','=',$mes)
        ->where('medical_diagrams.anio','=',$anio)
        ->whereDay('cita_medicas.fecha','=',$dia)
        ->whereMonth('cita_medicas.fecha','=',$mes)
        ->whereYear('cita_medicas.fecha','=',$anio)->get()->last();
    //->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaMedica['id'];

    return $id;

}


//busca que el paciente no tenga asignado el mismo turno
function buscaTurnoMedico($turno,$epi,$mes,$anio){

    $encontrado=false;

    $diagramaMedico=\App\MedicalDiagram::where('episode_id','=',$epi)->where('medical_shift_id','=',$turno)->where('mes','=',$mes)->where('anio','=',$anio)->get()->last();

    if($diagramaMedico!=null){
        $encontrado=true;
    }
    return $encontrado;


}

//psicologia
function obtenerCitaPsiDiaTurnoNew($mes,$anio,$dia,$idEpi,$turno){
    $citaPsi=\App\CitaPsicologia::join("citas","citas_psicologia.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')
        ->join('psychology_diagrams','citas_psicologia.psychology_diagram_id','=','psychology_diagrams.id')
        ->join('psychology_shifts','psychology_diagrams.psychology_shift_id','=','psychology_shifts.id')


        ->select('citas_psicologia.id','citas_psicologia.psychologist_id','citas.id')
        ->where('psychology_diagrams.episode_id','=',$idEpi)
        ->where('psychology_diagrams.psychology_shift_id','=',$turno)

        ->where('psychology_diagrams.mes','=',$mes)
        ->where('psychology_diagrams.anio','=',$anio)
        ->whereDay('citas.fecha','=',$dia)
        ->whereMonth('citas.fecha','=',$mes)
        ->whereYear('citas.fecha','=',$anio)->get()->last();
    //->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaPsi['id'];

    return $id;

}

function obtenerCitaAsisSocialDiaTurnoNew($mes,$anio,$dia,$idEpi,$turno){
    $citaAsis=\App\CitasAsistenteSocial::join("citas","citas_asistente_socials.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')
        ->join('social_assistant_diagrams','citas_asistente_socials.social_assistant_diagram_id','=','social_assistant_diagrams.id')
        ->join('social_assistant_shifts','social_assistant_diagrams.social_assistant_shift_id','=','social_assistant_shifts.id')


        ->select('citas_asistente_socials.id','citas_asistente_socials.social_assistant_id','citas.id')
        ->where('social_assistant_diagrams.episode_id','=',$idEpi)
        ->where('social_assistant_diagrams.social_assistant_shift_id','=',$turno)

        ->where('social_assistant_diagrams.mes','=',$mes)
        ->where('social_assistant_diagrams.anio','=',$anio)
        ->whereDay('citas.fecha','=',$dia)
        ->whereMonth('citas.fecha','=',$mes)
        ->whereYear('citas.fecha','=',$anio)->get()->last();
    //->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaAsis['id'];

    return $id;

}

//busca que el paciente no tenga asignado el mismo turno psicologia
function buscaTurnoPsicologia($turno,$epi,$mes,$anio){

    $encontrado=false;

    $diagramaPsicologia=\App\PsychologyDiagram::where('episode_id','=',$epi)->where('psychology_shift_id','=',$turno)->where('mes','=',$mes)->where('anio','=',$anio)->get()->last();

    if($diagramaPsicologia!=null){
        $encontrado=true;
    }
    return $encontrado;


}

function buscaTurnoAsisSocial($turno,$epi,$mes,$anio){

    $encontrado=false;

    $diagramaAsis=\App\SocialAssistantDiagram::where('episode_id','=',$epi)->where('social_assistant_shift_id','=',$turno)->where('mes','=',$mes)->where('anio','=',$anio)->get()->last();

    if($diagramaAsis!=null){
        $encontrado=true;
    }
    return $encontrado;


}

//kinesiologia

function obtenerCitaKineDiaTurnoNew($mes,$anio,$dia,$idEpi,$turno){
    $citaKine=\App\CitasKinesiologia::join("citas","citas_kinesiologias.id","=","citas.id")
        ->join('episodes','citas.episode_id','=','episodes.id')
        ->join('kinesiology_diagrams','citas_kinesiologias.kinesiology_diagram_id','=','kinesiology_diagrams.id')
        ->join('kinesiology_shifts','kinesiology_diagrams.kinesiology_shift_id','=','kinesiology_shifts.id')


        ->select('citas_kinesiologias.id','citas_kinesiologias.kinesiologist_id','citas.id')
        ->where('kinesiology_diagrams.episode_id','=',$idEpi)
        ->where('kinesiology_diagrams.kinesiology_shift_id','=',$turno)

        ->where('kinesiology_diagrams.mes','=',$mes)
        ->where('kinesiology_diagrams.anio','=',$anio)
        ->whereDay('citas.fecha','=',$dia)
        ->whereMonth('citas.fecha','=',$mes)
        ->whereYear('citas.fecha','=',$anio)->get()->last();
    //->whereMonth('citas.fecha','=',$mes)->get()->last();

    $id=$citaKine['id'];

    return $id;

}

//busca que el paciente no tenga asignado el mismo turno kinesiologia
function buscaTurnoKinesiologia($turno,$epi,$mes,$anio){

    $encontrado=false;

    $diagramaKine=\App\KinesiologyDiagram::where('episode_id','=',$epi)->where('kinesiology_shift_id','=',$turno)->where('mes','=',$mes)->where('anio','=',$anio)->get()->last();

    if($diagramaKine!=null){
        $encontrado=true;
    }
    return $encontrado;


}



//busca que el paciente no tenga asignado el mismo turno enfermeria
function buscaTurnoEnfermeria($turno,$epi,$mes,$anio){

    $encontrado=false;

    $diagramaEnf=\App\NursingDiagram::where('episode_id','=',$epi)->where('nursing_shift_id','=',$turno)->where('mes','=',$mes)->where('anio','=',$anio)->get()->last();

    if($diagramaEnf!=null){
        $encontrado=true;
    }
    return $encontrado;


}




function cambiarNombreInglesAEspa($nombre){
    if($nombre=='Monday'){
        $convertido='Lunes';
    }elseif ($nombre=='Tuesday'){
        $convertido='Martes';
    }
    elseif($nombre=='Wednesday'){
        $convertido='Miercoles';
    }
    elseif ($nombre=='Thursday'){
        $convertido='Jueves';
    }elseif ($nombre=='Friday'){
        $convertido='Viernes';
    }elseif ($nombre=='Saturday'){
        $convertido='Sabado';
    }elseif ($nombre=='Sunday'){
        $convertido='Domingo';
    }

    return $convertido;

}

function convertirNombreDiaEnf($nombre){
    if($nombre=='Monday'){
        $convertido='L';
    }elseif ($nombre=='Tuesday'){
        $convertido='M';
    }
    elseif($nombre=='Wednesday'){
        $convertido='M';
    }
    elseif ($nombre=='Thursday'){
        $convertido='J';
    }elseif ($nombre=='Friday'){
        $convertido='V';
    }elseif ($nombre=='Saturday'){
        $convertido='S';
    }elseif ($nombre=='Sunday'){
        $convertido='D';
    }

    return $convertido;

}
