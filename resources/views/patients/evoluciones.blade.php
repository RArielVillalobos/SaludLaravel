<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Salud 1.0</title>
</head>
<body>


    <br>
    <br>
    <div class="container">


        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a href="/home">
                    <img src="/img/fix.jpg" width="60px" >
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{$episode->patient->apellido}} {{$episode->patient->nombre}} {{$episode->patient->segundo_nombre}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Datos Personales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contexto Psicosocial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-prorroga-tab" data-toggle="pill" href="#pills-prorroga" role="tab" aria-controls="pills-prorroga" aria-selected="true">Informe para Prorrogas</a>
            </li>
        </ul>
        <hr>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div>Obra Social: <strong>{{strtoupper($episode->SocialWork->nombre)}}</strong></div>
                        <div>Edad:<strong>@php $edad=Carbon\Carbon::parse($informeMedico->episode->patient->fecha_nacimiento)->age @endphp {{$edad}}</strong></div>
                        <div>Residencia Actual: <strong>{{$episode->patient->direccion}}</strong></div>
                        <div>Localidad: <strong>{{$episode->patient->localidad}}</strong></div>
                        <div>Medico Responsable <strong>{{$episode->doctor->user->last_name}} {{$episode->doctor->user->name}}</strong></div>

                    </div>
                    <div class="col-md-4">
                        <div>Nº afiliado:<strong> {{$episode->patient->numero_afiliado_obra}}</strong></div>
                        <div>Sexo:<strong> {{$episode->patient->sexo}}</strong></div>
                        <div>Telefono:<strong> {{$episode->patient->telefono}}</strong></div>
                        <div>Familiar Responsable:<strong> {{$episode->patient->familiar_responsable}}</strong></div>
                        <div>Num Familiar Responsable:<strong> {{$episode->patient->numero_tel_familiar}}</strong></div>
                        <div>Total Dias internacion: <strong>{{$episode->diasProvisorio()}}</div></strong>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="col-md-4">
                    <div>Codigo Paciente: <strong>{{$episode->patient->id}}</strong></div>
                    <div>Fecha de Nacimiento:<strong> {{$episode->patient->fecha_nacimiento}}</strong></div>
                    <div>Familiar Responsable: <strong>{{$episode->patient->familiar_responsable}}</strong></div>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                @if($episode->psycho_social_income)
                    @if($episode->psycho_social_income->social_context!=null)
                    <div class="row">
                        <div class="col-sm">
                            <div>Vivienda Adecuada: <strong>{{$episode->psycho_social_income->social_context->vivienda_adecuada}}</strong></div>
                            <div>Cuidadores: <strong>{{$episode->psycho_social_income->social_context->cuidadores}}</strong></div>
                            <div>Cumple Requisitos para Internacion Domiciliaria: <strong>{{$episode->psycho_social_income->social_context->cumple_requi_int_domiciliaria}}</strong></div>
                        </div>
                        <div class="col-sm">
                            <div>
                                Asistente Social que Realizó: <strong>{{$episode->psycho_social_income->social_assistant->user->last_name}} {{$episode->psycho_social_income->social_assistant->user->name}}</strong>
                            </div>
                            <div>
                                <a href="/pdf/informepsicosocial/{{$episode->psycho_social_income->id}}">Ver Informe Asist.Social</a>
                            </div>


                        </div>

                    </div>
                    @endif



                @endif
            </div>

            <div class="tab-pane fade" id="pills-prorroga" role="tabpanel" aria-labelledby="pills-prorroga-tab">
                <div>
                    <h6>
                        <strong>Ingreso</strong>
                    </h6>
                    <ul>
                        <li>

                            <a href="/pdf/informes/{{$medicalIncome->InformeMedico->id}}">Ingreso realizado el dia {{$medicalIncome->fecha}}</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h6>
                        <strong>Prorrogas</strong>
                    </h6>
                    <ul>
                        @foreach($prorrogasEpi as $prorroga)


                            <li>

                                <a href="/pdf/prorroga/{{$prorroga->id}}">Prorroga realizada el dia {{$prorroga->fecha_prorroga}}</a>
                                

                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
        <hr>
    </div>





    <div class="container">
        <div class="alert alert-danger" >
            <div>
                <strong>Diagnostico Principal:</strong>
                <br>
                {{$informeMedico->diagnostico_activo}} {{$informeMedico->diagnostico_pasivo}}
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-info">
                <strong>Cantidad de Prestaciones</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <strong>Médicas: {{$provision->medical_provision->valor}} {{$provision->medical_provision->tipo}}</strong>
                    </div>
                    <div class="col-sm">
                        <strong>Enfermeria: {{$provision->nursing_provision->valor}} por {{$provision->nursing_provision->tipo}} </strong>
                    </div>
                    <div class="col-sm">
                        <strong>Kinesiología: {{$provision->kinesiology_provision->valor}} por {{$provision->kinesiology_provision->tipo}} </strong>

                    </div>
                    <div class="col-sm">
                        <strong>Psicología: {{$provision->psycology_provision->valor}} por {{$provision->psycology_provision->tipo}} </strong>

                    </div>

                </div>
                <br>
                    <div class="row">
                        {{--<div class="col-sm"><strong>Rehabilitacion</strong></div> --}}

                        <div class="col-sm"><strong>Autorizado Desde: {{$provision->autorizado_desde}}</strong></div>
                        <div class="col-sm"><strong>Autorizado Hasta: {{$provision->autorizado_hasta}}</strong></div>

                    </div>



            </div>
        </div>
        <br>



        <div class="card">
            <div class="card-header bg-primary">
                <strong>Ultimas Evoluciones</strong>
            </div>
            @if($episode->epicrisis)
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-sm">
                            <strong>Epicrisis</strong>
                        </div>
                        <div class="col-sm">
                            {{$episode->epicrisis->fecha_epicrisis}} - {{$episode->epicrisis->hora_epicrisis}}


                        </div>
                        <div class="col-sm">
                            Médico que realiza que Realiza: <strong>{{$episode->epicrisis->doctor->user->last_name}} {{$episode->epicrisis->doctor->user->name}}</strong>


                        </div>
                        <div class="col-sm">
                            <a href="{{route('epicrisis.pdf',$episode->epicrisis->id)}}" class="btn btn-outline-danger btn-sm">Imprimir</a>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                           <strong>Diagnostico Egreso</strong>:  {{$episode->epicrisis->diagnostico_egreso}}

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <strong>Motivo Egreso:</strong>
                            @if($episode->epicrisis->derivacion_int_nosocomial=='si')
                                Derivación a Internación Nosocomial


                        </div>
                             <div class="col-sm">
                                 <strong>Institución</strong>:{{$episode->epicrisis->institucion}}
                             </div>
                            <div class="col-sm">
                                <strong>Causa Derivacón</strong>:{{$episode->epicrisis->causa_derivacion}}
                            </div>
                            @endif
                            @if($episode->epicrisis->fallecimiento=='si')
                                Fallecimiento
                            @endif

                    </div>





                </div>
                <div class="row">
                    <div class="col-sm">
                        <strong>Epicrisis:</strong> {{$episode->epicrisis->epicrisis}}

                    </div>

                </div>

            </div>
            @endif

            <div class="card-body">
                @if(count($evolucionesMedicas)<=0)

                    <div class="card">
                    <div class="card-header .bg-info">
                        <div class="row">
                            <div class="col-sm">
                                <strong>Informe Medico:</strong>

                            </div>

                            <div class="col-sm">
                                {{$informeMedico->created_at->format('d-m-Y')}}

                            </div>


                            <div class="col-sm">
                                Médico que realiza: {{$informeMedico->doctor->user->last_name}} {{$informeMedico->doctor->user->name}}

                            </div>
                            <div class="col-sm">
                                <a class="btn btn-outline-danger btn-sm" href="{{route('pdf.informe',$informeMedico->id)}}">Imprimir</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <strong>Estado Actual:</strong> {{$informeMedico->enfermerdad_actual}}
                        <br>
                        <br>

                        @if($informeMedico->recipe!=null)
                        <div class="alert alert-danger">
                                <p class="text text-danger">Medicacion de Ingreso Medico</p>
                                <table class="table table-bordered table-hover ">
                                    <thead>
                                        <th>Medicación</th>
                                        <th>Dosis</th>
                                        <th>Vía</th>
                                        <th>Int</th>
                                        <th>Observaciones</th>
                                    </thead>
                                    <tbody>

                                         @foreach($informeMedico->recipe->medicines as $medicine)
                                            <tr>
                                                <td>{{$medicine->nombre}}</td>
                                                <td>{{$medicine->pivot->dosis}}</td>
                                                <td>{{$medicine->pivot->via}}</td>
                                                <td>{{$medicine->pivot->int}}</td>
                                                <td>{{$medicine->pivot->observaciones}}</td>

                                            </tr>

                                        @endforeach

                                    </tbody>


                                </table>
                            </div>
                        @endif

                          @if($informeMedico->indication!=null)

                             @foreach($informeMedico->indication->treatments as $indicacion)
                                <div class="card">
                                    <h5 class="card-header alert-info">{{$indicacion->nombre}}</h5>
                                    <div class="card-body">

                                        <p class="card-text">{{$indicacion->descripcion}}</p>

                                    </div>
                                </div>
                                 <br>
                             @endforeach
                            @endif
                        <br>


                       

                    </div>
                </div>


                @else


                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="row">
                                <div class="col-sm">
                                    <strong>Evolución Medica:</strong>

                                </div>

                                <div class="col-sm">
                                    {{$evolucionesMedicas->last()->citaMedicalEvolution->citaMedica->fecha}}
                                    {{--$informeMedico->created_at->format('d-m-Y')--}}

                                </div>

                                <div class="col-sm">
                                    Médico que realiza: {{$evolucionesMedicas->last()->citaMedicalEvolution->doctor->user->last_name}} {{$evolucionesMedicas->last()->citaMedicalEvolution->doctor->user->last_name}}

                                </div>
                                <div class="col-sm">
                                    <a class="btn btn-outline-danger btn-sm" href="{{route('pdf.evolucionmedica',$evolucionesMedicas->last()->id)}}">Imprimir</a>
                                </div>


                            </div>
                        </div>
                        <div class="card-body">
                            <strong>Evolución:</strong> {{$evolucionesMedicas->last()->evolucion}}

                            <hr>

                            @if($evolucionesMedicas->last()->recipe<>null)
                                <div class="alert alert-danger">
                                    <p class="text text-danger">Medicacion de Cita evolucion</p>
                                    <table class="table table-bordered table-hover ">
                                        <thead>
                                            <th>Medicación</th>
                                            <th>Dosis</th>
                                            <th>Vía</th>
                                            <th>Int.</th>
                                            <th>Observaciones</th>
                                        </thead>
                                        <tbody>

                                            @foreach($evolucionesMedicas->last()->recipe->medicines as $medicine)
                                                <tr>
                                                    <td>{{$medicine->nombre}}</td>
                                                    <td>{{$medicine->pivot->dosis}}</td>
                                                    <td>{{$medicine->pivot->via}}</td>
                                                    <td>{{$medicine->pivot->int}}</td>
                                                    <td>{{$medicine->pivot->observaciones}}</td>

                                                </tr>

                                            @endforeach
        
                                        </tbody>


        

                                    </table>    
                                 </div>
                            @endif
                            

                        </div>

                        @if($evolucionesMedicas->last()->indication!=null)


                            @foreach($evolucionesMedicas->last()->indication->treatments as $indicacion)
                                <div class="card">
                                    <h5 class="card-header alert-info">{{$indicacion->nombre}}</h5>
                                    <div class="card-body">

                                        <p class="card-text">{{$indicacion->descripcion}}</p>

                                    </div>
                                </div>
                                <br>
                            @endforeach
                        @endif

                    </div>
                    


                @endif
                
                

                <br>
                @if(isset($ultimaEvoEnfermeria))
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-sm">
                                <strong>Evolución Enfermeria</strong>

                            </div>
                            <div class="col-sm">
                                {{$ultimaEvoEnfermeria->cita_enfermeria->cita->fecha}}

                            </div>
                            <div class="col-sm">
                                Enfermero que realiza:<strong> {{$ultimaEvoEnfermeria->cita_enfermeria->nurse->user->name}} {{$ultimaEvoEnfermeria->cita_enfermeria->nurse->user->last_name}}</strong>

                            </div>
                            <div class="col-sm">
                                <a href="/pdf/evolucionesenfermeria/{{$ultimaEvoEnfermeria->id}}" class="btn btn-outline-danger btn-sm">Imprimir</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <strong>TA:</strong> {{$ultimaEvoEnfermeria->ta}}
                            </div>
                            <div class="col-sm">
                                <strong>FR:</strong> {{$ultimaEvoEnfermeria->fr}}
                            </div>
                            <div class="col-sm">
                                <strong>FC:</strong> {{$ultimaEvoEnfermeria->fc}}
                            </div>
                            <div class="col-sm">
                                <strong>Temp:</strong> {{$ultimaEvoEnfermeria->temp}}
                            </div>
                            <div class="col-sm">
                                <strong>HGT:</strong> {{$ultimaEvoEnfermeria->hgt}}
                            </div>
                            <div class="col-sm">
                                <strong>SPO2:</strong> {{$ultimaEvoEnfermeria->spo}}
                            </div>
                            <div class="col-sm">
                                <strong>Diuresis:</strong> {{$ultimaEvoEnfermeria->diuresis}}
                            </div>
                            <div class="col-sm">
                                <strong>Catarsis:</strong> {{$ultimaEvoEnfermeria->catarsis}}
                            </div>

                        </div>
                        <br>
                        <strong>Evolución:</strong> {{$ultimaEvoEnfermeria->evolucion}}

                    </div>
                </div>
                @endif
                <br>
                @if(isset($ultimaEvoKine))
                <div class="card">
                    <div class="card-header bg-warning">
                        <div class="row">
                            <div class="col-sm">
                                <strong>Evolución Kinesiología</strong>
                            </div>
                            <div class="col-sm">
                               {{$ultimaEvoKine->cita_kinesiologia->cita->fecha}}

                            </div>
                            <div class="col-sm">
                                Kinesiologo que Realiza: <strong>{{$ultimaEvoKine->cita_kinesiologia->kinesiologist->user->name}} {{$ultimaEvoKine->cita_kinesiologia->kinesiologist->user->last_name}}</strong>


                            </div>
                            <div class="col-sm">
                                <a href="/pdf/evolucioneskinesiologia/{{$ultimaEvoKine->id}}" class="btn btn-outline-danger btn-sm">Imprimir</a>
                            </div>

                        </div>

                    </div>
                    <div class="card-body">
                        {{$ultimaEvoKine->evolucion}}


                    </div>
                </div>
                @endif

                    @if(isset($ultimaEvoPsico))
                        <div class="card">
                            <div class="card-header bg-warning">
                                <div class="row">
                                    <div class="col-sm">
                                        <strong>Evolución Psicología</strong>
                                    </div>
                                    <div class="col-sm">
                                        {{$ultimaEvoPsico->cita_psicologia->cita->fecha}}

                                    </div>
                                    <div class="col-sm">
                                        Psicólogo que Realiza: <strong>{{$ultimaEvoPsico->cita_psicologia->psychologist->user->name}} {{$ultimaEvoPsico->cita_psicologia->psychologist->user->last_name}}</strong>


                                    </div>
                                    <div class="col-sm">
                                        <a href="/pdf/evolucionespsicologia/{{$ultimaEvoPsico->id}}" class="btn btn-outline-danger btn-sm">Imprimir</a>
                                    </div>

                                </div>

                            </div>
                            <div class="card-body">
                                {{$ultimaEvoPsico->evolucion}}


                            </div>
                        </div>
                    @endif

                    @if(isset($ultimaEvoAsistente))
                        <div class="card">
                            <div class="card-header bg-warning">
                                <div class="row">
                                    <div class="col-sm">
                                        <strong>Evolución Asistente Social</strong>
                                    </div>
                                    <div class="col-sm">
                                        {{$ultimaEvoAsistente->cita_asis_social->cita->fecha}}

                                    </div>
                                    <div class="col-sm">
                                        Asistente Social que Realiza: <strong>{{$ultimaEvoAsistente->cita_asis_social->asis_social->user->name}} {{$ultimaEvoAsistente->cita_asis_social->asis_social->user->last_name}}</strong>


                                    </div>
                                    <div class="col-sm">
                                        <a href="/pdf/evolucionasistentesocial/{{$ultimaEvoAsistente->id}}" class="btn btn-outline-danger btn-sm">Imprimir</a>
                                    </div>

                                </div>

                            </div>
                            <div class="card-body">
                                {{$ultimaEvoAsistente->evolucion}}


                            </div>
                        </div>
                    @endif




            </div>
            <br>

            {{--
            <div class="card">
                <div class="card-header bg-info">
                    <strong>Historial Evoluciones</strong>
                </div>
                <div class="card-body">


                </div>
            </div>--}}
            

        </div>

        <br>



    </div>





    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>