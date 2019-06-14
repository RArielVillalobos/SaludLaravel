<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cambios.css">
    <title>Listado Administración </title>

</head>
<body>
<div class="text text-center logo">
    <img src="img/alegra.jpg">
</div>
<h4 class="text text-center">Listado Administración</h4>
@php
    $activos=[];
    foreach ($admines as $admin){
        if($admin->status_id==1){
            $activos[]=$admin;
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

    </tr>

    <tbody>
    @foreach($admines as $admin)
        @if($admin->status_id==1)
            <tr>
                <td><p style="font-size: 12px">{{$admin->last_name}} {{$admin->name}}</p></td>
                <td><p style="font-size: 12px">{{$admin->domicilio}}</p></td>
                <td><p style="font-size: 12px">{{$admin->telefono}}</p></td>
                <td><p style="font-size: 12px">{{$admin->email}}</p></td>

            </tr>

        @endif

    @endforeach
    </tbody>


</table>



</body>
</html>