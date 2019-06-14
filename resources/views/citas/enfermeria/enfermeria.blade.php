@extends('layouts.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading panel-title"></div>
        <div class="panel-body">
            <?php

            $idCita=$cita_enfermerias->cita->id;

            $fecha=$cita_enfermerias->cita->fecha;

            $hora=$cita_enfermerias->cita->hora;
            $nombrePaciente=$cita_enfermerias->cita->episode->patient->nombre;
            $apellidoPaciente=$cita_enfermerias->cita->episode->patient->apellido;


            ?>



            <h4 class="text-center">Cita Enfermeria {{$fecha}}</h4>
                <h3 class="text-center">Hora:{{$hora}}</h3>

                <h3 class="text text-center">Turno:
                    @if($cita_enfermerias->nursing_diagram->nursing_shift->nombre=='maniana')
                        Mañana
                    @else
                        {{$cita_enfermerias->nursing_diagram->nursing_shift->nombre}}

                    @endif</h3>

                <h4 class="text text-center">{{$cita_enfermerias->nursing_diagram->nursing_shift->hora_desde}}--{{$cita_enfermerias->nursing_diagram->nursing_shift->hora_hasta}}</h4>

            <h3 class="text-center">Paciente: {{$nombrePaciente}} {{$apellidoPaciente}}</h3>



            @if($cita_enfermerias->nurseEvolution==null)


                <div class="alert alert-danger">
                    <p class="text-center"><strong>Todavia no se cargo evolucion correspondiente a la cita</strong>
                </div>
                <div class="text-center">
                    <form method="post" action="/evolucionesenfermeria">
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
                    <p class="text-center"><a class="btn btn-success btn-sm" href="/pdf/evolucionesenfermeria/{{$cita_enfermerias->nurseEvolution->id}}">Ver</a></p>
                </div>

            @endif
            {{-- <p class="text-center"><a href="/evolucionesmedicas/{{$cita->id}}">Cargar Evolucion Medica</a></p>--}}
        </div>

    </div>











@endsection