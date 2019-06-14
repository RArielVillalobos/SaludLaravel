@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Pacientes Con Epicrisis Generada</div>
        <div class="panel-body">
            @php $mensaje=\Illuminate\Support\Facades\Session::get('message'); $clase=\Illuminate\Support\Facades\Session::get('clase')  @endphp
            @if($mensaje)

                <div class="alert alert-{{$clase}}">
                    <div>
                        {{$mensaje}}
                    </div>

                </div>


            @endif
            <table  class="table table-sm table-responsive">
                <thead>
                <tr>
                    <th>Nombre Paciente</th>
                    <th>Id Episodio</th>
                    <th>Epicrisis</th>
                    <th>Dar Alta(deja de ser episodio activo)</th>
                </tr>

                </thead>
                <tbody>
                  @foreach($episodiosConEpicrisis as $episodio)
                   <tr>
                       <td>{{$episodio->patient->apellido}} {{$episodio->patient->nombre}} {{$episodio->patient->segundo_nombre}}</td>
                       <td>{{$episodio->id}}</td>
                       <td><a href="/pdf/epicrisis/{{$episodio->epicrisis->id}}" class="btn btn-info btn-sm">Ver</a></td>
                       <td>
                           <a  href="#" data-epicrisis="{{$episodio->epicrisis->id}}" data-episodio="{{$episodio->id}}" data-patient="{{$episodio->patient}}" class="btn btn-success btn-sm">Dar Alta</a>
                           <a href="/evoluciones/{{$episodio->id}}" class="btn btn-warning btn-sm">Ver Evolucion</a>

                       </td>
                   </tr>
                  @endforeach
                </tbody>

            </table>

        </div>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="darAlta">
        @php $fechaActual=\Carbon\Carbon::now(); $fecha=$fechaActual->format('Y-m-d'); $hora=$fechaActual->format('H:i:s'); @endphp
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Esta Seguro que desea dar de Alta?</h5>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong style="display: inline">Nombre Paciente: </strong><p style="display: inline" id="nombrePaciente"></p>
                    <p style="display: inline" id="apellidoPaciente"></p>
                    <br>
                    <form method="post" action="/pacientes/daralta">
                        {{csrf_field()}}


                        <input type="hidden" name="epicrisis_id" value="" id="epicrisis_id">
                        <input type="hidden" name="episode_id"  id="episode_id" value="">
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Alta:</label>
                                    <div>
                                        <input type="date" class="form-control" name="fecha_alta" value="{{$fecha}}">

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Hora Alta:</label>
                                    <div>
                                        <input type="time" class="form-control" name="hora_alta" value="{{$hora}}">

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Tipo de Alta:</label>
                                    <select class="form-control" name="tipo_alta_id">
                                        @foreach($tiposAlta as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                        </div>



                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Dar Alta</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/estadoPacientes/darAlta.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection