
@extends('layouts.app')
@section('content')

    <form method="post" action="guardarcitaenfermeria">
        {{csrf_field()}}
        <div class="form-row">
            <h3 class="text-center">Cita Enfermeria</h3>
            <div class="form-group col-md-2">
                <label for="medico">Seleccione Enfermero</label>
                <select id="medico" name="nurse_id" class="form-control">
                    <?php $enfermeros=\App\Nurse::all();?>
                    @foreach($enfermeros as $enfermero)
                        <option value="{{$enfermero->id}}"selected>{{$enfermero->user->last_name}} {{$enfermero->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="medico">Seleccione Paciente</label>
                <select id="medico" class="form-control" name="episodio_id">
                    <?php $episodiosActivos=\App\Episode::all()->where('estado','=',1)?>;
                    @foreach($episodiosActivos as $episodio)
                        <option selected value="{{$episodio->id}}">{{$episodio->patient->apellido}} {{$episodio->patient->nombres}} </option>
                    @endforeach
                </select>

            </div>

            <div class="form-group col-md-3">
                <label>Seleccione Día de la Visita</label>
                <input type="date" name="fecha_cita" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Seleccione fecha de la Visita</label>
                <input type="time" name="hora_cita" class="form-control">
            </div>
            <br>
            <div class="form-group col-md-3">
                <button type="submit" name="enviar" class="btn btn-primary">Generar Cita</button>
            </div>




        </div>
    </form>

@endsection

@section('script')



    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


@endsection