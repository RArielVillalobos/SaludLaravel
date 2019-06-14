@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Pacientes No-Ingresados</div>


        <div>

        </div>
        <div class="panel-body">
            <table class="table table-sm table-responsive">
                <thead>
                <tr>

                    <th style="font-size: 13px">Nombre.</th>
                    <th style="font-size: 13px">Id Ep.</th>
                    <th style="font-size: 13px">Ingeso Méd.Realizado el</th>
                    <th style="font-size: 13px">Fecha No Ingreso</th>
                    <th style="font-size: 13px">Motivo No ingreso</th>
                    <th style="font-size: 13px" >Obs</th>
                    <th style="font-size: 13px">Evol.</th>



                </tr>
                </thead>
                <tbody>
                @foreach($episodiosNoIngresados as $episodio)
                    @php
                        $medicalIncome=\App\MedicalIncome::join("medical_reports","medical_incomes.medical_report_id","=","medical_reports.id")
                         ->join('episodes','medical_reports.episode_id','=','episodes.id')
                        ->where('episodes.id','=',$episodio->id)->get()->first();

                    @endphp
                    <tr>
                        <td style="font-size: 13px">{{$episodio->patient->apellido}} {{$episodio->patient->nombre}} {{$episodio->patient->segundo_nombre}} </td>
                        <td style="font-size: 13px">{{$episodio->id}}</td>
                        <td style="font-size: 13px">@if($episodio->no_ingreso->fecha_ingreso_medico){{$episodio->no_ingreso->fecha_ingreso_medico}}@else No se realizó@endif</td>

                        <td style="font-size: 13px">{{$episodio->no_ingreso->fecha_no_ingreso}}</td>
                        <td style="font-size: 13px">{{$episodio->no_ingreso->motivo_no_ingreso}}</td>
                        <td style="font-size: 13px">{{$episodio->no_ingreso->observaciones}}</td>
                        @if($medicalIncome!=null)


                            {{--<td style="font-size: 13px"><a href="/pdf/informes/{{$medicalIncome->informeMedico->id}}">Ver</a></td> --}}
                         <td><a href="/evoluciones/{{$episodio->id}}"class="btn btn-primary btn-sm">Evolución</a></td>

                        @else



                            {{-- <th><button  data-paciente="{{$episodio->id}}" data-fechaing="null" class="btn btn-danger btn-sm">Dar No ingreso</button></th>--}}
                        @endif

                    </tr>

                @endforeach
                </tbody>

            </table>
            {{$episodiosNoIngresados->links()}}

        </div>

    </div>

@endsection


