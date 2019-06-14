<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Evolución Kinesiología {{$episode->patient->apellido}} {{$episode->patient->nombre}}</title>
</head>
<body>
<div class="text text-center logo">
    <img src="img/fix.jpg">
</div>

<div class="cabezera">

    <p>Nombre y Apellido: {{ucfirst($episode->patient->apellido)}} {{ucfirst($episode->patient->segundo_nombre)}} {{ucfirst($episode->patient->nombre)}}</p>
    <p>Obra Social: {{strtoupper($episode->SocialWork->nombre)}}</p>
    <p>Episodio:{{$episode->id}}</p>
    <p>D.N.I: {{$episode->patient->dni}}</p>
    <p>Edad: {{$edad}}</p>
</div>

<p class="text text-center titulo"><strong>Evolución Kinesiología</strong></p>
<p class="subtitulo"><strong>Kinesiologo Realiza:</strong> {{ucfirst($kineEvolution->cita_kinesiologia->kinesiologist->user->last_name)}} {{ucfirst($kineEvolution->cita_kinesiologia->kinesiologist->user->name)}}</p>
<p class="subtitulo"><strong>Fecha Evolución:</strong> {{$kineEvolution->cita_kinesiologia->cita->fecha}}</p>
<p class="subtitulo"><strong>Turno:</strong> {{$kineEvolution->cita_kinesiologia->KinesiologyDiagram->kinesiology_shift->id}}</p>
<p class="subtitulo"><strong>Hora Evolución:</strong> {{$kineEvolution->cita_kinesiologia->cita->hora}}</p>

{{-- <div class="signos-vitales">
    <p><strong class="subtitulo">TA:</strong></p>
    <p><strong class="subtitulo">FR:</strong></p>
    <p><strong class="subtitulo">FC:</strong></p>
    <p><strong class="subtitulo">FC:</strong></p>
    <p><strong class="subtitulo">Temp:</strong></p>
    <p><strong class="subtitulo">HGT:</strong></P>
    <p><strong class="subtitulo">SPO:</strong></P>
    <p><strong class="subtitulo">Diuresis:</strong></p>
    <p><strong class="subtitulo">Catarsis:</strong></p>
</div>--}}
<br>

<div>
    <p class="subtitulo"><strong>Evolución: </strong>{{$kineEvolution->evolucion}}</p>

</div>

<br>


</body>
</html>