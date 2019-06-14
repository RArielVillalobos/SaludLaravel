@extends('layouts.app')
@section('content')

<div class="panel panel-primary">
    <div class="panel-heading panel-title">Pacientes Asignados</div>
    <div class="panel-body">
        @php $mensaje=\Illuminate\Support\Facades\Session::get('message'); $clase=\Illuminate\Support\Facades\Session::get('clase')  @endphp
        @if($mensaje)

            <div class="alert alert-{{$clase}}">
                <div>
                    {{$mensaje}}
                </div>

            </div>


        @endif

        <table border="1px" class="table table-bordered">
            <tr>
                <th>Nombre y Apellido</th>
                <th>Id Episodio</th>
                <th>Opciones</th>

                {{-- <th>Numero de Afiliado</th>
                <th>Dni</th>
                <th>Fecha Nacimiento</th>
                <th>Opciones</th>--}}
            </tr>


            @foreach($episode as $e)

                @if($e->fecha_ingreso_medico!=null )

                    <tr>
                        <td>
                            {{$e->patient->nombre}} {{$e->patient->apellido}}

                        </td>
                        <td>
                            {{$e->id}}
                        </td>
                        {{--
                        <td>
                            {{$e->patient->numero_afiliado_obra}}
                        </td>
                        <td>
                            {{$e->patient->dni}}
                        </td>
                        <td>
                            {{$e->patient->fecha_nacimiento}}
                        </td>--}}
                        <td><a class="btn btn-info btn-sm" href="evoluciones/{{$e->id}}">Ver Evolución</a> <a class="btn btn-primary btn-sm" href="/generarepicrisis/{{$e->id}}">GenerarEpicrsis</a> </td>

                    </tr>
                @endif


            @endforeach
        </table>
    </div>

</div>




@endsection