@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Prorrogas</div>
        <div class="panel-body">
            <table class="table table-responsive">
                <thead>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha Prorroga</th>
                    <th>Prest Médicas</th>
                    <th>Prest Enfermeria</th>
                    <th>Prest Kinesiologia</th>
                    <th>Prest Psicología</th>
                    <th>Informe Méd</th>
                    <th>Autorizar</th>
                    <th>Autorizado</th>
                </thead>

                <tbody>
                    @foreach($prorrogas as $prorroga)
                        <tr>
                            <td>{{$prorroga->medicalIncome->informeMedico->episode->patient->apellido}} {{$prorroga->medicalIncome->informeMedico->episode->patient->nombre}}</td>
                            <td>{{$prorroga->doctor->user->last_name}} {{$prorroga->doctor->user->name}}</td>
                            <td>{{$prorroga->fecha_prorroga}}
                            @if($prorroga->medicalReport==null)
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>No cargado</td>

                            @else
                               <td>{{$prorroga->medicalReport->provision->medical_provision->valor}} por {{$prorroga->medicalReport->provision->medical_provision->tipo}}</td>
                                <td>{{$prorroga->medicalReport->provision->nursing_provision->valor}} por {{$prorroga->medicalReport->provision->nursing_provision->tipo}}</td>
                                <td>{{$prorroga->medicalReport->provision->kinesiology_provision->valor}} por {{$prorroga->medicalReport->provision->kinesiology_provision->tipo}}</td>
                                <td>{{$prorroga->medicalReport->provision->psycology_provision->valor}} por {{$prorroga->medicalReport->provision->psycology_provision->tipo}}</td>
                                <td><a href="pdf/prorroga/{{$prorroga->id}}">Ver</a></td>
                                @if($prorroga->autorizado==null)
                                    <td><button data-prorroga="{{$prorroga->id}}" class="btn btn-success btn-sm">Autorizar</button></td>
                                @else
                                    <td>Ya se informo</td>
                                @endif
                                @if($prorroga->autorizado==null)
                                    <td>en Proceso</td>

                                @elseif($prorroga->autorizado=='si')
                                  <td>Sí</td>

                                @elseif($prorroga->autorizado==='no')
                                    <td>NO</td>


                                @endif



                            @endif

                        </tr>


                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="autorizarProrroga">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Autorizar Prorroga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/autorizarprorroga">
                        {{csrf_field()}}
                        <input type="hidden" name="prorroga_id" value="" id="prorroga">
                        <div class="form-group">
                            <label>Autorizado:</label>
                            <select class="form-control" name="autorizado">
                                <option value="si">SI</option>
                                <option value="no">NO</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Desde:</label>
                            <input type="date" class="form-control" name="desde">
                        </div>
                        <div class="form-group">
                            <label>Hasta:</label>
                            <input type="date" class="form-control" name="hasta">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Autorizar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/autorizarProrroga.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection