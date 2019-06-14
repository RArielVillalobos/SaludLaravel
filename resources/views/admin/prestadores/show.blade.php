@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel panel-heading">Prestadores</div>
        @php
        $clase=\Illuminate\Support\Facades\Session::get('clase');
        $mensaje=\Illuminate\Support\Facades\Session::get('message');


        @endphp
        @if(isset($mensaje))
            <div class="alert alert-{{$clase}}">
                {{$mensaje}}

            </div>

        @endif

        <div class="panel-body">
            <div class="container">
                <a  href="/prestadores/alta" class="btn btn-success btn-sm">Cargar Prestador

                </a>


            </div>
            <br>

            <div class="container">
                <label>Impresión de listados</label>
                <ul>
                    <li><a href="/pdf/enfermeros">Enfermeros</a></li>
                    <li><a href="/pdf/medicos" >Médicos</a></li>
                    <li><a href="/pdf/kinesiologos">Kinesiologos</a></li>
                    <li><a href="/pdf/psicologos">Psicologos</a></li>
                    <li><a href="/pdf/asistentessocial">Asist.Social</a></li>
                    <li><a href="/pdf/administracion">Administracion</a></li>
                </ul>

            </div>


                <table class="table table-sm">
                    <label>Lista de Usuarios</label>
                    <thead>
                        <th>Nombre y Ap.</th>
                        <th>E-mail</th>
                        <th>Rol</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->last_name}} {{$usuario->name}}</td>

                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->role->name}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" data-usuarioedit="{{$usuario->id}}" data-usuario="{{$usuario}}">Editar Datos</a>
                                    @if($usuario->status_id==1)
                                        <a class="btn btn-danger btn-sm" data-usuariodes="{{$usuario->id}}">Deshabilitar</a>
                                        @else
                                            <a class="btn btn-success" data-usuariohab="{{$usuario->id}}">Habilitar</a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach

                    </tbody>


                </table>
            {{$usuarios->links()}}

        </div>




    </div>

    <div class="modal" tabindex="-1" role="dialog" id="habilitar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Esta Seguro que desea Habilitar el Usuario?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="post" action="prestadores/habilitar">
                    {{csrf_field()}}


                    <input type="hidden" name="usuario_id" value="" id="usuario_id">






                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Habilitar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>




            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="deshabilitar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Esta Seguro que desea Deshabilitar el Usuario?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="post" action="prestadores/deshabilitar">
                    {{csrf_field()}}


                    <input type="hidden" name="usuariodes_id" value="" id="usuariodes_id">






                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Deshabilitar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>




            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="editar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Editar Usuario</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/prestadores/update">
                        {{csrf_field()}}


                        <input type="hidden" name="usuarioedit_id" value="" id="usuarioedit_id">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="mail" name="email" id="email" value="" class="form-control" readonly>

                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nueva Clave</label> <p style="display: inline; font-size: 12px;" class="text-danger" >(Si queda en blanco no se actualizara la clave)</p>
                                    <input type="text" name="pass" class="form-control">

                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" name="telefono" id="telefono" value="" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="">
                                </div>


                            </div>

                        </div>






                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Editar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>







            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/js/prestadores/habilitar.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

@endsection