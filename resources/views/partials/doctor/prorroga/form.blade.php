<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>Alegra Salud</title>
</head>
<body>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @if (Session::has('claseUnoIndi'))
        @php
            $claseIndiUno=\Illuminate\Support\Facades\Session::get('claseUnoIndi');
            $claseMedi='';


        @endphp

    @endif

    <li class="nav-item">
        <a href="/home" class="nav-link">Volver</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informe Médico</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($claseMedi))? $claseMedi :'active'}}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Medicación</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($claseIndiUno))? $claseIndiUno :''}}" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Indicaciones</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="container">
            <div class="row">

                <div class="col-sm">
                    <h4 class="text-center">Informe Medico para Prorroga  {{--$cita->episode->patient->nombre}} {{$cita->episode->patient->segundo_nombre}} {{$cita->episode->patient->apellido--}}</h4>
                    <p class="text-center"><strong>Fecha:</strong> {{$prorroga->fecha_prorroga}}</p>
                    <p class="text-center"><strong>Nombre Paciente: </strong>{{$prorroga->medicalIncome->informeMedico->episode->patient->apellido}} {{$prorroga->medicalIncome->informeMedico->episode->patient->nombre}}</p>
                    <br>


                    <form action="/prorroga/store" method="post">
                        <input type="hidden" name="prorroga_id" value="{{$prorroga->id}}">
                        {{csrf_field()}}
                        <div class="form-group-sm">
                            <label>Antecedentes:</label>
                            <textarea name="antecedentes" class="form-control">{{$ultimoInformeMedico->antecedentes}}</textarea>

                        </div>
                        <br>

                        <div class="form-group-sm">
                            <label>Enfermerdad Actual:</label>
                            <textarea name="enfermedad_actual" class="form-control">{{$ultimoInformeMedico->enfermerdad_actual}}</textarea>

                        </div>
                        <br>


                        <br>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group-sm">
                        <h4><strong>Requerimientos:</strong></h4>
                        <br>

                        <label class="label-per">Prestaciones Médicas: </label>
                        <input class="ipt" name="cantidad_prov_med" type="number" value="{{$ultimoInformeMedico->provision->medical_provision->valor}}"> Por
                        <select name="tipo_med">
                            @if($ultimoInformeMedico->provision->medical_provision->tipo=='semana')
                                <option value="semana" selected>Semana</option>
                                <option value="dia" >Día</option>
                            @endif
                            @if($ultimoInformeMedico->provision->medical_provision->tipo=='dia')
                                <option value="dia" selected>Día</option>
                                <option value="semana">Semana</option>
                                @endif
                        </select>
                        <br>


                        <label class="label-per">Prestaciones Enfermeria: </label>
                        <input class="ipt" name="cant_prov_enf" type="number" value="{{$ultimoInformeMedico->provision->nursing_provision->valor}}"> Por
                        <select name="tipo_enf">
                            @if($ultimoInformeMedico->provision->nursing_provision->tipo=='semana')
                                <option value="semana" selected>Semana</option>
                                <option value="dia" >Día</option>
                            @endif
                            @if($ultimoInformeMedico->provision->nursing_provision->tipo=='dia')
                                <option value="dia" selected>Día</option>
                                <option value="semana">Semana</option>
                            @endif
                        </select>
                        <br>


                        <label class="label-per">Prestaciones Kinesiologia: </label>
                        <input class="ipt" name="cant_prov_kine" type="number" value="{{$ultimoInformeMedico->provision->kinesiology_provision->valor}}"> Por
                        <select name="tipo_kine">
                            @if($ultimoInformeMedico->provision->kinesiology_provision->tipo=='semana')
                                <option value="semana" selected>Semana</option>
                                <option value="dia" >Día</option>
                            @endif
                            @if($ultimoInformeMedico->provision->kinesiology_provision->tipo=='dia')
                                <option value="dia" selected>Día</option>
                                <option value="semana">Semana</option>
                            @endif
                        </select>
                        <br>

                        <label class="label-per">Prestaciones Psicologia: </label>
                        <input class="ipt" name="cant_prov_psi" type="number" value="{{$ultimoInformeMedico->provision->psycology_provision->valor}}"> Por
                        <select name="tipo_psi">
                            @if($ultimoInformeMedico->provision->psycology_provision->tipo=='semana')
                                <option value="semana" selected>Semana</option>
                                <option value="dia" >Día</option>
                            @endif
                            @if($ultimoInformeMedico->provision->psycology_provision->tipo=='dia')
                                <option value="dia" selected>Día</option>
                                <option value="semana">Semana</option>
                            @endif
                        </select>

                    </div>
                </div>

            </div>

            <p class="text text-center"><input type="submit" class="btn btn-success" value="Cargar Informe Médico"></p>
            </form>
            <br>


        </div>
    </div>
    <div class="tab-pane fade {{(isset($claseMedi))? $claseMedi :'show active'}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container">
            {{-- MEDICACION--}}
            <br>
            {{-- @if($ultimaReceta->medicines)--}}

            <table class="table table-sm alert-info">
                <h4>Medicación que tiene actualmente el paciente</h4>

                <div>
                    <a href="/prorroga/medicacion/reset" class="btn btn-success btn-sm">Resetear</a>
                </div>

                <br>
                <thead>
                <tr>
                    <th scope="col">Medicacion</th>
                    <th scope="col">Dosis</th>
                    <th scope="col">Vía</th>
                    <th scope="col">Int</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($sesionCarrito as $medicine)
                    <tr>
                        <td>{{$medicine['nombre']}}</td>
                        <td>{{$medicine['dosis']}}</td>
                        <td>{{$medicine['via']}}</td>
                        <td>{{$medicine['int']}}</td>
                        <td>{{$medicine['observaciones']}}</td>
                        <td>
                            <a class="btn btn-danger sm" href="/prorroga/quitarmedicacion/{{$medicine['id']}}">
                                Quitar
                            </a>


                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- @endif--}}
            <br>
            <div class="container">
                <h4 class="text text-center">Medicación</h4>
                <div class="form-group">

                    <input type="text" class="form-controller" id="search" name="search">

                </div>
                <table class="table-responsive table table-sm">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nombre Medicamento</th>

                    </tr>

                    </thead>

                    <tbody id="medicacionevo">

                    </tbody>

                </table>

            </div>



        </div>

    </div>
    @if (Session::has('claseDosIndi'))
        @php
            $claseDos=\Illuminate\Support\Facades\Session::get('claseDosIndi')


        @endphp

    @endif
    <div class="tab-pane fade {{(isset($claseDos))? $claseDos :''}}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="container">
            <div class="row">
                <div class="col-sm">

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <br>
                            <thead>
                            <h3>Indicaciones</h3>
                            <div>
                                <a href="/prorroga/indicacion/reset" class="btn btn-success btn-sm">Resetear</a>
                            </div>
                            <br>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Opciones</th>

                            </tr>
                            </thead>
                            <tbody>


                            @foreach($sesionCarritoIndi as $indicacion)
                                <tr>
                                    <td>{{$indicacion['nombre']}}</td>
                                    <td>{{$indicacion['descripcion']}}</td>

                                    <td>
                                        <a class="btn btn-danger btn-sm" href="/prorroga/quitarindicacion/{{$indicacion['nombre']}}">
                                            Quitar
                                        </a>


                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- @endif--}}
                    <br>
                </div>
                <div class="col-sm">
                    <form action="{{route('prorroga.indi.agrega')}}" method="get">
                        <br>

                        <h4 class="text text-center">Agregar Indicación</h4>

                        <br>
                        <div class="form-group-sm">
                            <label>Nombre de la Indicacion:</label>
                            <input name="nombre" class="form-control" type="text" placeholder="Nombre">

                        </div>
                        <br>

                        <div class="form-group-sm">
                            <label>Descripción:</label>
                            <textarea name="descripcion" class="form-control" placeholder="Descripción"></textarea>

                        </div>
                        <br>


                        <br>

                        <button type="submit" class="btn btn-success btn-sm ">Agregar</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalmedi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregando Medicamento</h5>
                <br>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="nombremedi" class="text text-center">

            </div>

            <div class="modal-body">
                <form method="get" action="/agregarmedicacionprorroga">
                    {{csrf_field()}}
                    <input type="hidden" name="medicamento_id" value="" id="med">
                    <div class="form-group" >
                        <label>Dosis:</label>
                        <input class="form-control" name="dosis">
                    </div>
                    <div class="form-group">
                        <label>Via:</label>
                        <input class="form-control" name="via">
                    </div>

                    <div class="form-group">
                        <label>Int:</label>
                        <input class="form-control" name="int">
                    </div>
                    <div class="form-group">
                        <label>Observaciones:</label>
                        <textarea class="form-control" name="observaciones"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">

    $('#search').on('keyup',function(){

        $value=$(this).val();


        $.ajax({

            type : 'get',

            url : '{{URL::to('searchmedievo')}}',

            data:{'searchmedievo':$value},

            success:function(data){

                $('#medicacionevo').html(data);


            }

        });



    })

</script>
<script type="text/javascript">

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>


<script>
    $( document ).ready(function() {
        // function modal(e){
        //var medicamento_id= e.dataset.medicamento;
        //console.log(medicamento_id)

        //}

        $("body").on("click","a.bton",function(){
            var medicamento_id=$(this).data('medicamento');
            var medicamento_nombre=$(this).data('nombremedi');


            $('#nombremedi').html('<h5>'+medicamento_nombre+'</h5>');

            console.log(medicamento_id);


            $('#modalmedi').modal('show');
            $('#med').val(medicamento_id);
        });
    });
</script>
</body>
</html>
