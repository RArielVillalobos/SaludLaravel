@php
    $carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
    //print_r($carbon->daysInMonth);
    $carbon->format('Y,m,d');
    $dias=$carbon->endOfMonth()->day;

    $totalDiagramaAsis=\App\SocialAssistantDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->get();



    //probando
    $dt = \Carbon\Carbon::create($anio,$mes, $dias); // day end of month
    $numberOfWeeks = $dt->weekOfMonth;
    $turnosAsis=\App\SocialAssistantShift::all();

    $asistentes=\App\SocialAssistant::all();

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



        @foreach($totalDiagramaAsis as $diagrama)

            @php $citasDeEsteDiagrama=$diagrama->citas_asist_social;


            @endphp

            <tr>
                <td style="font-size: 12px;">{{$diagrama->episode->patient->apellido}} {{$diagrama->episode->patient->nombre}} - Turno: {{$diagrama->asis_social_shift->id}} </td>

                @for($j=1; $j<=$dias; $j++)
                    @php
                        $id=obtenerCitaAsisSocialDiaTurnoNew($mes,$anio,$j,$ep->id,$diagrama->asis_social_shift->id);
                        $citaAsis=\App\CitasAsistenteSocial::find($id);
                        $idAsis=$citaAsis['social_assistant_id'];

                        if(isset($idAsis)){
                            $asis=\App\SocialAssistant::find($idAsis);


                        }else{
                            $asis='-';
                        }



                    @endphp
                    @if(is_object($asis))
                        @if($citaAsis->asisSocialEvolution==null)
                            <td style="border:1px solid #A4A4A4; color: black; font-size: 11px" class="alert alert-danger" >{{$citaAsis->cita->hora}} <strong>{{strtoupper($asis->cod_diagrama)}}</strong>
                                <button class="modificar-cita" data-cita="{{$citaAsis->id}}" data-diagrama_id="{{$diagrama->id}}" style="font-size: 9px; padding: 1px">Editar</button>
                                <button class="modificar-cita" data-cita_id="{{$citaAsis->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}" data-diagrama_id="{{$diagrama->asis_social_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>

                            </td>
                        @else
                            <td style="border:1px solid #A4A4A4; color:black; font-size: 11px" class="alert alert-success">{{$citaAsis->cita->hora}} <strong>{{strtoupper($asis->cod_diagrama)}}</strong>
                                <br>
                                <button class="s" data-cita_id_ver="{{$citaAsis->id}}" style="font-size: 9px; padding: 1px">

                                    <a href="/pdf/evolucionasistentesocial/{{$citaAsis->asisSocialEvolution->id}}">Ver</a>
                                </button>
                            </td>

                        @endif


                    @else
                        <td style="border: solid 1px"><button class="agregarCitaAsisUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}">+</button></td>




                    @endif



                @endfor
                @if(count($citasDeEsteDiagrama)==0) <td><button id="eliminardiagramaasis" data-diagrama_id="{{$diagrama->id}}" class="eliminardiagramaasis btn btn-danger btn-sm">Eliminar Diagrama</button></td>@endif

            </tr>

        @endforeach
        </tbody>

    </table>

</div>

{{-- MODAL PARA AGREGAR DIAGRAMA POR TURNO--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarTurnoAsis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="agregardiagramaasis">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="epi" value="{{$ep->id}}">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">





                    <h4>Seleccione Turno</h4>
                    <select name="social_assistant_shift_id">


                        @foreach($turnosAsis as $turno)
                            @if(!buscaTurnoAsisSocial($turno->id,$epi->id,$mes,$anio))


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
<div class="modal" tabindex="-1" role="dialog" id="agregarCitaAsis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarcitaasistentesocialaevo">
                    {{csrf_field()}}
                    <input type="hidden" name="fecha" value="" id="fecha">
                    <input type="hidden" name="asis_digrama_id" id="asis_diagrama_id"_>
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Asistente Social</h5>
                    <select name="asis_id">


                        @foreach($asistentes as $asistente)
                            @if($asistente->user->status->id==1)
                                <option value="{{$asistente->id}}">{{$asistente->user->last_name}} {{$asistente->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="modificarCitaAsis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Cita Evolución Asistente Social</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/modificarcitamedicaasis">
                    {{csrf_field()}}
                    <input type="hidden" name="cita_id" value="" id="cita_id">
                    {{-- <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">--}}
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Asistente Social</h5>
                    <select name="asis_id">


                        @foreach($asistentes as $asistente)
                            @if($asistente->user->status->id==1)
                                <option value="{{$asistente->id}}">{{$asistente->user->last_name}} {{$asistente->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="eliminarCitaAsis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cita para Evolución Asistente Social</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contenido">
                    <p id="turno_eli"></p>

                    <p id="fecha_eli"></p>

                </div>
                <form method="post" action="/eliminarcitaasis">
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
<div class="modal" tabindex="-1" role="dialog" id="eliminardiagramaAsis">
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
                <form method="post" action="/eliminardiagramaasis">
                    {{csrf_field()}}

                    <input type="hidden" name="asis_digrama_id_eli" id="asis_diagrama_id_eli" value="">
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