@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Pacientes Provisorios</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php $mensaje=\Illuminate\Support\Facades\Session::get('message'); $clase=\Illuminate\Support\Facades\Session::get('clase')  @endphp
        @if($mensaje)

            <div class="alert alert-{{$clase}}">
                <div>
                    {{$mensaje}}
                </div>

            </div>


        @endif
        <div>

        </div>
        <div class="panel-body">
            <table class="table table-responsive table-sm">
                <thead>
                <tr>

                    <th style="font-size: 13px">Nombre Paciente.</th>
                    <th style="font-size: 13px">Id Ep.</th>
                    <th style="font-size: 13px">Med Resp</th>
                    <th style="font-size: 13px">Obra Soc</th>
                    <th style="font-size: 13px">Fecha Ingreso Medico</th>
                    <th style="font-size: 13px">Fecha Ingreso Asis Social</th>
                    <th style="font-size: 13px">Prest Medicas.</th>
                    <th style="font-size: 13px">Prest Enfermeria.</th>
                    <th style="font-size: 13px">Prest Kinesiologia.</th>
                    <th style="font-size: 13px">Prest Psicologia.</th>
                    <th style="font-size: 13px">Evolución.</th>
                    <th style="font-size: 13px">Acciones.</th>

                </tr>
                </thead>
                <tbody>
                @foreach($epiosodiosProvisorios as $episodio)


                    @php
                        $medicalIncome=\App\MedicalIncome::join("medical_reports","medical_incomes.medical_report_id","=","medical_reports.id")
                         ->join('episodes','medical_reports.episode_id','=','episodes.id')
                        ->where('episodes.id','=',$episodio->id)->get()->first();

                    @endphp
                    <input type="hidden" value="{{$episodio->id}}" name="epi" class="epi">
                    <tr>
                        <td style="font-size: 13px">{{$episodio->patient->apellido}} {{$episodio->patient->nombre}} {{$episodio->patient->segundo_nombre}} </td>
                        <td style="font-size: 13px">{{$episodio->id}}</td>
                        <td style="font-size: 13px">{{$episodio->doctor->user->last_name}} {{$episodio->doctor->user->name}}</td>
                        <td style="font-size: 13px">{{$episodio->socialWork->nombre}}</td>
                        @if($episodio->medicalIncome!=null)
                            <td style="font-size: 13px">{{$episodio->medicalIncome->fecha}}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($episodio->psycho_social_income!=null)
                            <td style="font-size: 13px">{{$episodio->psycho_social_income->fecha}}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($medicalIncome!=null)


                        <td style="font-size: 13px">{{$medicalIncome->informeMedico->provision->medical_provision->valor}} por {{$medicalIncome->informeMedico->provision->medical_provision->tipo}} </td>
                        <td style="font-size: 13px">{{$medicalIncome->informeMedico->provision->nursing_provision->valor}} por {{$medicalIncome->informeMedico->provision->nursing_provision->tipo}} </td>
                        <td style="font-size: 13px">{{$medicalIncome->informeMedico->provision->kinesiology_provision->valor}} por {{$medicalIncome->informeMedico->provision->kinesiology_provision->tipo}} </td>
                        <td style="font-size: 13px">{{$medicalIncome->informeMedico->provision->psycology_provision->valor}} por {{$medicalIncome->informeMedico->provision->psycology_provision->tipo}} </td>
                        <td style="font-size: 13px"><a  class="btn btn-primary btn-sm" href="/evoluciones/{{$episodio->id}}">Ver</a></td>
                        <th style="font-size: 13px"><button data-paciente="{{$episodio->id}}" data-fechaing="{{$medicalIncome->fecha}}" class="btn btn-danger btn-sm">Dar No ingreso</button></th>
                        @else
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td style="font-size: 13px">
                                <button  data-paciente="{{$episodio->id}}" data-fechaing="null" class="btn btn-danger btn-sm">Dar No ingreso</button>
                                <a href="{{route('episodio.modificar',$episodio->id)}}"  class="btn btn-primary btn-sm" >Modificar</a>

                            </td>



                        @endif

                    </tr>

                @endforeach
                </tbody>

            </table>
            {{$epiosodiosProvisorios->links()}}

        </div>

    </div>


        {{--<div class="container">
                <form method="post" action="/s">
                    <input type="search" name="busqueda">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div> --}}
    {{-- MODAL NO INGRESO--}}
    @php $fechaActual=\Carbon\Carbon::now(); $fecha=$fechaActual->format('Y-m-d') @endphp
    <div class="modal" tabindex="-1" role="dialog" id="noingreso">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Esta Seguro que desea generar No-Ingreso?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="/pacientes/generarnoingreso">
                        {{csrf_field()}}


                        <input type="hidden" name="episode_id" value="" id="episode_id">
                        <input type="hidden" name="fecha_ingreso_med" value="" id="fecha_ingreso_med">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Fecha No ingreso:</label>
                                    <div>
                                        <input type="date" class="form-control" name="fecha_no_ingreso" value="{{$fecha}}">

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Motivo No Ingreso:</label>
                                <div class="form-group">
                                    <textarea class="form-control" name="motivo">{{old('motivo')}}</textarea>

                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Observaciones:</label>
                                <div class="form-group">
                                    <textarea class="form-control" name="observaciones">{{old('observaciones')}}</textarea>

                                </div>

                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Enviar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


    {{--modal para editar datos ingresos--}}
    <div class="modal" tabindex="-1" role="dialog" id="editarDatosIngreso">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">




                </div>

            </div>
        </div>
    </div>



@endsection

@section('script')
    <script src="/js/estadoPacientes/noingreso.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection
