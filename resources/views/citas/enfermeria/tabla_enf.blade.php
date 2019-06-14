<?php
$carbon=\Carbon\Carbon::createFromDate($anio, $mes, 1, '00');;
//print_r($carbon->daysInMonth);
$carbon->format('Y,m,d');

$dias=$carbon->endOfMonth()->day;
if($turno==0){
    $t='Mañana';
}else{
    $t='Tarde';
}




?>
<div class="container">
    <table class="table table-sm">
        <h4>Turno: {{$t}}</h4>
        <h4>Mes: {{$mes}}</h4>
        <button type="button" class="btn btn-primary btn-sm" data-episodio="{{$ep->id}}">Carga Masiva</button>

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
          <tr>
              <td>
                  <a href="{{$ep}}">{{$ep->patient->nombre}} {{$ep->patient->apellido}}</a>
                  <p>{{$ep->id}}</p>
              </td>
              <?php
              for($i=1; $i<=$dias; $i++){
                  $id=obtenerCitaEnfDiaTurno($mes,$anio,$i,$ep->id,$turno);

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
                      <td style="border:1px solid #A4A4A4; color: white" class="alert bg-danger">{{$nurse->user->cod_diagrama}}</td>
                   @else
                      <td style="border:1px solid #A4A4A4; color:white;"  class="alert btn-success">{{$nurse->user->cod_diagrama}}</td>

                  @endif


                @else
                    <td><a href="#">+</a></td>
                @endif
              <?php
              }


              ?>
          </tr>




        </tbody>

    </table>

</div>
<div class="modal" tabindex="-1" role="dialog" id="agregarCitaEnfMasiva">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carga de Citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="/agregarcitamasivaenf">
                    {{csrf_field()}}
                    <input type="hidden" name="fecha" value="" id="fecha">
                    <input type="hidden" name="episode_id" value="{{$ep->id}}" id="episode">

                    <div class="form-group">
                        <label>Selecciones Enfermero</label>
                        <br>
                        <select name="id_enf">
                            @foreach($enf as $e)
                                <option value="{{$e->id}}">{{$e->user->last_name}} {{$e->user->name}}</option>

                            @endforeach
                        </select>
                        <br>
                        <label>Seleccione Turno</label>
                        <br>
                        <select name="turno">
                            <option value="0" @if($turno=='0') selected @endif>Mañana</option selected>
                            <option value="1" @if($turno=='1') selected @endif >Tarde</option>
                        </select>
                        <br>
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