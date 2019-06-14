@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">

        <div class="panel-heading">Evoluciones</div>
        <div class="panel-body">
            <form method="post" action="{{route('evoluciones.search')}}">
                {{csrf_field()}}
                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">

                            <label>Seleccione Evolucion</label>
                            <select class="form-control" name="tipo_evolucion">
                                <option value="1" @if(isset($tipoEvo) && $tipoEvo==1) selected @endif>Evoluciones Médicas </option>
                                <option value="2" @if(isset($tipoEvo) && $tipoEvo==2) selected @endif>Evoluciones Enfermeria</option>
                            </select>
                            <br>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <label>Introduzca Apellido Paciente</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchname" name="searchname" value="{{isset($nombre) ? $nombre : ''}}" placeholder="Ingrese Apellido Paciente" required>

                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Filtrar por Fecha Especifica</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{isset($fecha) ? $fecha : ''}}">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Filtrar por Mes y Año</label>
                            <input id="mes" type="month" name="mes"  class="form-control" value="{{isset($mesAnio)? $mesAnio : ''}}">
                        </div>


                    </div>

                    <br>
                    <div class="col-md-4">
                        <input type="hidden" name="id" id="id" class="form-control" value="{{(isset($idEpi)?$idEpi:'')}}">
                        <button type="submit" class="btn btn-info">Buscar</button>
                    </div>



                </div>
            </form>



        </div>

        @if(isset($evolucionesMedicas))
            @include('partials.coordinator.evoluciones.resultado_busqueda_medica',['evolucionesMedicas'=>$evolucionesMedicas,'nombre'=>$nombre,'fecha'=>$fecha,'mesAnio'=>$mesAnio])
        @endif
        @if(isset($evolucionesEnfermeria))
            @include('partials.coordinator.evoluciones.resultado_busqueda_enfermeria',['evolucionesEnfermeria'=>$evolucionesEnfermeria,'nombre'=>$nombre,'fecha'=>$fecha,'mesAnio'=>$mesAnio])

        @endif
     </div>





@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/coordinacion/busqueda_evo.js"></script>


    <script>
        $('#searchname').autocomplete({
            source: "{{route('autocomplete')}}",
            minlength:1,
            autoFocus:true,
            select:function (e,ui) {
                $('#id').val(ui.item.id);


            }

        });

    </script>

@endsection
