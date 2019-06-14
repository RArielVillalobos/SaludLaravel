@php
    $carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
    //print_r($carbon->daysInMonth);
    $carbon->format('Y,m,d');
    $dias=$carbon->endOfMonth()->day;

    $totalDiagramaKine=\App\KinesiologyDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->get();


    //probando
    $dt = \Carbon\Carbon::create($anio,$mes, $dias); // day end of month
    $numberOfWeeks = $dt->weekOfMonth;
    $turnosKinesiologia=\App\KinesiologyShift::all();
    $kinesiologos=\App\Kinesiologist::all();

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

        @foreach($totalDiagramaKine as $diagrama)

            @php $citasDeEsteDiagrama=$diagrama->citas_kinesiologia;  @endphp
            <tr>
                <td style="font-size: 12px;">{{$diagrama->episode->patient->apellido}} {{$diagrama->episode->patient->nombre}} - Turno: {{$diagrama->kinesiology_shift->id}} </td>

                @for($j=1; $j<=$dias; $j++)
                    @php
                        $id=obtenerCitaKineDiaTurnoNew($mes,$anio,$j,$ep->id,$diagrama->kinesiology_shift->id);
                        $citaKine=\App\CitasKinesiologia::find($id);
                        $idKine=$citaKine['kinesiologist_id'];

                        if(isset($idKine)){
                            $kine=\App\Kinesiologist::find($idKine);


                        }else{
                            $kine='-';
                        }

                    @endphp
                    @if(is_object($kine))
                        @if($citaKine->kinesiologistEvolution==null)
                            <td style="border:1px solid #A4A4A4; color: black; font-size: 11px" class="alert alert-danger" >{{$citaKine->cita->hora}} <strong>{{strtoupper($kine->cod_diagrama)}}</strong>
                                <button class="modificar-cita" data-cita="{{$citaKine->id}}" data-diagrama_id="{{$diagrama->id}}" style="font-size: 9px; padding: 1px">Editar</button>
                                <button class="modificar-cita" data-cita_id="{{$citaKine->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}" data-diagrama_id="{{$diagrama->kinesiology_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>

                            </td>
                        @else
                            <td style="border:1px solid #A4A4A4; color:black; font-size: 11px" class="alert alert-success">{{$citaKine->cita->hora}} <strong>{{strtoupper($kine->cod_diagrama)}}</strong>
                                <br>
                                <button class="s" data-cita_id_ver="{{$citaKine->id}}" style="font-size: 9px; padding: 1px">
                                    <a href="/pdf/evolucioneskinesiologia/{{$citaKine->kinesiologistEvolution->id}}">Ver</a>
                                </button>
                            </td>

                        @endif


                    @else
                        <td style="border: solid 1px"><button class="agregarCitaKineUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$j}}">+</button></td>




                    @endif



                @endfor
                @if(count($citasDeEsteDiagrama)==0) <td><button id="eliminardiagramakine" data-diagrama_id="{{$diagrama->id}}" class="eliminardiagramakine btn btn-danger btn-sm">Eliminar Diagrama</button></td>@endif

            </tr>

        @endforeach
        </tbody>

    </table>

</div>

{{-- MODAL PARA AGREGAR DIAGRAMA POR TURNO--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarTurnoKine">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="agregardiagramakine">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="epi" value="{{$ep->id}}">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">





                    <h4>Seleccione Turno</h4>
                    <select name="turno_id">


                        @foreach($turnosKinesiologia as $turno)
                            @if(!buscaTurnoKinesiologia($turno->id,$epi->id,$mes,$anio))

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
<div class="modal" tabindex="-1" role="dialog" id="agregarCitaKine">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarcitakinesiologiaevo">
                    {{csrf_field()}}
                    <input type="hidden" name="fecha" value="" id="fecha">
                    <input type="hidden" name="kinesiologist_diagrama_id" id="kinesiologist_diagrama_id"_>
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Kinesiologo</h5>
                    <select name="kinesiologist_id">


                        @foreach($kinesiologos as $kinesiologo)
                            @if($kinesiologo->user->status->id==1)
                                <option value="{{$kinesiologo->id}}">{{$kinesiologo->user->last_name}} {{$kinesiologo->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="modificarCitaKine">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Cita Evolución Kinesiologia</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/modificarcitakine">
                    {{csrf_field()}}
                    <input type="hidden" name="cita_id" value="" id="cita_id">
                    {{-- <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">--}}
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Psicologo</h5>
                    <select name="kinesiologist_id">


                        @foreach($kinesiologos as $kinesiologo)
                            @if($kinesiologo->user->status->id==1)
                                <option value="{{$kinesiologo->id}}">{{$kinesiologo->user->last_name}} {{$kinesiologo->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="eliminarCitaKine">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cita para Evolución Kinesiologia</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contenido">
                    <p id="turno_eli"></p>

                    <p id="fecha_eli"></p>

                </div>
                <form method="post" action="/eliminarcitakine">
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
<div class="modal" tabindex="-1" role="dialog" id="eliminardiagramaKine">
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
                <form method="post" action="/eliminardiagramakine">
                    {{csrf_field()}}

                    <input type="hidden" name="kinesiology_digrama_id_eli" id="kinesiology_diagrama_id_eli" value="">
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