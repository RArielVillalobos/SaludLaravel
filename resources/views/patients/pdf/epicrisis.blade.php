<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Epicrisis {{ucfirst($epicrisis->episode->patient->apellido)}} {{ucfirst($epicrisis->episode->patient->nombre)}}</title>
</head>
<body>
<div class="text text-center logo">
    <img src="img/fix.jpg">
</div>

<div class="cabezera">

    <p>Nombre y Apellido: {{ucfirst($epicrisis->episode->patient->apellido)}} {{ucfirst($epicrisis->episode->patient->segundo_nombre)}} {{ucfirst($epicrisis->episode->patient->nombre)}}</p>
    <p>Obra Social: {{strtoupper($epicrisis->episode->SocialWork->nombre)}}</p>
    <p>Episodio:{{$epicrisis->episode->id}}</p>
    <p>D.N.I: {{$epicrisis->episode->patient->dni}}</p>
    <p>Edad: {{$edad}}</p>
</div>

<p class="text text-center titulo"><strong>Epicrisis</strong></p>
<p class="subtitulo"><strong>Médico:</strong> {{ucfirst($epicrisis->doctor->user->last_name)}} {{ucfirst($epicrisis->doctor->user->name)}}</p>
<p class="subtitulo"><strong>Fecha Internación:</strong>
<p class="subtitulo"><strong>Fecha Epicrisis:</strong> {{$epicrisis->fecha_epicrisis}}</p>
<p class="subtitulo"><strong>Hora Epicrisis:</strong> {{$epicrisis->hora_epicrisis}}</p>

<p class="subtitulo"><strong>Diagnostico Egreso:</strong> {{$epicrisis->diagnostico_egreso}}</p>
<p class="subtitulo"><strong>Motivo de Egreso</strong>
    <br>
    <strong>Por Alta Internacion:</strong>
    <br>
    <strong>Por Fallecimiento:</strong> {{strtoupper($epicrisis->fallecimiento)}}
    <br>
    <strong>Derivación a Internación Nosocomial:</strong> {{strtoupper($epicrisis->derivacion_int_nosocomial)}}
    <br>
    <strong>Institucion:</strong>{{$epicrisis->institucion}}
    <br>
    <strong>Causa Derivación:</strong> {{$epicrisis->causa_derivacion}}
    <br>
    <strong>Observaciones:</strong> {{$epicrisis->observaciones}}
    <br>
    <strong>Epicrisis:</strong> {{$epicrisis->epicrisis}}
    <br>


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


<br>


</body>
</html>