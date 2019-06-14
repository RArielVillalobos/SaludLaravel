<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Evolución Asistente Social {{ucfirst($episode->patient->apellido)}} {{ucfirst($episode->patient->nombre)}}</title>
</head>
<body>
<div class="text text-center logo">
    <img src="img/fix.jpg">
</div>

<div class="cabezera">

    <p>Nombre y Apellido: {{ ucfirst($episode->patient->apellido)}} {{ucfirst($episode->patient->segundo_nombre)}} {{ucfirst($episode->patient->nombre)}}</p>
    <p>Obra Social: {{strtoupper($episode->socialWork->nombre)}}</p>
    <p>Episodio: {{$episode->id}}</p>
    <p>D.N.I: {{$episode->patient->dni}}</p>
    <p>Edad: {{$edad}}</p>
</div>

<p class="text text-center titulo"><strong>Evolución Asistente Social</strong></p>

<p class="subtitulo"><strong>Psicologo que Realiza:</strong> {{ucfirst($asisEvolution->cita_asis_social->asis_social->user->last_name)}} {{ucfirst($asisEvolution->cita_asis_social->asis_social->user->name)}}</p>
<p class="subtitulo"><strong>Fecha Evolución:</strong> {{$asisEvolution->cita_asis_social->cita->fecha}}</p>
<p class="subtitulo"><strong>Turno</strong> {{$asisEvolution->cita_asis_social->SocialAssistantDiagram->asis_social_shift->id}}</p>
<p class="subtitulo"><strong>Hora Evolución:</strong> {{$asisEvolution->cita_asis_social->cita->hora}}


    <br>

    <div>
<p class="subtitulo"><strong>Evolución: </strong>{{$asisEvolution->evolucion}}</p>

</div>

<br>


</body>
</html>