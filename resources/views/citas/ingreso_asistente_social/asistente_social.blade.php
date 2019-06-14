

@extends('layouts.app')
@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading panel-title">Visita Ingreso</div>
        <div class="panel-body">
            <?php

            $idCita=$ingreso_psicosocial->id;

            $fecha=$ingreso_psicosocial->fecha;

            $hora=$ingreso_psicosocial->hora;
            $nombrePaciente=$ingreso_psicosocial->episode->patient->nombre;
            $apellidoPaciente=$ingreso_psicosocial->episode->patient->apellido;


            ?>



            <h4 class="text-center">Visita Ingreso Psicosocial {{$fecha}}</h4>
            <h3 class="text-center">Hora:{{$hora}}</h3>
                <div class="text-center">
                    <h4 style="display: inline" class="text-center">Comentarios: </h4>{{$ingreso_psicosocial->comentarios}}
                </div>

            <h3 class="text-center">Paciente: {{$nombrePaciente}} {{$apellidoPaciente}}</h3>



            @if($ingreso_psicosocial->social_context==null)


                <div class="alert alert-danger">
                    <p class="text-center"><strong>Todavia no se cargo el informe psicosocial correspondiente a la cita</strong>
                </div>
                <div class="text-center">
                    <form method="post" action="/ingresopsicosocial">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$idCita}}" name="cita_id">
                        <input type="hidden" value="{{$nombrePaciente}}" name="nombre_paciente">
                        <input type="hidden" value="{{$apellidoPaciente}}" name="apellido_paciente">
                        <input type="hidden" value="{{$fecha}}" name="fecha_cita">
                        <button class="btn btn-primary">Cargar Informe</button>

                    </form>
                </div>
            @else
                <div class="alert alert-success">
                    <p class="text-center text-capitalize">Informe Ya cargado</p>
                    <p class="text-center"><a href="/pdf/informepsicosocial/{{$ingreso_psicosocial->id}}" class="btn btn-success btn-sm">Ver</a></p>

                </div>

            @endif
            {{-- <p class="text-center"><a href="/evolucionesmedicas/{{$cita->id}}">Cargar Evolucion Medica</a></p>--}}
        </div>

    </div>











@endsection