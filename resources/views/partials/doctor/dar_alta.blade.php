@extends('layouts.app')

@section('content')
    @php
        $carbon=\Carbon\Carbon::now();

        $fecha=$carbon->format('Y-m-d');
        $hora=$carbon->format('H:i:s');




    @endphp
    <div class="panel panel-primary">
        <div class="panel-heading panel-title">Generar  Epicrisis a: {{$episode->patient->apellido}} {{$episode->patient->segundo_nombre}} {{$episode->patient->nombre}}</div>
        <div class="panel-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="get" action="{{route('store.epicrisis')}}">
                <input type="hidden" value="{{$episode->id}}" name="episode_id">
                {{csrf_field()}}
                {{--
                <div class="form-group form-group-sm">
                    <label>Tipo Alta:</label>
                    <select class="form-control">
                        <option>Alta por Fallecimiento</option>
                        <option>Alta Médica</option>
                        <option>Alta Voluntaria</option>
                        <option>Alta por Internación Nosocomial</option>
                        <option>Alta por Traslado a otra Sucursal</option>
                    </select>
                </div>--}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha Epicrisis</label>
                            <input class="form-control" type="date" name="fecha_epicrisis" value="{{$fecha}}">

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label>hora Epicrisis</label>
                            <input class="form-control" type="time" name="hora_epicrisis" value="{{$hora}}">

                        </div>
                    </div>

                </div>
                <p class="text-center"><label >Motivo Egreso</label></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Por Alta Internacion:</label>
                            <select class="form-control" name="alta_internacion">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            </select>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Por Fallecimiento:</label>
                            <select class="form-control" name="fallecimiento">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            </select>

                        </div>


                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Por Derivación a Internación Nosocomial:</label>
                            <select class="form-control" name="int_nosocomial" id="derivacion">
                                <option value="no" selected>No</option>
                                <option value="si">Si</option>
                            </select>

                        </div>

                    </div>

                </div>
                <div class="row" id="opciones_derivacion" style="display: none">
                    <div class="col-md-4">
                        <label>Institución:</label>
                        <div class="form-group">
                            <input class="form-control" name="institucion" value="{{old('institucion')}}">

                        </div>

                    </div>
                    <div class="col-md-8">
                        <label>Causa Derivación:</label>
                        <div class="form-group">
                            <textarea class="form-control" name="causa_derivacion">{{old('causa_derivacion')}}</textarea>

                        </div>

                    </div>

                </div>


                {{--
                <div class="form-group form-group-sm">
                    <label>Alta Medica</label>
                    <input type="checkbox" id="medica" value="medica" name="medica">
                    <br>
                    <label>Alta Administrativa</label>
                    <input type="checkbox" id="admistrativa" value="medica" name="administrativa">

                </div>

                <div class="form-group">
                    <label>Consentimiento Informado?</label>
                    <input type="checkbox" name="consentimientoinf" value="si">
                </div>--}}

                <div class="form-group">
                    <label>Diagnostico de Egreso:</label>
                    <textarea class="form-control" name="diagnostico_egreso">{{old('diagnostico_egreso')}}</textarea>
                </div>
                <div class="form-group">
                    <label>Epicrisis:</label>
                    <textarea class="form-control" name="epicrisis">{{old('epicrisis')}}</textarea>
                </div>
                <div class="form-group">
                    <label>Observaciones:</label>
                    <textarea class="form-control" name="observaciones">{{old('observaciones')}}</textarea>
                </div>


                <button type="submit" class="btn btn-primary">Generar Epicrisis</button>
            </form>

        </div>


    </div>


@endsection
@section('script')
    <script src="/js/estadoPacientes/epicrisis.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection
