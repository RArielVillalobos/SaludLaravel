<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Evolución Médica {{$episode->patient->apellido}} {{$episode->patient->nombre}}</title>
</head>
<body>
<div class="text text-center logo">
    <img src="/img/fix.jpg">
</div>

<div class="cabezera">

    <p>Nombre y Apellido: {{ucfirst($episode->patient->apellido)}} {{ucfirst($episode->patient->segundo_nombre)}} {{ucfirst($episode->patient->nombre)}}</p>
    <p>Obra Social: {{ strtoupper($episode->socialWork->nombre)}}</p>
    <p>Episodio:{{$episode->id}}</p>
    <p>D.N.I: {{$episode->patient->dni}}</p>
    <p>Edad: {{$edad}}</p>
</div>

<p class="text text-center titulo"><strong>Evolución Médica</strong></p>
<p class="subtitulo"><strong>Médico que Realiza:</strong> {{ucfirst($medicalEvolution->citaMedicalEvolution->doctor->user->last_name)}} {{ucfirst($medicalEvolution->citaMedicalEvolution->doctor->user->name)}}</p>
<p class="subtitulo"><strong>Fecha Evolución:</strong> {{$medicalEvolution->fecha}}</p>
<p class="subtitulo"><strong>Hora Evolución:</strong> {{$medicalEvolution->hora}}</p>
<p class="subtitulo"><strong>Turno:</strong> {{$medicalEvolution->citaMedicalEvolution->medicalDiagram->medical_shift->id}}</p>

<div class="signos-vitales">
    <p><strong class="subtitulo">TA: {{$medicalEvolution->ta}}</strong></p>
    <p><strong class="subtitulo">FR: {{$medicalEvolution->fr}}</strong></p>
    <p><strong class="subtitulo">FC: {{$medicalEvolution->fc}}</strong></p>
    <p><strong class="subtitulo">Temp: {{$medicalEvolution->temp}}</strong></p>
    <p><strong class="subtitulo">HGT: {{$medicalEvolution->hgt}}</strong></P>
    <p><strong class="subtitulo">SPO: {{$medicalEvolution->spo}}</strong></P>
    <p><strong class="subtitulo">Diuresis: {{$medicalEvolution->diuresis}}</strong></p>
    <p><strong class="subtitulo">Catarsis: {{$medicalEvolution->catarsis}}</strong></p>
</div>
<br>

<div>
    <p class="subtitulo"><strong>Evolución: </strong>{{$medicalEvolution->evolucion}}</p>

</div>

<br>
<div>
    @if($medicalEvolution->recipe!=null)
        <p class="subtitulo"><strong>Indicaciones Medicas:</strong></p>
        <br>
        <table class="table table-sm">

            <tr>
                <th><p class="subtitulo">Medicación</p></th>
                <th><p class="subtitulo">Dosis</p></th>
                <th><p class="subtitulo">Vía</p></th>
                <th><p class="subtitulo">Int</p></th>
                <th><p class="subtitulo">Observaciones</p></th>
            </tr>


            <tbody>

            @foreach($medicalEvolution->recipe->medicines as $medicine)
                <tr>
                    <td><p class="subtitulo">{{$medicine->nombre}}</p></td>
                    <td><p class="subtitulo">{{$medicine->pivot->dosis}}</p></td>
                    <td><p class="subtitulo">{{$medicine->pivot->via}}</p></td>
                    <td><p class="subtitulo">{{$medicine->pivot->int}}</p></td>
                    <td><p class="subtitulo">{{$medicine->pivot->observaciones}}</p></td>

                </tr>

            @endforeach

            </tbody>


        </table>
    @endif
    <br>


</div>
@if($medicalEvolution->indication!=null)
    <p class="subtitulo"><strong>Otras Indicaciones:</strong></p>

    <table class="table table-sm">
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tbody>


        @foreach($medicalEvolution->indication->treatments as $indicacion)
            <tr>
                <td><p class="subtitulo">{{$indicacion->nombre}}</p></td>
                <td><p class="subtitulo">{{$indicacion->descripcion}}</p></td>
            </tr>
        @endforeach



        </tbody>
    </table>
@endif
</body>
</html>