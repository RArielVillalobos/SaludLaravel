@extends('layouts.app')
@section('content')
    @php
      $citaPsicologia=\App\CitaPsicologia::find($cita_id);

    @endphp

    <div class="panel panel-default">


        <div class="panel-heading panel-title">Evolucion de la Visita: {{$nombre_paciente}} {{$apellido_paciente}}</div>
        <div class="panel-body">

            <h4 class="text-center">Paciente: {{$nombre_paciente}} {{$apellido_paciente}} </h4>
            <h4 class="text-center">Fecha de la Cita: {{$fecha_cita}}</h4>
            <h4 class="text-center">Turno de la Cita: {{$citaPsicologia->PsychologyDiagram->psychology_shift->id}}</h4>
            <h4 class="text-center">Hora de la Visita: {{$citaPsicologia->cita->hora}}</h4>

            <br>

            <form method="post" action="/cargarevolucionpsicologia">
                {{csrf_field()}}
                <input type="hidden" value="{{$cita_id}}" name="cita_id">
                <input type="hidden" value="{{$fecha_cita}}" name="fecha_cita">
                <div class="form-row">
                    <div class="form-group">
                        <label for="City" class="col-form-label">Evolución</label>
                        <textarea class="form-control" name="evolucion" rows="4"></textarea>
                    </div>


                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cargar</button>
                </div>
            </form>
        </div>

    </div>





@endsection
