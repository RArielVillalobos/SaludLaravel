@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Cargar Prestador</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-body">
            <form method="post" action="/prestadores/store">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <label>Seleccione Rol</label>
                                <select  id="idrol" class="select-rol form-control" name="rol">

                                    @foreach($roles as $role)
                                        @php $oldRol=old('rol'); @endphp
                                        @if($role->id==$oldRol)
                                            <option  value="{{$role->id}}" selected>{{$role->name}}</option>
                                        @else
                                            <option  value="{{$role->id}}">{{$role->name}}</option>

                                        @endif




                                    @endforeach


                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">

                    </div>
                </div>
                <h4>Datos Personales</h4>
                <hr>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Segundo Nombre:</label>
                            <input type="text" class="form-control" name="segundo_nombre" value="{{old('segundo_nombre')}}">

                        </div>



                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}">

                        </div>



                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nac" value="{{old('fecha_nac')}}">

                        </div>



                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>D.N.I:</label>
                            <input type="text" class="form-control" name="dni" value="{{old('dni')}}">

                        </div>



                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Numero de Teléfono:</label>
                            <input type="text" class="form-control" name="num_tel" value="{{old('num_tel')}}">

                        </div>



                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Domicilio:</label>
                            <input type="text" class="form-control" name="domicilio" value="{{old('domicilio')}}">

                        </div>



                    </div>

                </div>

                <div class="row" id="ocultar-admin" style="display: none;">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Num Matricula:</label>
                            <input type="text" class="form-control" name="num_matricula" value="{{old('num_matricula')}}">

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Cod Diagrama</label><strong class="text-danger" style="font-size: 10px"> (Hasta 3 Caract)</strong>
                            <input type="text" class="form-control" name="cod_diagrama" value="{{old('cod_diagrama')}}">

                        </div>

                    </div>

                </div>
                <h4>Datos Usuario</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>E-mail</label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="correo" {{old('correo')}}>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <label>Contraseña</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="clave">

                        </div>

                    </div>

                </div>

               <p class="text-center"><button type="submit" class="btn btn-success">Cargar</button></p>
            </form>

        </div>


    </div>

@endsection
@section('script')
    <script src="/js/prestadores/alta.js"></script>
@endsection
