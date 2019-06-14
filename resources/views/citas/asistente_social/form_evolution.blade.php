@extends('layouts.app')
@section('content')
    <div class="panel panel-default">


        <div class="panel-heading panel-title">Evolución Asistente Social de la Cita: {{$nombre_paciente}} {{$apellido_paciente}}</div>
        <div class="panel-body">

            <h4 class="text-center">Evolución de la cita: {{$nombre_paciente}} {{$apellido_paciente}} </h4>
            <h4 class="text-center">Fecha de la Cita: {{$fecha_cita}}</h4>
            <br>
            <h3 class="text-center text-primary">Evolucion</h3>
            <form method="post" action="/cargarevolucionasistentesocial">
                {{csrf_field()}}
                <input type="hidden" value="{{$cita_id}}" name="cita_id">
                <input type="hidden" value="{{$fecha_cita}}" name="fecha_cita">
                {{--
                <div class="form-row">
                    <div class="form-group">
                        <label for="ta" class="col-form-label">TA</label>
                        <input type="text" class="form-control" id="ta" name="ta" value="m/mg" placeholder="TA">
                    </div>
                    <div class="form-group">
                        <label for="fr" class="col-form-label">FR</label>
                        <input type="text" class="form-control" id="fr" name="fr" value="x min" placeholder="FR">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="fc" class="col-form-label">FC</label>
                    <input type="text" class="form-control" id="fc" name="fc" value="x min" placeholder="FC">
                </div>
                <div class="form-group">
                    <label for="temp" class="col-form-label">Temp</label>
                    <input type="text" class="form-control" id="temp" name="temp" value="ÂºC" placeholder="Temp">
                </div>
                <div class="form-group">
                    <label for="temp" class="col-form-label">HGT</label>
                    <input type="text" class="form-control" id="temp" name="hgt" value="mg/dl" placeholder="HGT">
                </div>
                <div class="form-group">
                    <label for="temp" class="col-form-label">SPO</label>
                    <input type="text" class="form-control" id="temp" name="spo" value="%" placeholder="SPO">
                </div>
                <div class="form-group">
                    <label for="temp" class="col-form-label">Diuresis</label>
                    <input type="text" class="form-control" id="temp" name="diuresis" value="+" placeholder="Diuresis">
                </div>
                <div class="form-group">
                    <label for="temp" class="col-form-label">Catarsis</label>
                    <input type="text" class="form-control" id="temp" value="+"placeholder="Catarsis" name="catarsis">
                </div>
                <br>
                --}}

                <div class="form-row">
                    <div class="form-group">
                        <label for="City" class="col-form-label">Evolucion</label>
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
