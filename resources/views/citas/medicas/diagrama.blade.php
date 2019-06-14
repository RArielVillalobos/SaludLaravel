@php
    $mesActual=\Carbon\Carbon::now();
    $mesActual=$mesActual->month;

@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Diagrama Medico</title>
</head>
<body>
<br>

<div class="container">

    <button class="btn btn-primary btn-sm" ><a style="color: white" href="/home">Volver</a></button>
    <br>
    <h4>Diagrama Medico</h4>
    <table>
        <h5>Códigos Diagrama</h5>
        <hr>


        <tr>
            @foreach($medicos as $medico)
                @if($medico->user->status->id==1)
                <td style="border:0.5px solid; padding: 1px; margin: 1px; font-size: 10px;">{{$medico->user->last_name}} {{$medico->user->name}}: <strong style="font-size: 12px">{{$medico->cod_diagrama}}</strong> </td>
                @endif
            @endforeach
        </tr>
    </table>
    <hr>

    <div class="row">



        <div class="col-sm">
            <form method="get">



                <label>Seleccione Mes</label>
                <br>
                <select name="mes">
                    <option>Seleccione Mes</option>
                    <option value="01" @if($mes=='01') selected @endif>Enero</option>
                    <option value="02" @if($mes=='02') selected @endif>Febrero</option>
                    <option value="03" @if($mes=='03') selected @endif>Marzo</option>
                    <option value="04" @if($mes=='04') selected @endif>Abril</option>
                    <option value="05" @if($mes=='05') selected @endif>Mayo</option>
                    <option value="06" @if($mes=='06') selected @endif>Junio</option>
                    <option value="07" @if($mes=='07') selected @endif>Julio</option>
                    <option value="08" @if($mes=='08') selected @endif>Agosto</option>
                    <option value="09" @if($mes=='09') selected @endif>Septiembre</option>
                    <option value="10" @if($mes=='10') selected @endif>Octubre</option>
                    <option value="11" @if($mes=='11') selected @endif>Noviembre</option>
                    <option value="12" @if($mes=='12') selected @endif>Diciembre</option>

                </select>

        </div>
        <div class="col-sm">
            <label>Seleccione Año</label>
            <br>
            <select name="anio">
                <option value="2018">2018</option>
                <option value="2019">2019</option>
            </select>

        </div>
        <div class="col-sm">
            <label>Seleccione Paciente</label>
            <br>


            <select name="episodio">
                <option>Seleccione Episodio</option>
                @foreach($episodiosActivos as $episodio)

                    <option value="{{$episodio->id}}" @if(isset($epi))@if($epi->id==$episodio->id) selected @endif @endif>{{$episodio->patient->nombre}} {{$episodio->patient->apellido}}  -  id:{{$episodio->id}} </option>
                @endforeach
            </select>


        </div>

        <br>




    </div>
    <br>
    <p class="text text-center">
        <button type="submit" class="btn btn-success btn-sm">Cargar</button>

    </p>

    </form>
</div>

@if(isset($mes) && isset($anio) && isset($epi))

    @include('citas.medicas.tabla_med2',['mes'=>$mes,'anio'=>$anio,'ep'=>$epi])
@endif

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/diagramas/medico/agregarCitaUnitaria.js"></script>

</body>
</html>