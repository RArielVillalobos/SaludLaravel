@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Indicaciones Médicas</div>
        <div class="panel-body">
            <h4>Seleccione un paciente realizar la busqueda</h4>
            <p>Se buscara la medicacion recetada actualmente</p>
            <form method="get" action="/farmacia/buscamedicacion">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" id="searchname" name="searchname" value="{{(isset($nombre)?$nombre:'')}}" placeholder="Ingrese Apellido Paciente">

                </div>



                   <input type="hidden" name="id" id="id" class="form-control" value="{{(isset($idpaciente)?$idpaciente:'')}}">
                   <button class="btn btn-success btn-sm" type="submit">Buscar</button>


            </form>



           @if(isset($ultimaRecetaPaciente))
                @include('partials.coordinator.tablamedicaciob',['ultimaRecetaPaciente'=>$ultimaRecetaPaciente])

           @elseif(isset($ultimasRecetas))

               @include('partials.coordinator.tablageneralmedicacion',['ultimaRecetas'=>$ultimasRecetas])
          @endif



        </div>

    </div>


@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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
