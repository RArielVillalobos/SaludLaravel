@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Pacientes de Alta</div>


        <div>

        </div>
        <div class="panel-body">

            <table class="table table-sm table-responsive">
                <thead>
                <tr>

                    <th style="font-size: 13px">Nombre.</th>
                    <th style="font-size: 13px">Id Ep.</th>

                    <th style="font-size: 13px">Fecha Alta</th>
                    <th style="font-size: 13px">Hora Alta</th>
                    <th style="font-size: 13px">Tipo Alta</th>
                    <th style="font-size: 13px" >Epicrisis</th>
                    <td style="font-size: 13px">Evolucion</td>




                </tr>
                </thead>
                <tbody>
                @foreach($altas as $alta)


                    <tr>
                        <td style="font-size: 13px">{{$alta->epicrisis->episode->patient->apellido}} {{$alta->epicrisis->episode->patient->nombre}}  {{$alta->epicrisis->episode->patient->segundo_nombre}}  </td>
                        <td style="font-size: 13px">{{$alta->epicrisis->episode->id}} </td>
                        <td style="font-size: 13px">{{$alta->fecha_alta}}</td>

                        <td style="font-size: 13px">{{$alta->hora_alta}}</td>
                        <td style="font-size: 13px">{{$alta->tipo_alta->nombre}}</td>
                        <td style="font-size: 13px">
                            <a href="/pdf/epicrisis/{{$alta->epicrisis->id}}">Ver</a>
                        </td>
                        <td style="font-size: 13px">
                            <a href="/evoluciones/{{$alta->epicrisis->episode->id}}">Ver Evolución</a>
                        </td>



                    </tr>

                @endforeach
                </tbody>

            </table>
            {{$altas->links()}}

        </div>

    </div>

@endsection
