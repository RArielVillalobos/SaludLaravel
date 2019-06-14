@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading panel-title">Informe de Ingreso Médico</div>
        <div class="panel-body">
            <?php
            $idCita=$cita->id;

            $fecha=$cita->fecha;



            $hora=$cita->hora;
            $nombrePaciente=$cita->episode->patient->nombre;


            $segundoNombre=$cita->episode->patient->segundo_nombre;
            $apellidoPaciente=$cita->episode->patient->apellido;





            ?>
            <h4 class="text-center">Cita para Ingreso Médico {{$fecha}}</h4><h3 class="text-center">Hora:{{$hora}}</h3>

            <h3 class="text-center">Paciente: {{$nombrePaciente}} {{$segundoNombre}} {{$apellidoPaciente}}</h3>
             <div class="text-center">
                 <h4 style="display: inline" class="text-center">Comentarios: </h4>{{$cita->comentarios}}
             </div>
             <br>
            @if($cita->informeMedico==null)
                <div class="alert alert-danger">
                    <p class="text-center">Todavia no se cargo Informe Medico correspondiente a la cita</p>
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
                    <a href="{{route('ingresomedico.cargar',$cita->id)}}" class="btn btn-success">Cargar Informe Medico</a>
                </div>
            @else
                <div class="alert alert-success">
                    <p class="text-center text-capitalize">Informe Medico ya cargado</p>
                    <p class="text text-center"><a class="btn btn-success btn-sm" href="{{route('pdf.informe',$cita->medical_report_id)}}">Ver</a></p>



                </div>

            @endif
            {{-- <p class="text-center"><a href="/cargaringresomedico/{{$cita->id}}">Cargar Evolucion Medica</a></p>--}}




        </div>
    </div>




@endsection

