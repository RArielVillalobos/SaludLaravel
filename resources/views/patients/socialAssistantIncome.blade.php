<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Informe Psicosocial {{ucfirst($psychoIncome->episode->patient->apellido)}} {{ucfirst($psychoIncome->episode->patient->apellido)}}</title>
</head>
<body>
<div class="text text-center logo">
    <img src="img/alegra.jpg">
</div>

<div class="cabezera">

    <p>Nombre y Apellido: {{ ucfirst($psychoIncome->episode->patient->apellido)}} {{ucfirst($psychoIncome->episode->patient->segundo_nombre)}} {{ucfirst($psychoIncome->episode->patient->nombre)}}</p>
    <p>Obra Social: {{strtoupper($psychoIncome->episode->socialWork->nombre)}}</p>
    <p>Episodio: {{$psychoIncome->episode->id}}</p>
    <p>D.N.I: {{$psychoIncome->episode->patient->dni}}</p>
    <p>Edad: {{$edad}}</p>

</div>

<p class="text text-center titulo"><strong>Informe Psicosocial</strong></p>

<p class="subtitulo"><strong>Asistente Social que Realiza:</strong> {{ucfirst($psychoIncome->social_assistant->user->last_name)}} {{ucfirst($psychoIncome->social_assistant->user->name)}}</p>
<p class="subtitulo"><strong>Fecha:</strong> {{$psychoIncome->fecha}}</p>
<p class="subtitulo"><strong>Hora:</strong> {{$psychoIncome->hora}}
<p class="subtitulo"><strong>Vivienda Adecuada:</strong> {{$psychoIncome->social_context->vivienda_adecuada}}
<p class="subtitulo"><strong>Cuidadores:</strong> {{$psychoIncome->social_context->cuidadores}}
<p class="subtitulo"><strong>Cumple Requisitos para Internación Domiciliaria:</strong> {{$psychoIncome->social_context->cumple_requi_int_domiciliaria}}
    <br>
    <br>

 <div>
<p class="subtitulo"><strong>Informe:</strong> {{$psychoIncome->social_context->informe}}</p>

</div>

<br>


</body>
</html>