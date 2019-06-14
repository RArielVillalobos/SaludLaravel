<?php
$carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
//print_r($carbon->daysInMonth);
$carbon->format('Y,m,d');
$dias=$carbon->endOfMonth()->day;
//turno 24 no aplica para turnos de mañana o tarde
$totalDiagramaEnf=\App\NursingDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->where('nursing_shift_id','!=',1)->where('nursing_shift_id','!=',2)->get();

$turnosEnfermeria=\App\NursingShift::where('nombre','=','24')->get();
$diagramaManiana=\App\NursingDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->where('nursing_shift_id','=',1)->get()->first();
$diagramaTarde=\App\NursingDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->where('nursing_shift_id','=',2)->get()->first();
$turnoMañana=\App\NursingShift::where('nombre','=','maniana')->get();
$turnoTarde=\App\NursingShift::where('nombre','=','tarde')->get();
$totalDiagramaEnfermeria= count($totalDiagramaEnf);

//editar cita enfermeria
$enfermerosActivos=\App\Nurse::all();




$dias=$carbon->endOfMonth()->day;
if($turno==1){
    $t='Mañana';
}elseif ($turno==2){
    $t='Tarde';
}else{
    $t='24';
}




?>
<div class="container">
    <table class="table table-sm">
        <h4>Turno: {{$t}}</h4>
        <h4>Mes: {{$mes}}</h4>
        <h5>Nombre Paciente: {{$epi->patient->apellido}} {{$epi->patient->nombre}}</h5>
        {{-- <button type="button" class="btn btn-primary btn-sm" data-episodio="{{$ep->id}}">Carga Masiva</button>--}}
        @if($t=='24')<button style="margin: 2px; " type="button" class="btn btn-warning btn-sm" id="addturno">Agregar Turno</button>@endif
        {{-- boton diagrama turno mañana --}}
        @if($turno==1 && !isset($diagramaManiana))<button style="margin: 2px; " type="button" class="btn btn-warning btn-sm" id="addturnomañana">Generar Diagrama</button>@endif
        {{-- boton diagrama turno tarde --}}
        @if($turno==2 && !isset($diagramaTarde))<button style="margin: 2px; " type="button" class="btn btn-warning btn-sm" id="addturnotarde">Generar Diagrama</button>@endif
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
            <td><p>Turno {{$t}}</p></td>
            <?php
            for($i=1; $i<=$dias; $i++){
            $nombreDia=\Carbon\Carbon::createFromDate($anio, $mes, $i, '00');;
            ?>
            <td>{{convertirNombreDiaEnf($nombreDia->localeDayOfWeek)}}</td>

            <?php
            }



            ?>

        </tr>
        {{--  DIAGRAMA TURNO MAÑANA--}}
        @if($turno==1 && isset($diagramaManiana))
        <tr>
            @php $citasDeEsteDiagramaManiana=$diagramaManiana->citas_enfermeria;  @endphp

            <td>{{$diagramaManiana->episode->patient->apellido}} {{$diagramaManiana->episode->patient->nombre}}</td>
            <?php

            for($i=1; $i<=$dias; $i++){
            $id=obtenerCitaEnFDiaTurnoNew($mes,$anio,$i,$ep->id,$diagramaManiana->nursing_shift->id);

            $citaEnf=\App\CitaEnfermeria::find($id);
            $idNurse=$citaEnf['nurse_id'];
            if(isset($idNurse)){
                $nurse=\App\Nurse::find($idNurse);


            }else{
                $nurse='-';
            }

            ?>
            @if(is_object($nurse))
                @if($citaEnf->nurseEvolution==null)
                    <td style="border:1px solid #A4A4A4; color: black; font-size: 10px" class="alert alert-danger">{{$citaEnf->cita->hora}}<br><strong>{{strtoupper($nurse->cod_diagrama)}}</strong>
                        <button style="font-size: 9px; padding: 1px" data-citaid="{{$citaEnf->id}}">Editar</button>

                        <button class="quitarcita" data-visita_enf="{{$citaEnf->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}" data-diagramaenf_id="{{$diagramaManiana->nursing_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>
                    </td>

                @else
                    <td style="border:1px solid #A4A4A4; color: black; font-size: 10px"  class="alert alert-success"><strong>{{strtoupper($nurse->cod_diagrama)}}</strong>
                        <button class="s" data-cita_id_ver="{{$citaEnf->id}}" style="font-size: 9px; padding: 1px">
                            <a style="color:black" href="/pdf/evolucionesenfermeria/{{$citaEnf->nurseEvolution->id}}">Ver</a>
                        </button>
                    </td>

                @endif


            @else
                <td><button href="#" data-diagrama_id="{{$diagramaManiana->id}}" data-dia="{{$i}}">+</button></td>




            @endif
            <?php

            }



            ?>
            {{--<td><button type="button" class="btn btn-primary btn-sm" data-episodio="{{$ep->id}}" data-diagrama-enf="{{$diagramaManiana->id}}" data-info="{{$diagramaManiana->nursing_shift}}">Diagramar</button></td> --}}
            @if(count($citasDeEsteDiagramaManiana)==0)<td><button class="eliminardiagramaenf btn btn-danger btn-sm" data-diagramaenf_id="{{$diagramaManiana->id}}" >Eliminar Diagrama</button></td>@endif
        </tr>
        @endif

        {{-- Diagrama turno tarde--}}
        @if($turno==2 && isset($diagramaTarde))
            <tr>
                @php $citasDeEsteDiagramaTarde=$diagramaTarde->citas_enfermeria;  @endphp
                <td>{{$diagramaTarde->episode->patient->apellido}} {{$diagramaTarde->episode->patient->nombre}}</td>
                <?php
                for($i=1; $i<=$dias; $i++){
                $id=obtenerCitaEnFDiaTurnoNew($mes,$anio,$i,$ep->id,$diagramaTarde->nursing_shift->id);

                $citaEnf=\App\CitaEnfermeria::find($id);
                $idNurse=$citaEnf['nurse_id'];
                if(isset($idNurse)){
                    $nurse=\App\Nurse::find($idNurse);


                }else{
                    $nurse='-';
                }

                ?>
                @if(is_object($nurse))
                    @if($citaEnf->nurseEvolution==null)
                        <td style="border:1px solid #A4A4A4; color: black; font-size: 10px" class="alert alert-danger">{{$citaEnf->cita->hora}}<br><strong>{{strtoupper($nurse->cod_diagrama)}}</strong>
                            <button style="font-size: 9px; padding: 1px" data-citaid="{{$citaEnf->id}}">Editar</button>
                            <button class="quitarcita" data-visita_enf="{{$citaEnf->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}" data-diagramaenf_id="{{$diagramaTarde->nursing_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>
                        </td>


                    @else
                        <td style="border:1px solid #A4A4A4; color:white;"  class="alert alert-success">{{$nurse->cod_diagrama}}
                            <button class="s"  data-cita_id_ver="{{$citaEnf->id}}" style="font-size: 9px; padding: 1px;">
                                <a style="color:black" href="/pdf/evolucionesenfermeria/{{$citaEnf->nurseEvolution->id}}">Ver</a>
                            </button>


                        </td>

                    @endif



                @else
                    <td><button href="#" data-diagrama_id="{{$diagramaTarde->id}}" data-dia="{{$i}}">+</button></td>




                @endif
                <?php

                }



                ?>
                {{--<td><button type="button" class="btn btn-primary btn-sm" data-episodio="{{$ep->id}}" data-diagrama-enf="{{$diagramaTarde->id}}" data-info="{{$diagramaTarde->nursing_shift}}">Diagramar</button></td> --}}
                @if(count($citasDeEsteDiagramaTarde)==0)<td><button class="eliminardiagramaenf  btn btn-danger btn-sm" data-diagramaenf_id="{{$diagramaTarde->id}}" >Eliminar Diagrama</button></td>@endif
            </tr>
        @endif






        {{-- diagrama para 24 horas --}}
        <?php

        if($t=='24'){


        for($j=0; $j<$totalDiagramaEnfermeria; $j++){

            ?>
        <tr>
            @php $citasDeEsteDiagrama24=$totalDiagramaEnf[$j]->citas_enfermeria;  @endphp
            <td><p style="font-size: 11px; margin: 0px">{{$totalDiagramaEnf[$j]->episode->patient->apellido}} {{$totalDiagramaEnf[$j]->episode->patient->nombre}}</p><strong style="font-size: 11px">{{$totalDiagramaEnf[$j]->nursing_shift->hora_desde }} -{{$totalDiagramaEnf[$j]->nursing_shift->hora_hasta}}</strong></td>
            <?php
            for($i=1; $i<=$dias; $i++){
            $id=obtenerCitaEnFDiaTurnoNew($mes,$anio,$i,$ep->id,$totalDiagramaEnf[$j]->nursing_shift->id);

            $citaEnf=\App\CitaEnfermeria::find($id);
            $idNurse=$citaEnf['nurse_id'];
            if(isset($idNurse)){
                $nurse=\App\Nurse::find($idNurse);


            }else{
                $nurse='-';
            }

            ?>
            @if(is_object($nurse))
                @if($citaEnf->nurseEvolution==null)
                    <td style="border:1px solid #A4A4A4; color: black; font-size: 9px" class="alert alert-danger">{{$citaEnf->cita->hora}}<br><strong>{{strtoupper($nurse->cod_diagrama)}}</strong>
                        <button style="font-size: 9px; padding: 1px" data-citaid="{{$citaEnf->id}}">Editar</button>
                        <button class="quitarcita" data-visita_enf="{{$citaEnf->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}" data-diagramaenf_id="{{$totalDiagramaEnf[$j]->nursing_shift->id}}" style="font-size: 9px; padding: 1px">Quitar</button>

                    </td>
                @else
                    <td style="border:1px solid #A4A4A4; color: black; font-size: 10px"  class="alert alert-success">{{$citaEnf->cita->hora}}<br><strong>{{strtoupper($nurse->cod_diagrama)}}</strong>

                    </td>

                @endif


            @else
                <td><button href="#" data-diagrama_id="{{$totalDiagramaEnf[$j]->id}}" data-dia="{{$i}}">+</button></td>




            @endif
            <?php

            }



            ?>


         {{--<td><button type="button" class="btn btn-primary btn-sm" data-episodio="{{$ep->id}}" data-diagrama-enf="{{$totalDiagramaEnf[$j]->id}}" data-info="{{$totalDiagramaEnf[$j]->nursing_shift}}">Diagramar</button></td> --}}

            @if(count($citasDeEsteDiagrama24)==0)<td><button class="eliminardiagramaenf  btn btn-danger btn-sm" data-diagramaenf_id="{{$totalDiagramaEnf[$j]->id}}" >Eliminar Diagrama</button></td>@endif
        </tr>

        <?php
        }

       }
        ?>





        </tbody>

    </table>

</div>
<div class="modal" tabindex="-1" role="dialog" id="diagramarenfermeria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Diagramador</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="/diagramadorenfermeria">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">
                    <input type="hidden" name="nursing_diagram_id" value="" id="nursing_diagram">
                    <div id="info-diagramaenf">
                        <h4>Turno:</h4>

                    </div>
                    <div class="form-group">
                        <label>Selecciones Enfermero</label>
                        <br>
                        <select name="id_enf">
                            @foreach($enf as $e)
                                <option value="{{$e->id}}">{{$e->user->last_name}} {{$e->user->name}}</option>

                            @endforeach
                        </select>
                        <br>
                        {{-- <label>Seleccione Turno</label>
                        <br>
                        <select name="turno">
                            <option value="0" @if($turno=='0') selected @endif>Mañana</option selected>
                            <option value="1" @if($turno=='1') selected @endif >Tarde</option>
                        </select>
                        <br>--}}
                        <br>
                        <label>Desde:</label>

                        <input type="date" name="fecha_desde" value="{{$anio.'-'.$mes.'-'.'01'}}">
                        <br>
                        <br>

                        <label>Hasta:</label>

                        <input type="date" name="fecha_hasta" value="{{$anio.'-'.$mes.'-'.$dias}}">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- Turno 24--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarturnoepi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cargar Turno al Episodio</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="/agregarturnoenfermeriaepiosdio">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">

                    <div id="info-diagramaenf">
                        <h4>Turno:</h4>
                        <select name="turno_id">
                            @foreach($turnosEnfermeria as $turno)
                                {{$turno}}
                                @if(!buscaTurnoEnfermeria($turno->id,$epi->id,$mes,$anio))
                                    <option value="{{$turno->id}}">{{$turno->hora_desde}} {{$turno->hora_hasta}}</option>
                                @endif

                            @endforeach
                        </select>


                    </div>
                    <div class="form-group">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{--MODAL PARA AGREGAR TURNO MAÑANA--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarturnomañanaenfermeria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccione Horario</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarturnomañanaenfermeria">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">

                    <div id="info-diagramaenf">
                        <h4>Turno:</h4>
                        <select name="turno_id">
                            @foreach($turnoMañana as $turno)
                                <option value="{{$turno->id}}">{{$turno->hora_desde}} {{$turno->hora_hasta}}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="form-group">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{--MODAL PARA AGREGAR TURNO Tarde--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarturnotardeenfermeria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccione Horario</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarturnotardeenfermeria">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">

                    <div id="info-diagramaenf">
                        <h4>Turno:</h4>
                        <select name="turno_id">
                            @foreach($turnoTarde as $turno)
                                <option value="{{$turno->id}}">{{$turno->hora_desde}} {{$turno->hora_hasta}}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="form-group">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- MODAL PARA EDITAR CITA ENFERMERIA(ENFERMERO) --}}
