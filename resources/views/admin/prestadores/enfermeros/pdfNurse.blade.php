<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Listado Enfermeros </title>

</head>
<body>
<div class="text text-center logo">
    <img src="img/alegra.jpg">
</div>
    <h4 class="text text-center">Listado Enfermeros</h4>
    @php
        $activos=[];
        foreach ($enfermeros as $enfermero){
            if($enfermero->user->status_id==1){
                $activos[]=$enfermero;
            }




        }

      $totalActivos=count($activos);

    @endphp
    <label>Total Activos: {{$totalActivos}}</label>
    <table class="table table-sm table-bordered">

        <tr>
            <th class="subtitulo">Nombre y Apellido</th>
            <th class="subtitulo">Domicilio</th>
            <th class="subtitulo">Teléfono</th>
            <th class="subtitulo">Correo</th>
            <th class="subtitulo">Cod Diagrama</th>
            <th class="subtitulo">Mátricula</th>
        </tr>

        <tbody>
            @foreach($enfermeros as $enfermero)
                @if($enfermero->user->status_id==1)
                    <tr>
                        <td><p style="font-size: 12px">{{$enfermero->user->last_name}} {{$enfermero->user->name}}</p></td>
                        <td><p style="font-size: 12px">{{$enfermero->user->domicilio}}</p></td>
                        <td><p style="font-size: 12px">{{$enfermero->user->telefono}}</p></td>
                        <td><p style="font-size: 12px">{{$enfermero->user->email}}</p></td>
                        <td><p style="font-size: 12px">{{$enfermero->cod_diagrama}}</p></td>
                        <td><p style="font-size: 12px">{{strtoupper($enfermero->numero_matricula)}}</p></td>
                    </tr>

                @endif

            @endforeach
        </tbody>


    </table>



</body>
</html>