<h4 class="text-center" style="display: inline">Resultado Busqueda: {{$nombre}}</h4>
<h4 class="text">{{$fecha}}</h4>

@foreach($evolucionesMedicas as $evolucion)
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-2">
                    <h3 class="panel-title text-left"><strong>Evolución Médica</strong></h3>

                </div>
                <div class="col-xs-3">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                {{$evolucion->fecha}}
                                {{$evolucion->hora}}


                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-xs-1">
                    <strong>Turno:{{$evolucion->citaMedicalEvolution->medicalDiagram->medical_shift->id}}</strong>

                </div>

                <div class="col-xs-4 text-right">
                    Médico que Realiza <strong>{{ucfirst($evolucion->citaMedicalEvolution->doctor->user->last_name)}} {{ucfirst($evolucion->citaMedicalEvolution->doctor->user->name)}}</strong>

                </div>
                <div class="col-xs-1">
                    <button class="btn btn-default btn-xs">
                        <a href="/pdf/evolucionmedica/{{$evolucion->id}}">Imprimir</a>
                    </button>

                </div>

            </div>
        </div>

        <div class="panel-body text-left">
            <div class="row">
                <div class="col-xs-8 text-left">
                    <ul class="list list-inline">
                        <li><strong>TA:</strong>{{$evolucion->ta}}</li>
                        <li><strong>FR:</strong>{{$evolucion->fr}}</li>
                        <li><strong>FC:</strong>{{$evolucion->fc}}</li>
                        <li><strong>Temp:</strong>{{$evolucion->temp}}</li>
                        <li><strong>HGT:</strong>{{$evolucion->hgt}}</li>
                        <li><strong>SPO:</strong>{{$evolucion->spo}}</li>
                        <li><strong>Diuresis:</strong>{{$evolucion->diuresis}}</li>
                        <li><strong>Catarsis:</strong>{{$evolucion->catarsis}}</li>
                    </ul>

                </div>

            </div>

            <div>
                <strong>Evolución:</strong> {{$evolucion->evolucion}}
            </div>
            <hr>
            @if($evolucion->recipe!=null)
                <div class="alert alert-danger">
                    <h4>Medicación</h4>
                    <table class="table table-bordered table-hover table-sm ">
                        <thead>
                        <th>Medicación</th>
                        <th>Dosis</th>
                        <th>Vía</th>
                        <th>Int</th>
                        <th>Observaciones</th>
                        </thead>
                        <tbody>

                        @foreach($evolucion->recipe->medicines as $medicine)
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
            @if($evolucion->indication!=null)
                <div class="alert alert-danger">
                 <h4>Indicaciones</h4>
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                        <th>Nombre</th>
                        <th>Descripcion</th>

                        </thead>
                        <tbody>

                        @foreach($evolucion->indication->treatments as $indicacion)
                            <tr>
                                <td>{{$indicacion->nombre}}</td>
                                <td>{{$indicacion->descripcion}}</td>


                            </tr>

                        @endforeach

                        </tbody>


                    </table>

                </div>

            @endif


        </div>


    </div>




@endforeach





