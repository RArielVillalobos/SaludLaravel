@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-title">Evolucion de Cita Médica</div>
    <div class="panel-body">
            <?php
            $idCita=$cita->id;

            $fecha=$cita->citaMedica->fecha;
            $hora=$cita->citaMedica->hora;
            $nombrePaciente=$cita->citaMedica->episode->patient->nombre;
            $segundoNombre=$cita->citaMedica->episode->patient->segundo_nombre;
            $apellidoPaciente=$cita->citaMedica->episode->patient->apellido;

      
           ?>
          <h4 class="text-center">Cita para Evolución Médica {{$fecha}}</h4><h3 class="text text-center">Turno: {{$cita->medicalDiagram->medical_shift->id}}</h3><h4 class="text-center">Hora:{{$hora}}</h4>
      
          <h3 class="text-center">Paciente: {{$nombrePaciente}} {{$segundoNombre}} {{$apellidoPaciente}}</h3>
           @if($cita->medicalEvolution==null)
               <div class="alert alert-danger">
                   <p class="text-center">Todavia no se cargo evolucion correspondiente a la cita</p>
               </div>
                   <div class="text-center">
                       {{--  <form method="post" action="/evolucionesmedicas">
                           {{csrf_field()}}
                           <input type="hidden" value="{{$idCita}}" name="cita_evolution_medical_id">
                           <input type="hidden" value="{{$nombrePaciente}}" name="nombre_paciente">
                           <input type="hidden" value="{{$apellidoPaciente}}" name="apellido_paciente">
                           <input type="hidden" value="{{$fecha}}" name="fecha_cita">
                           <button class="btn  btn-success">Cargar Evolucion</button>
      
                       </form>--}}
                       <a href="{{route('citamedica.evolution',$cita->id)}}" class="btn btn-success">Cargar Evolución</a>
                   </div>
           @else
               <div class="alert alert-success">
                   <p class="text-center text-capitalize">Evolucion ya cargada</p>
                   <p class="text text-center"><a class="btn btn-success btn-sm" href="{{route('pdf.evolucionmedica',$cita->medicalEvolution->id)}}">Ver</a></p>



               </div>
      
           @endif
         {{-- <p class="text-center"><a href="/evolucionesmedicas/{{$cita->id}}">Cargar Evolucion Medica</a></p>--}}
      
      
        

    </div>    
</div>    




@endsection


