<br>
<label><strong>Ultimas(20) Indicaciones Medicas Cargadas</strong></label>
<table class="table-responsive table table-sm">



    <thead>

    <tr>

        <th>Id Ep</th>
        <th>Paciente</th>

        <th>Medicación</th>
        <th>Intervalo</th>
        <th>Dosis</th>
        <th>Fecha</th>

    </tr>

    </thead>
    <tbody>


    @foreach($ultimasRecetas as $receta )





               @foreach($receta->medicines as $item )

                   <tr>
                       <td>{{$receta->episode->id}}</td>
                       <td>{{$receta->episode->patient->apellido}} {{$receta->episode->patient->nombre}} {{$receta->episode->patient->segundo_nombre}}</td>

                       <td>{{$item->nombre}}</td>
                       <td>{{$item->pivot->int}}</td>
                       <td>{{$item->pivot->dosis}}</td>
                       <td>{{$receta->fecha}}</td>


                   </tr>
               @endforeach









    @endforeach


    </tbody>



</table>