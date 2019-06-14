@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Editar Ingreso Médico</div>

    <div class="panel-body">
        @php $mensaje=\Illuminate\Support\Facades\Session::get('message'); $clase=\Illuminate\Support\Facades\Session::get('clase')  @endphp
        @if($mensaje)

            <div class="alert alert-{{$clase}}">
                <div>
                    {{$mensaje}}
                </div>

            </div>


        @endif
        <table class="table table-sm">
            <thead>
                <th>Nombre y Ap</th>
                <th>Id Ep</th>
                <th>Fecha Prevista para Ingreso Médico</th>
                <th>Hora Prevista para Ingreso Médico</th>
                <th>Médico que realizara</th>
                <th>Opciones</th>

            </thead>
                @foreach($visitas_medicas as $visita)
                <tr>
                    @if($visita->ingresoMedico==null)
                        <td>{{$visita->episode->patient->apellido}} {{$visita->episode->patient->nombre}}</td>
                        <td>{{$visita->episode->id}}</td>
                        <td>{{$visita->fecha}}</td>
                        <td>{{$visita->hora}}</td>
                        <td>{{$visita->doctor->user->last_name}} {{$visita->doctor->user->name}}</td>
                        <td><a class="btn btn-success btn-sm" data-visita_id="{{$visita->id}}" data-visita="{{$visita}}">Editar</a></td>



                    @endif
                </tr>
                @endforeach
            </table>

    </div>




</div>
@endsection

<div class="modal" tabindex="-1" role="dialog" id="editarVisitaIng">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Visita de Ingreso Médico</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="/ingresosmedicos/update">
                    {{csrf_field()}}


                    <input type="hidden" name="cita_id" value="" id="cita_id">


                    <strong style="display: inline">Nombre Paciente: </strong><p style="display: inline" id="nombre"></p>
                    <p style="display: inline" id="apellidoPaciente"></p>
                    <br>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Visita:</label>
                                <div>
                                    <input type="date" class="form-control" name="fecha_visita" id="fecha_visita" value="">

                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hora Visita:</label>
                                <div>
                                    <input type="time" class="form-control" name="hora_visita" value="" id="hora_visita">

                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seleccione Médico</label>
                                <select name="doctor_id" class="form-control">
                                    @foreach($medicos as $doctor)
                                        @if($doctor->user->status_id==1)
                                            <option value="{{$doctor->id}}">{{$doctor->user->last_name}} {{$doctor->user->name}}</option>




                                        @endif

                                    @endforeach
                                </select>
                            </div>



                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>



@section('script')
    <script src="/js/ingresoMed/editar.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection