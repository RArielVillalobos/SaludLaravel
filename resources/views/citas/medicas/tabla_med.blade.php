<?php
//$carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1);
/*$junio=array('2018-05-28',5);
$julio=array('2018-06-25',6);
$agosto=array('2018-07-30',5);
$septiembre=array('2018-08-27',5);
$octubre=array('2018-10-1',5);
$noviembre=array('2018-10-29',5);
$diciembre=array('2018-11-16',5);
if($mes=='09'){
    $arregooMes=array('2018-08-27',5);
}elseif ($mes==10){
    $arregooMes=array('2018-10-1',5);
}





$cantSemanas=$carbon->weekOfMonth;

$int=obtenerIntervaloArregloFechaDadaysumadeSemanas($arregooMes[0],$arregooMes[1]);
//foreach($int as $i){
  //  print_r($i);
    //echo '<br>';
//}



 function getDaysOfWeek($year, $month, $day)
{
    $firstMondayThisWeek = new DateTime($year . '/' . $month . '/' . $day, new DateTimeZone("Europe/Berlin"));
    $firstMondayThisWeek->modify('tomorrow');
    $firstMondayThisWeek->modify('last Monday');

    $nextSevenDays = new DatePeriod(
        $firstMondayThisWeek,
        DateInterval::createFromDateString('+1 day'),
        6
    );

    return $nextSevenDays;
}



$weeksInMonth = \Carbon\Carbon::createFromDate($anio, $mes)->endOfMonth()->weekOfMonth;
$weekBegin = \Carbon\Carbon::createFromDate($anio, $mes)->startOfMonth();

$weeks = [];

for($i=1; $i<=1; $i++)
{
    $collection = new \stdClass();
    $collection->week = $i;
    $collection->days = getDaysOfWeek($anio, $mes, $weekBegin->day);

    $weekBegin->addWeek(0);

    $weeks[] = $collection;
}



     $inicio=$collection->days->start->format('Y-m-d');



$carbon=\Carbon\Carbon::createFromFormat('Y-m-d', $inicio);
//$end=$carbon->addDay(6);
$carbon2=$carbon->addWeeks(5);
print_r($carbon2->format('Y-m-d'));
*/

//$year = \Carbon\Carbon::now()->year;
  //  $date = \Carbon\Carbon::createFromDate($year,$mes);
    //print_r($date->endOfWeek());
/* = \Carbon\Carbon::now();


$dt->isWeekend();*/
$carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
//print_r($carbon->daysInMonth);
$carbon->format('Y,m,d');
$dias=$carbon->endOfMonth()->day;

$totalDiagramaMedi=\App\MedicalDiagram::where('episode_id','=',$ep->id)->where('mes','=',$mes)->where('anio','=',$anio)->get();


//probando
$dt = \Carbon\Carbon::create($anio,$mes, $dias); // day end of month
$numberOfWeeks = $dt->weekOfMonth;
$turnosMedicos=\App\MedicalShift::all();
$medicosActivos=\App\Doctor::where('activo','=',1)->get();

//print_r($numberOfWeeks);









?>

<div class="container">
    <button type="button" class="btn btn-info btn-sm" id="agregarTurno">Agregar otro Turno</button>
    <table class="table table-sm">
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
            <td><p>Turnoss</p></td>
            <?php
            for($i=1; $i<=$dias; $i++){
            $nombreDia=\Carbon\Carbon::createFromDate($anio, $mes, $i, '00');;
            ?>
            <td>{{convertirNombreDiaEnf($nombreDia->localeDayOfWeek)}}</td>

            <?php
            }



            ?>

        </tr>


             <?php

            foreach($totalDiagramaMedi as $diagrama){
                ?>
                <tr>


                <td style="font-size: 12px;">{{$diagrama->episode->patient->apellido}} {{$diagrama->episode->patient->nombre}} - Turno: {{$diagrama->medical_shift->id}} </td>
                <?php
                    for($i=1; $i<=$dias; $i++){
                        $citasDeEsteDiagrama=$diagrama->citas_evolucion_medica;
                        if(count($citasDeEsteDiagrama)<=0){
                            ?>
                        <td style="border: solid 1px"><button class="agregarCitaMediUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}">+</button></td>


                    <?php
                        }
                        foreach($citasDeEsteDiagrama as $cita){
                            $carbon=new \Carbon\Carbon();
                            $fecha=$carbon::createFromFormat('Y-m-d',$cita->citaMedica->fecha);
                            $diaCita=$fecha->day;
                            $mesCita=$fecha->month;
                            $anioCita=$fecha->year;

                            if($diaCita==$i && $mesCita==$mes && $anioCita==$anio ){
                                ?>
                                @if($cita->medicalEvolution==null)
                                    <td class="alert alert-danger" style="border: solid 1px"><p style="margin: 0; padding: 0px">{{$cita->doctor->user->cod_diagrama}}</p>
                                        <button style="font-size: 9px; padding: 1px">Editar</button>
                                    </td>
                                @else
                                    <td class="alert alert-success" style="border: solid 1px">{{$cita->doctor->user->cod_diagrama}}</td>

                                @endif
                           <?php
                            }else
                                ?>
                            <td style="border: solid 1px"><button class="agregarCitaMediUni" data-diagrama="{{$diagrama->id}}" data-fecha="{{$anio.'-'.$mes.'-'.$i}}">+</button></td>

                        <?php
                        }

                        ?>

                <?php
                    }

                ?>

            <?php
            }
            ?>



        </tr>
        </tbody>


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
                <form method="post" action="">
                    {{csrf_field()}}
                    {{-- <input type="hidden" name="fecha" value="" id="fecha">--}}





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
                    <input type="hidden" name="medical_digrama_id" id="medical_diagrama_id">
                    <input type="hidden" name="episode_id" value="{{$epi->id}}" id="episode_id">





                    <h5>Seleccione Médico</h5>
                    <select name="medico_id">


                        @foreach($medicosActivos as $medico)
                            <option value="{{$medico->id}}">{{$medico->user->last}} {{$medico->user->name}}</option>

                        @endforeach

                        {{--@if(!buscaTurnoMedico($diagrama->id,$epi->id,$mes,$anio)) --}}
                        {{-- <option>{{$diagrama->id}}</option>--}}
                    </select>





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
                <form method="post" action="/eliminardiagramamedi">
                    {{csrf_field()}}

                    <input type="hidden" name="medical_diagrama_id" id="medical_diagrama_id" value="">
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



