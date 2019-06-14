<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 24/sep/2018
 * Time: 12:17
 */
$carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
//print_r($carbon->daysInMonth);
$carbon->format('Y,m,d');
$dias=$carbon->endOfMonth()->day;

$totalDiagramaMedi=\App\MedicalDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->get();


//probando
$dt = \Carbon\Carbon::create($anio,$mes, $dias); // day end of month
$numberOfWeeks = $dt->weekOfMonth;
$turnosMedicos=\App\MedicalShift::all();
$medicos=\App\Doctor::all();

?>
<div class="container">
    <button type="button" class="btn btn-info btn-sm" id="agregarTurno">Agregar otro Turno</button>
    <table class="table table-sm">
        <h4>Mes: {{$mes}}</h4>
        <h5>Nombre Paciente: {{$epi->patient->apellido}} {{$epi->patient->nombre}}</h5>
        <tbody>

        <tr>

            <td>Turno</td>


            <?php
            for($i=1; $i<=$dias; $i++){
            ?>

            <td>{{$i}}</td>



            <?php
            }

            ?>
        </tr>
        <tr>
            <td><p>-</p></td>
            <?php
            for($i=1; $i<=$dias; $i++){
            $nombreDia=\Carbon\Carbon::createFromDate($anio, $mes, $i, '00');;
            ?>
            <td>{{convertirNombreDiaEnf($nombreDia->localeDayOfWeek)}}</td>

            <?php
            }
            ?>
        </tr>
        @foreach($totalDiagramaMedi as $diagrama)
            @php $citasDeEsteDiagrama=$diagrama->citas_evolucion_medica;  @endphp
            <tr>
                <td style="font-size: 12px;">{{$diagrama->episode->patient->apellido}} {{$diagrama->episode->patient->nombre}} - Turno: {{$diagrama->medical_shift->id}} </td>


            @for($i=1; $i<=$dias; $i++)
                @php
                    $id=obtenerCitaMedDiaTurnoNew($mes,$anio,$i,$ep->id,$diagrama->medical_shift->id);
                    $citaMed=\App\CitaEvolutionMedical::find($id);
                    $idDoctor=$citaMed['doctor_id'];
                    if(isset($idDoctor)){
                         $doctor=\App\Doctor::find($idDoctor);


                    }else{
                        $doctor='-';
                    }

                @endphp

                    @if(is_object($doctor))
                        @if($citaMed->medicalEvolution==null)
                            <td style="border:1px solid #A4A4A4; color: black; font-size: 11px" class="alert alert-danger" >{{$citaMed->citaMedica->hora}} <strong>{{strtoupper($doctor->cod_diagrama)}}</strong>
                                <button class="modificar-cita" data-cita="{{$citaMed->id}}" data-diagrama_id="{{$diagrama->id}}" style="font-size: 9px; padding: 1px">Editar</button>
                                <button class="modificar-cita" data-cita_id="{{$citaMed->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}" data-diagrama_id="{{$diagrama->medical_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>

                            </td>
                        @else
                            <td style="border:1px solid #A4A4A4; color:black; font-size: 11px" class="alert alert-success">{{$citaMed->citaMedica->hora}} <strong>{{strtoupper($doctor->cod_diagrama)}}</strong>

                                <button class="s" data-cita_id_ver="{{$citaMed->id}}" style="font-size: 9px; padding: 1px">
                                    <a href="/pdf/evolucionmedica/{{$citaMed->medicalEvolution->id}}">Ver</a>
                                </button>
                            </td>

                        @endif


                    @else
                        <td style="border: solid 1px"><button class="agregarCitaMediUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}">+</button></td>




                    @endif



            @endfor
               @if(count($citasDeEsteDiagrama)==0) <td><button id="eliminardiagramamedi" data-diagrama_id="{{$diagrama->id}}" class="eliminardiagramamedi btn btn-danger btn-sm">Eliminar Diagrama</button></td>@endif
            </tr>

        @endforeach


    </table>

</div>




<div class="modal" tabindex="-1" role="dialog" id="agregarTurnoMedi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="agregardiagrama">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="epi" value="{{$ep->id}}">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">





                    <h4>Seleccione Turno</h4>
                    <select name="turno_id">


                        @foreach($turnosMedicos as $turno)
                            @if(!buscaTurnoMedico($turno->id,$epi->id,$mes,$anio))

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


{{-- MODAL PARA AGREGAR CITA PARA EVOLUCION MEDICA POR DIA --}}
<div class="modal" tabindex="-1" role="dialog" id="agregarCitaMedi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarcitamedicaevo">
                    {{csrf_field()}}
                    <input type="hidden" name="fecha" value="" id="fecha">
                    <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id"_>
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Médico</h5>
                    <select name="medico_id">


                        @foreach($medicos as $medico)
                            @if($medico->user->status->id==1)
                            <option value="{{$medico->id}}">{{$medico->user->last_name}} {{$medico->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="modificarCita">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Cita Evolución Medica</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/modificarcitamedicaevo">
                    {{csrf_field()}}
                    <input type="hidden" name="cita_id" value="" id="cita_id">
                   {{-- <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">--}}
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Médico</h5>
                    <select name="medico_id">


                        @foreach($medicos as $medico)
                            @if($medico->user->status->id==1)
                            <option value="{{$medico->id}}">{{$medico->user->last_name}} {{$medico->user->name}}</option>
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
<div class="modal" tabindex="-1" role="dialog" id="eliminarCita">
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
                <form method="post" action="/eliminarcitamedicaevo">
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
<div class="modal" tabindex="-1" role="dialog" id="eliminardiagramaMedi">
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
                <form method="post" action="/eliminardiagramamedi">
                    {{csrf_field()}}

                    <input type="hidden" name="medical_digrama_id_eli" id="medical_diagrama_id_eli" value="">
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