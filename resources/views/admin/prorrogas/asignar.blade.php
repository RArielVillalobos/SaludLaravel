@extends('layouts.app')

@section('content')

<div class="panel panel-primary">

    <div class="panel-heading">Asignar Prorroga</div>
    <div class="panel-body">
        <div class="container-fluid">
            <form method="post" action="/guardarprorroga">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Seleccione Medico</label>

                            <select class="form-control" name="doctor">
                                @foreach($doctores as $doctor)
                                    @if($doctor->user->status_id==1)
                                        <option value="{{$doctor->id}}" class="form-control">{{$doctor->user->last_name}} {{$doctor->user->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Seleccione Paciente Activo</label>
                            <select name="episodio" class="form-control">
                                @foreach($episodiosActivos as $episodio)
                                   <option value="{{$episodio->id}}" name="episodio">{{$episodio->patient->apellido}} {{$episodio->patient->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <label>Fecha</label>
                    <input class="form-control" type="date" name="fecha" value="{{$fechaActual}}">

                </div>

                <p class="text text-center"><button type="submit" class="btn btn-primary">Asignar Prorroga</button></p>
            </form>





        </div>

    </div>

</div>

@endsection
