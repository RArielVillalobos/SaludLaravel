<h4 class="text-center" style="display: inline">Resultado Busqueda: {{$nombre}}</h4>
<h4 class="text">{{$fecha}}</h4>

@foreach($evolucionesEnfermeria as $evolucion)
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-2">
                    <h3 class="panel-title text-left"><strong>Evolución Enfermeria</strong></h3>

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
                    <strong>Turno:
                        @if($evolucion->cita_enfermeria->nursing_diagram->nursing_shift->nombre=='maniana')
                            Mañana
                          @else
                            {{$evolucion->cita_enfermeria->nursing_diagram->nursing_shift->nombre}}

                        @endif

                        <p class="text text-center">{{$evolucion->cita_enfermeria->nursing_diagram->nursing_shift->hora_desde}}--{{$evolucion->cita_enfermeria->nursing_diagram->nursing_shift->hora_hasta}}</p>

                    </strong>

                </div>

                <div class="col-xs-4 text-right">
                    Enfermero que Realiza <strong>{{ucfirst($evolucion->cita_enfermeria->nurse->user->last_name)}} {{ucfirst($evolucion->cita_enfermeria->nurse->user->name)}}</strong>

                </div>
                <div class="col-xs-1">
                    <button class="btn btn-default btn-xs">
                        <a href="/pdf/evolucionesenfermeria/{{$evolucion->id}}">Imprimir</a>
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




        </div>


    </div>




@endforeach