<div class="modal" tabindex="-1" role="dialog" id="cambiarenfermero">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cita Enfermeria</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/editarcitaenfermeria">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">
                    {{-- <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">--}}
                    <input type="hidden" name="cita_id" value="" id="cita">

                    <div id="info-diagramaenf">
                        <h4>Seleccione Enfermero</h4>
                        <select name="nurse_id">
                            @foreach($enfermerosActivos as $enfermero)
                                <option value="{{$enfermero->id}}">{{$enfermero->user->last_name}} {{$enfermero->user->name}}</option>
                            @endforeach
                        </select>



                    </div>
                    <br>
                    <div class="form-group">
                        <input type="time" name="hora">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- MODAL PARA CITA ENFERMERIA UNITARIA--}}
<div class="modal" tabindex="-1" role="dialog" id="agregarcitaunitaria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Cita Enfermeria</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/agregarcitaenfermeria">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}
                    <input type="hidden" name="nursing_diagram_id" value="" id="nursing_diagram_id">
                    <input type="hidden" name="mes" value="{{$mes}}">
                    <input type="hidden" name="anio" value="{{$anio}}">
                    <input type="hidden" name="dia" value="" id="dia">
                    <input type="hidden" name="episode" value="{{$ep->id}}">



                    <div id="info-diagramaenf">
                        <h4>Seleccione Enfermero</h4>
                        <select name="nurse_id">
                            @foreach($enfermerosActivos as $enfermero)
                                <option value="{{$enfermero->id}}">{{$enfermero->user->last_name}} {{$enfermero->user->name}}</option>
                            @endforeach
                        </select>



                    </div>
                    <br>
                    <div class="form-group">
                        <input type="time" name="hora">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>

{{-- MODAL PARA ELIMINAR CITA --}}
<div class="modal" tabindex="-1" role="dialog" id="eliminarCitaEnf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cita para Evolución Enfermeria</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contenido">
                    <p id="turno_eli"></p>

                    <p id="fecha_eli"></p>

                </div>
                <form method="post" action="/eliminarcitaenf">
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
<div class="modal" tabindex="-1" role="dialog" id="eliminardiagramaEnf">
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
                <form method="post" action="/eliminardiagramaenf">
                    {{csrf_field()}}

                    <input type="hidden" name="nursing_digrama_id_eli" id="nursing_diagrama_id_eli" value="">
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

