@extends('layouts.app')



@section('content')
    <div class="panel panel-default">
        <div class="panel-heading panel-title">Carga de Tratamientos Medicos</div>
        <div class="panel-body">
            <form action="/cargartratamiento" method="post">
                {{csrf_field()}}
                <input type="hidden" name="doctor_id" value="{{auth()->user()->doctor->id}}">
                <input type="hidden" name="id" value="id">
                <div class="form-group">
                    <label>Nombre Tratamiento</label>
                    <input name="nombre_tratamiento" class="form-control input-sm" type="text" >



                </div>

                {{-- <div class="form-group">
                    <label>Descripcion</label>

                    <input name="description_tratamiento" class="form-control input-sm" type="text" >

                </div>--}}

                {{--<div class="form-group">
                    <input type="text" id="num-columnas">
                    <button id="btn-cargar" class="btn btn-primary">Cargar Columna</button>
                </div>--}}

                <div class="form-group">
                    <label>Total de Columnas que tendra el tratamiento</label>
                    <select id="total_col" name="total_columnas" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>

                </div>

                <div id="agregar-campo">

                </div>




                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Cargar</button>

                </div>
            </form>







        </div>

    </div>
@endsection

@section('script')
    <script src="/js/doctor.js"></script>

@endsection



