<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Informe Médico {{$episode->patient->apellido}} {{$episode->patient->nombre}}</title>
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
    <p class="text text-center titulo"><strong>Historia Clinica</strong></p>
    <p class="subtitulo"><strong>Médico que Realiza:</strong> {{ucfirst($informeMedico->doctor->user->last_name)}} {{ucfirst($informeMedico->doctor->user->name)}}</p>
    <p class="subtitulo"><strong>Fecha Evaluación:</strong> {{$informeMedico->fecha}}</p>
     <p class="subtitulo"><strong>Hora Evaluación:</strong> {{$informeMedico->hora}}</p>



    <div class="signos-vitales">

        <p><strong class="subtitulo">FR:{{$informeMedico->fr}}</strong></p>
        <p><strong class="subtitulo">FC:{{$informeMedico->fc}}</strong></p>
        <p><strong class="subtitulo">FC:{{$informeMedico->fc}}</strong></p>
        <p><strong class="subtitulo">Temp:{{$informeMedico->temp}}</strong></p>
        <p><strong class="subtitulo">HGT:{{$informeMedico->hgt}}</strong></P>
        <p><strong class="subtitulo">SPO:{{$informeMedico->spo}}</strong></P>
        <p><strong class="subtitulo">Diuresis:{{$informeMedico->diuresis}}</strong></p>
        <p><strong class="subtitulo">Catarsis:{{$informeMedico->catarsis}}</strong></p>
    </div>
    <br>

    <div>
        <p class="subtitulo"><strong>Antecedentes: </strong>{{$informeMedico->antecedentes}}</p>
        <p class="subtitulo"><strong>Enfermedad Actual: </strong>{{$informeMedico->antecedentes}}</p>
        {{--<p class="subtitulo"><strong>Diágnosticos (activos y pasivos): </strong>{{$informeMedico->diagnostico_activo}} {{$informeMedico->diagnostico_pasivo}}</p> --}}

    </div>

    <br>
    <div>
        <p class="subtitulo"><strong>Requerimientos:</strong></p>
        {{--<p class="subtitulo"><strong>Tipo de Internación:</strong></p> --}}

        <p class="subtitulo"><strong>Prestaciones Médicas: </strong> {{$provision->medical_provision->valor}} por  {{$provision->medical_provision->tipo}}</p>
        <p class="subtitulo"><strong>Prestaciones Enfermería:</strong> {{$provision->nursing_provision->valor}} por {{$provision->nursing_provision->tipo}} </p>
        <p class="subtitulo"><strong>Prestaciones Kinesiología:</strong> {{$provision->kinesiology_provision->valor}} por {{$provision->kinesiology_provision->tipo}} </p>
        <p class="subtitulo"><strong>Prestaciones Psicología:</strong> {{$provision->psycology_provision->valor}} por {{$provision->psycology_provision->tipo}}</p>
        {{-- <p class="subtitulo"><strong>Prestaciones Rehabilitación:</strong></p>--}}
    </div>
    <br>
     {{--- <div>
         <p class="subtitulo"><strong>Contexto Psicosocial:</strong></p>
         <p class="subtitulo"><strong>Vivienda Adecuada:</strong> {{$informeMedico->socialContext->vivienda_adecuada}}</p>
         <p class="subtitulo"><strong>Cuidadores:</strong> {{$informeMedico->socialContext->cuidadores}}</p>
         <p class="subtitulo"><strong>Cumple Requisitos para Internacion Domiciliaria:</strong> {{$informeMedico->socialContext->cumple_requi_int_domiciliaria}}</p>

     </div>--}}
     <br>
     <div>

         @if($informeMedico->recipe!=null)
          <p class="subtitulo"><strong>Indicaciones:</strong></p>
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

             @foreach($informeMedico->recipe->medicines as $medicine)
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
         <br>
         @endif


     </div>

     @if($informeMedico->indication!=null)
      <p class="subtitulo"><strong>Otras Indicaciones:</strong></p>
     <table class="table table-sm">
         <tr>
             <th></th>
             <th></th>
         </tr>
         <tbody>


            @foreach($informeMedico->indication->treatments as $indicacion)
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