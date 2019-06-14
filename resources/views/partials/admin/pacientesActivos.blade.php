@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Pacientes Activos</div>
    <div class="panel-body">
        <table class="table table-sm">
            <thead>
                <th>Nombre y Apellido</th>
                <th>Id Episodio</th>
                <th>Evolución</th>
            </thead>
            <tbody>
                @foreach($episodiosActivos as $episodio)
                    <tr>
                        <td>{{$episodio->patient->apellido }} {{$episodio->patient->nombre}} {{$episodio->patient->segundo_nombre}}</td>
                        <td>{{$episodio->id}}</td>
                        <td><a href="/evoluciones/{{$episodio->id}}">Ver</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection

