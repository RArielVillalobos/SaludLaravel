@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Agregar Obra Social</div>
        <div class="panel-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="/obrasocial/store">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre Obra:(obligatorio)</label>
                            <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telofono:</label>
                            <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}">

                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Direccion:</label>
                            <input type="text" name="direccion" class="form-control" value="{{old('telefono')}}">

                        </div>

                    </div>

                </div>
                <p class="text-center"><button class="btn btn-success">Cargar</button></p>

            </form>


                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <th>Nombre Obra</th>
                            <th>E-mail</th>
                            <th>Telefono</th>
                            <th>Direccón</th>
                            </thead>
                            @foreach($obras as $obra)
                                <tr>
                                    <td>{{$obra->nombre}}</td>
                                    <td>{{$obra->email}}</td>
                                    <td>{{$obra->telefono}}</td>
                                    <td>{{$obra->direccion}}</td>
                                </tr>
                            @endforeach


                        </table>
                        {{$obras->links()}}
                    </div>


                </div>
        </div>
    </div>
@endsection