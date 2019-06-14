
@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">

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

                <h3 class="text-center">Formulario cargar Paciente</h3>
                <form method="post" action="/guardarpaciente">
                    {{csrf_field()}}
                    <h4 class="text-justify">Datos Personales</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control input-sm" type="text" name="nombre" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Segundo Nombre</label>
                                <input class="form-control input-sm" type="text" name="segundo_nombre" value="{{old('segundo_nombre')}}" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido</label>
                                <input class="form-control input-sm" type="text" name="apellido" value="{{old('apellido')}}">
                            </div>


                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>D.N.I</label>
                                <input class="form-control input-sm" type="text" name="dni" value="{{old('dni')}}">
                            </div>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input class="form-control input-sm" type="date" name="fecha_nac" value="{{old('fecha_nac')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sexo</label>
                                <select class="form-control input-sm" name="sexo">
                                    <option value="femenino">Femenino</option>
                                    <option value="masculino">Masculino</option>


                                </select>

                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <select class="form-control input-sm" name="estado_civil">
                                    <option value="soltero/a">Soltero/a</option>
                                    <option value="viudo/a">Viudo/a</option>
                                    <option value="casado/a">Casado/a</option>

                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Localidad</label>
                                <input class="form-control input-sm" type="text" name="localidad" value="{{old('localidad')}}">
                            </div>


                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input class="form-control input-sm" type="text" name="direccion" value="{{old('direccion')}}">
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input class="form-control input-sm" type="text" name="telefono" value="{{old('telefono')}}">
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre Obra Social</label>
                            <div class="form-group">
                                <select name="obra_social" class="form-control">
                                    @foreach($obras as $obra)
                                        <option value="{{$obra->id}}">
                                            {{$obra->nombre}}
                                        </option>


                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Numero Afiliado</label>
                                <input class="form-control input-sm" type="text" name="num_afiliado" value="{{old('num_afiliado')}}">
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Familiar responsable</label>
                                <input class="form-control input-sm" type="text" name="fam_responsable" value="{{old('fam_responsable')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Num Tel Familiar responsable</label>
                                <input class="form-control input-sm" type="text" name="num_fam_responsable" value="{{old('num_fam_responsable')}}">
                            </div>

                        </div>

                    </div>




                    <div class="form-group">
                        <label>Medico Responsable:</label>
                        <select name="doctor_id" class="form-control">
                            @foreach($medicos as $medico)
                                <option value="{{$medico->id}}">{{$medico->user->last_name}} {{$medico->user->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Fecha de Visita para Ingreso Médico</div>
                                <h5 class="text-center text-danger">La visita médica sera asignada al medico que designó como responsable del episodio</h5>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Fecha:</label>
                                                <input name="fecha_visita_medica" class="form-control" type="date">

                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Hora:</label>
                                                <input class="form-control" name="hora_visita_medica" type="time">

                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Comentario(no obligatorio):</label>
                                                <textarea class="form-control" name="comentario" rows="4">{{old('comentario')}}</textarea>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-primary " id="panel-visita-asistente-soc" style="display: none">
                                <div class="panel-heading">Fecha de Visita de Asistente Social</div>

                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Seleccione Asist. Social</label>
                                        <select name="asist_social" class="form-control" id="asis_social">
                                            @foreach($asistenes_soc as $asis)
                                                <option  value="{{$asis->id}}">{{$asis->user->last_name}} {{$asis->user->name}}</option>

                                            @endforeach
                                        </select>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Fecha:</label>
                                                <input name="fecha_visita_asis_social" class="form-control" type="date">

                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Hora:</label>
                                                <input class="form-control" name="hora_visita_asis_social" type="time">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Comentario(no obligatorio):</label>
                                                <textarea class="form-control" name="comentario_asis" rows="4">{{old('comentario_asis')}}</textarea>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="button" name="visita_asis_social" id="visita_asist_soc">Asignar Visita Asis.Social</button>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="cargar">Cargar</button>
                </form>
        </div>
    </div>


@endsection

@section('script')
 <script src="/js/patient.js"></script>
@endsection





