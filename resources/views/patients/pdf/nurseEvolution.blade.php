@php
if($nurseEvolution->cita_enfermeria->nursing_diagram->nursing_shift->id==1){
    $turno='Mañana';
}elseif ($nurseEvolution->cita_enfermeria->nursing_diagram->nursing_shift->id==2){
     $turno='Tarde';
}else{
      $turno='24 hrs: '.$nurseEvolution->cita_enfermeria->nursing_diagram->nursing_shift->hora_desde.' -- '.$nurseEvolution->cita_enfermeria->nursing_diagram->nursing_shift->hora_hasta;
    }


@endphp

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Evolución Enfermeria {{$episode->patient->apellido}} {{$episode->patient->nombre}}</title>
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

<p class="text text-center titulo"><strong>Evolución Enfermeria</strong></p>
<p class="subtitulo"><strong>Enfermero que Realiza:</strong> {{ucfirst($nurseEvolution->cita_enfermeria->nurse->user->last_name)}} {{ucfirst($nurseEvolution->cita_enfermeria->nurse->user->name)}}</p>
<p class="subtitulo"><strong>Turno:</strong> {{$turno}}</p>
<p class="subtitulo"><strong>Fecha Evolución:</strong> {{$nurseEvolution->cita_enfermeria->cita->fecha}}</p>
<p class="subtitulo"><strong>Hora Evolución:</strong> {{$nurseEvolution->cita_enfermeria->cita->hora}}</p>

<div class="signos-vitales">
    <p><strong class="subtitulo">TA: {{$nurseEvolution->ta}}</strong></p>
    <p><strong class="subtitulo">FR: {{$nurseEvolution->fr}}</strong></p>
    <p><strong class="subtitulo">FC: {{$nurseEvolution->fc}}</strong></p>
    <p><strong class="subtitulo">Temp:{{$nurseEvolution->temp}}</strong></p>
    <p><strong class="subtitulo">HGT: {{$nurseEvolution->hgt}}</strong></P>
    <p><strong class="subtitulo">SPO: {{$nurseEvolution->spo}}</strong></P>
    <p><strong class="subtitulo">Diuresis: {{$nurseEvolution->diuresis}}</strong></p>
    <p><strong class="subtitulo">Catarsis: {{$nurseEvolution->catarsis}}</strong></p>
</div>
<br>

<div>
    <p class="subtitulo"><strong>Evolución: </strong>{{$nurseEvolution->evolucion}}</p>

</div>

<br>


</body>
</html>