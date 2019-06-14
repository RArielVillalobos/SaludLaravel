@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-title">Control Ingreso Pacientes</div>


    <br>
    @if($message=\Illuminate\Support\Facades\Session::get('message') && $class=\Illuminate\Support\Facades\Session::get('class'))

        <div class="alert alert-{{$class}}">
            <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>

        </div>
    @endif
    <div class="panel-body">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th scope="col">Episodio</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Obra Social</th>
                    <th scope="col">F.Ing.Provisorio</th>
                    <th scope="col">F.Ing.Medico</th>
                    <th scope="col">F.Activación</th>
                    <th scope="col">Días en Provisorio</th>

                    <th scope="col">Observaciones</th>
                    <th scope="col">Opciones</th>

                </tr>
            </thead>
            <tbody>
            @foreach($episodes as $episode)

                    @if($episode->fecha_activacion)
                    <tr>
                        <td class="bg-success">{{$episode->id}}</td>
                        <td class="bg-success">{{$episode->patient->apellido}} {{$episode->patient->nombre}}</td>
                        <td class="bg-success">{{$episode->SocialWork->nombre}}</td>
                        <td class="bg-success">{{$episode->fecha_ingreso_provisorio}}</td>
                        <td class="bg-success">{{$episode->fecha_ingreso_medico}}</td>
                        <td class="bg-success">{{$episode->fecha_activacion}}</td>

                        <td class="bg-success">{{$episode->diasProvisorio()}}</td>

                        @if($episode->observations->last()==null)
                            <td class="bg-success">No hay observaciones</td>

                        @else
                        <td class="bg-success">{{$episode->observations->last()->observacion}}</td>
                        @endif
                        <td class="bg-success">

                            <a href="#" class="observaciones" data-obser="{{$episode->id}}">
                                <img src="svg/si-glyph-pencil.svg" width="14px">
                            </a>
                            <a href="#" class="historial-obs" data-history="{{$episode->id}}">
                                <img src="svg/si-glyph-note.svg" width="14px">
                            </a>


                        </td>
                    </tr>
                    @else
                        <tr>
                            <td class="bg-danger">{{$episode->id}}</td>
                            <td class="bg-danger">{{$episode->patient->apellido}} {{$episode->patient->nombre}}</td>
                            <td class="bg-danger">{{$episode->SocialWork->nombre}}</td>
                            <td class="bg-danger">{{$episode->fecha_ingreso_provisorio}}</td>
                            <td class="bg-danger">{{$episode->fecha_ingreso_medico}}</td>
                            <td class="bg-danger">{{$episode->fecha_activacion}}</td>

                            <td class="bg-danger">{{$episode->diasProvisorio()}}</td>
                            @if($episode->observations->last()==null)
                                <td class="bg-danger">No hay observaciones</td>
                               {{-- --}}

                            @else
                                <td class="bg-danger">{{$episode->observations->last()->observacion}}</td>
                            @endif



                            <td class="bg-danger">

                                <a href="#" class="observaciones" data-obser="{{$episode->id}}">
                                    <img src="svg/si-glyph-pencil.svg" width="14px">
                                </a>
                                <a href="#" class="historial" data-history="{{$episode->id}}">
                                    <img src="svg/si-glyph-note.svg" width="14px">
                                </a>


                            </td>
                        </tr>


                    @endif


            @endforeach

            </tbody>

        </table>
    </div>


<div class="modal" tabindex="-1" role="dialog" id="modalAddObsr">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Observacion al episodio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarobservacion">
                    {{csrf_field()}}
                    <input type="hidden" name="episode_id" value="" id="episode">
                    <div class="form-group">
                        <label>Observacion:</label>
                        <textarea class="form-control" name="observacion"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalHistoryObs">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial de Observaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                    <div class="form-group">
                        <label>Observaciones:</label>
                        <div class="containerobs">




                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>



            </div>

        </div>
    </div>
</div>
</div>
@endsection
@section('script')
    <script src="/js/home.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
@endsection

