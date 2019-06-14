@extends('layouts.app')
@section('content')
<h2>Cronograma Medico</h2>
<form method="post" action="/cargarcronomedico">
    {{csrf_field()}}
    <label>Mes</label>
    <select name="mes">
        <option value="enero">Enero</option>
        <option value="febrero">Febrero</option>
        <option value="marzo">Marzo</option>
        <option value="abril">Abril</option>
        <option value="mayo">Mayo</option>
        <option value="junio">Junio</option>
        <option value="julio">Julio</option>
        <option value="agosto">agosto</option>
        <option value="septiembre">Septiembre</option>
        <option value="octubre">Octubre</option>
        <option value="noviembre">Noviembre</option>
        <option value="diciembre">Diciembre</option>
    </select>

    <label>Año</label>
    <select name="anio">
        <option value="2018">2018</option>
    </select>
    <button type="submit" class="btn btn-primary">Cargar</button>
</form>
@if(isset($mes) && isset($arregloMes))
    @include('admin.cronogramas.'.$mes,['mes'=>$mes,'arregloMes'=>$arregloMes])
@endif

@endsection