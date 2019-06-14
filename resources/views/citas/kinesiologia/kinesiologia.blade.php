@extends('layouts.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading panel-title"></div>
        <div class="panel-body">
            <?php

            $idCita=$cita_kinesiologia->cita->id;

            $fecha=$cita_kinesiologia->cita->fecha;

            $hora=$cita_kinesiologia->cita->hora;
            $nombrePaciente=$cita_kinesiologia->cita->episode->patient->nombre;
            $apellidoPaciente=$cita_kinesiologia->cita->episode->patient->apellido;


            ?>



            <h4 class="text-center">Cita Kinesiologia {{$fecha}}</h4>
                <h3 class="text-center">Turno:{{$cita_kinesiologia->KinesiologyDiagram->kinesiology_shift->id}}</h3>
                <h3 class="text-center">Hora:{{$hora}}</h3>

            <h3 class="text-center">Paciente: {{$nombrePaciente}} {{$apellidoPaciente}}</h3>



            @if($cita_kinesiologia->kinesiologistEvolution==null)


                <div class="alert alert-danger">
                    <p class="text-center"><strong>Todavia no se cargo evolucion correspondiente a la cita</strong>
                </div>
                <div class="text-center">
                    <form method="post" action="/evolucioneskinesiologia">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$idCita}}" name="cita_id">
                        <input type="hidden" value="{{$nombrePaciente}}" name="nombre_paciente">
                        <input type="hidden" value="{{$apellidoPaciente}}" name="apellido_paciente">
                        <input type="hidden" value="{{$fecha}}" name="fecha_cita">
                        <button class="btn btn-primary">Cargar Evolucion</button>

                    </form>
                </div>
            @else
                <div class="alert alert-success">
                    <p class="text-center text-capitalize">Evolucion ya cargada</p>
                    <p class="text-center"><a class="btn btn-success btn-sm" href="/pdf/evolucioneskinesiologia/{{$cita_kinesiologia->kinesiologistEvolution->id}}">Ver</a></p>

                </div>

            @endif
            {{-- <p class="text-center"><a href="/evolucionesmedicas/{{$cita->id}}">Cargar Evolucion Medica</a></p>--}}
        </div>

    </div>











@endsection