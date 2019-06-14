@php
    $carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
    //print_r($carbon->daysInMonth);
    $carbon->format('Y,m,d');
    $dias=$carbon->endOfMonth()->day;

    $totalDiagramaPsico=\App\PsychologyDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->get();


    //probando
    $dt = \Carbon\Carbon::create($anio,$mes, $dias); // day end of month
    $numberOfWeeks = $dt->weekOfMonth;
    $turnosPsicologia=\App\PsychologyShift::all();
    $psicologos=\App\Psychologist::all();

@endphp

<div class="container">
    <button type="button" class="btn btn-info btn-sm" id="agregarTurno">Generar Diagrama</button>
    <table class="table table-sm">
        <h4>Mes: {{$mes}}</h4>
        <h5>Nombre Paciente: {{$epi->patient->apellido}} {{$epi->patient->nombre}}</h5>
        <tbody>
            <tr>
                <td>Turno</td>
                @for($i=1; $i<=$dias; $i++)
                   <td>{{$i}}</td>

                @endfor
            </tr>
            <tr>
                <td><p>-</p></td>
                @for($i=1; $i<=$dias; $i++)
                    @php
                        $nombreDia=\Carbon\Carbon::createFromDate($anio, $mes, $i, '00');;
                    @endphp
                    <td>{{convertirNombreDiaEnf($nombreDia->localeDayOfWeek)}}</td>

                @endfor
            </tr>

            @foreach($totalDiagramaPsico as $diagrama)
                @php $citasDeEsteDiagrama=$diagrama->citas_psicologia;  @endphp
                <tr>
                    <td style="font-size: 12px;">{{$diagrama->episode->patient->apellido}} {{$diagrama->episode->patient->nombre}} - Turno: {{$diagrama->psychology_shift->id}} </td>

                    @for($j=1; $j<=$dias; $j++)
                        @php
                            $id=obtenerCitaPsiDiaTurnoNew($mes,$anio,$j,$ep->id,$diagrama->psychology_shift->id);
                            $citaPsi=\App\CitaPsicologia::find($id);
                            $idPsi=$citaPsi['psychologist_id'];

                            if(isset($idPsi)){
                                $psi=\App\Psychologist::find($idPsi);


                            }else{
                                $psi='-';
                            }

                        @endphp
                            @if(is_object($psi))
                                @if($citaPsi->psychologistEvolution==null)
                                <td style="border:1px solid #A4A4A4; color: black; font-size: 11px" class="alert alert-danger" >{{$citaPsi->cita->hora}} <strong>{{strtoupper($psi->cod_diagrama)}}</strong>
                                    <button class="modificar-cita" data-cita="{{$citaPsi->id}}" data-diagrama_id="{{$diagrama->id}}" style="font-size: 9px; padding: 1px">Editar</button>
                                    <button class="modificar-cita" data-cita_id="{{$citaPsi->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}" data-diagrama_id="{{$diagrama->psychology_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>

                                </td>
                                @else
                                <td style="border:1px solid #A4A4A4; color:black; font-size: 11px" class="alert alert-success">{{$citaPsi->cita->hora}} <strong>{{strtoupper($psi->cod_diagrama)}}</strong>
                                    <button class="s" data-cita_id_ver="{{$citaPsi->id}}" style="font-size: 9px; padding: 1px">
                                        <a href="/pdf/evolucionespsicologia/{{$citaPsi->psychologistEvolution->id}}">Ver</a>
                                    </button>
                                </td>

                                @endif


                            @else
                            <td style="border: solid 1px"><button class="agregarCitaPsiUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}">+</button></td>




                            @endif



                    @endfor
                    @if(count($citasDeEsteDiagrama)==0) <td><button id="eliminardiagramapsi" data-diagrama_id="{{$diagrama->id}}" class="eliminardiagramapsi btn btn-danger btn-sm">Eliminar Diagrama</button></td>@endif

                </tr>

            @endforeach
        </tbody>

    </table>

</div>

{{-- MODAL PARA AGREGAR DIAGRAMA POR TURNO--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarTurnoPsi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="agregardiagramapsi">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="epi" value="{{$ep->id}}">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">





                    <h4>Seleccione Turno</h4>
                    <select name="turno_id">


                        @foreach($turnosPsicologia as $turno)
                            @if(!buscaTurnoPsicologia($turno->id,$epi->id,$mes,$anio))

                                <option value="{{$turno->id}}">Turno {{$turno->id}}</option>
                            @endif

                        @endforeach

                        {{--@if(!buscaTurnoMedico($diagrama->id,$epi->id,$mes,$anio)) --}}
                        {{-- <option>{{$diagrama->id}}</option>--}}
                    </select>





                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>


{{-- MODAL PARA CITA UNITARIA  --}}
<div class="modal" tabindex="-1" role="dialog" id="agregarCitaPsi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarcitapsicologiaevo">
                    {{csrf_field()}}
                    <input type="hidden" name="fecha" value="" id="fecha">
                    <input type="hidden" name="psychology_digrama_id" id="psychology_diagrama_id"_>
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Psicologo</h5>
                    <select name="psychologist_id">


                        @foreach($psicologos as $psicologo)
                            @if($psicologo->user->status->id==1)
                                <option value="{{$psicologo->id}}">{{$psicologo->user->last_name}} {{$psicologo->user->name}}</option>
                            @endif
                        @endforeach

                        {{--@if(!buscaTurnoMedico($diagrama->id,$epi->id,$mes,$anio)) --}}
                        {{-- <option>{{$diagrama->id}}</option>--}}
                    </select>
                    <br>
                    <label>Hora:<p>(no obligatorio)</p></label>
                    <br>
                    <input type="time" name="hora">





                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Asignar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- MODAL PARA MODIFICAR CITA--}}
<div class="modal" tabindex="-1" role="dialog" id="modificarCitaPsi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Cita Evolución Psicologia</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/modificarcitamedicapsi">
                    {{csrf_field()}}
                    <input type="hidden" name="cita_id" value="" id="cita_id">
                    {{-- <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">--}}
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Psicologo</h5>
                    <select name="psychologist_id">


                        @foreach($psicologos as $psicologo)
                            @if($psicologo->user->status->id==1)
                                <option value="{{$psicologo->id}}">{{$psicologo->user->last_name}} {{$psicologo->user->name}}</option>
                            @endif
                        @endforeach

                        {{--@if(!buscaTurnoMedico($diagrama->id,$epi->id,$mes,$anio)) --}}
                        {{-- <option>{{$diagrama->id}}</option>--}}
                    </select>
                    <br>
                    <br>
                    <label>Hora:<p>(no obligatorio)</p></label>
                    <br>

                    <input type="time" name="hora">





                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Asignar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- MODAL PARA ELIMINAR CITA --}}
<div class="modal" tabindex="-1" role="dialog" id="eliminarCitaPsi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cita para Evolución Medica</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contenido">
                    <p id="turno_eli"></p>

                    <p id="fecha_eli"></p>

                </div>
                <form method="post" action="/eliminarcitapsi">
                    {{csrf_field()}}
                    <input type="hidden" name="cita_id_eli" value="" id="cita_id_eli">
                    {{-- <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">--}}
                    {{--<input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id"> --}}

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>

</div>

{{-- MODAL PARA ELIMINAR DIAGRAMA--}}
<div class="modal" tabindex="-1" role="dialog" id="eliminardiagramaPsi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta Seguro que desea eliminar el diagrama?</p>
                <form method="post" action="/eliminardiagramapsi">
                    {{csrf_field()}}

                    <input type="hidden" name="psychology_digrama_id_eli" id="psychology_diagrama_id_eli" value="">
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>