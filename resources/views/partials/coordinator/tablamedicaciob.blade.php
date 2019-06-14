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
        @php $carbon=\Illuminate\Support\Carbon::parse($ultimaRecetaPaciente->fecha)->format('d-m-Y');  @endphp
        @foreach($ultimaRecetaPaciente->medicines as $item )
                <tr>
                    <td>{{$idpaciente}}</td>
                    <td>{{$nombre}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->pivot->int}}</td>
                    <td>{{$item->pivot->dosis}}</td>

                    <td>{{$carbon}}</td>
                </tr>
        @endforeach
    </tbody>



</table>