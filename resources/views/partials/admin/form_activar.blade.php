@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading panel-title">Activar Episodio</div>
        <div class="panel-body">
            <h4>Listado de Pacientes Provisorios</h4>
            <br>
            <table class="table table-bordered">
                <thead>
                    <th>Nombre y Apellido</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($episodiosProv as $episodio)
                        <tr>
                            <td>{{$episodio->patient->apellido}} {{$episodio->patient->segundo_nombre}} {{$episodio->patient->nombre}}</td>
                            <td><button  data-epi="{{$episodio->id}}" class="btn btn-success btn-sm">Activar</button></td>
                        </tr>


                    @endforeach
                </tbody>

            </table>


        </div>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="activarEpi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activar Episodio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/activarepi">
                        {{csrf_field()}}
                        <input type="hidden" name="episode_id" value="" id="episode">
                        <div class="form-group">
                            <label>Desde:</label>
                            <input type="date" class="form-control" name="desde">
                        </div>
                        <div class="form-group">
                            <label>Hasta:</label>
                            <input type="date" class="form-control" name="hasta">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Activar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="/js/activarEpi.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection