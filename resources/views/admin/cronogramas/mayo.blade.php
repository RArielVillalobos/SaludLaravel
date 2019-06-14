
<h4>Cronograma {{$mes}}</h4>


<?php



 $intervalo=obtenerIntervaloArregloFechaDadaysumadeSemanas($arregloMes[0],$arregloMes[1]);
$semana1=$intervalo[0];
$semana2=$intervalo[1];
$semana3=$intervalo[2];
$semana4=$intervalo[3];
$semana5=$intervalo[4];




?>


<table  class="table">
    <p>{{$mes}}</p>
        <tr>
          <th scope="col">Semanas:{{$arregloMes[1]}}</th>
            <th scope="col"><?php echo primerdiaSemanax($semana1) . ' al ' .ultimodiaSemanax($semana1)?></th>
            <th scope="col"><?php echo primerdiaSemanax($semana2) . ' al ' . ultimodiaSemanax($semana2)?></th>
            <th scope="col"><?php echo primerdiaSemanax($semana3) . ' al ' . ultimodiaSemanax($semana3)?></th>
            <th scope="col"><?php echo primerdiaSemanax($semana4) . ' al ' . ultimodiaSemanax($semana4)?></th>
            <th scope="col"><?php echo primerdiaSemanax($semana5) . ' al ' . ultimodiaSemanax($semana5)?></th>


        </tr>


        @foreach($episodiosActivos as $episode)
            <tr>




                <td>{{$episode->patient->apellido}} {{$episode->patient->nombre}}</td>
                {{dd('hola')}}



                <?php $citas=$episode->citas?>


                <?php if(semanax($semana1,$citas[0]->fecha)==1){
                echo '<td>'.$episode->doctor->user->name.'</td>';
                }?>

                <?php if(semanax($semana2,$citas[1]->fecha)==1){
                echo '<td>'.$citas[0]->doctor->user->name.'</td>';

                }?>
                <?php if(semanax($semana3,$citas[2]->fecha)==1){
                    echo '<td>'.$citas[2]->doctor->user->name.'</td>';

                }else{ echo '<td>'.$citas[2]->doctor->user->name.'<td>';}?>




            </tr>



        @endforeach





</table>


