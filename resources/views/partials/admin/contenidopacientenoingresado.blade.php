@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel panel-heading">Modificar Ingresos Episodio {{$episodio->patient->apellido}} {{$episodio->patient->nombre}}</div>
    <div class="panel-body">
        <label> Paciente: {{$episodio->patient->apellido}} {{$episodio->patient->nombre}}</label>
        <br>
        <label> Id Episodio: {{$episodio->id}}</label>
        <form action="{{route('episodio.update')}}" method="post">
            {{csrf_field()}}

            <div class="row">
            @if($episodio->medicalIncome!=null)
                <input type="hidden" name="medicalIncome_id" value="{{$episodio->medicalIncome->id}}">

                <input type="hidden" name="episode_id" value="{{$episodio->id}}">


                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Fecha de Visita para Ingreso Médico</div>
                            <div class="form-group">
                                <br>
                                <label>Seleccione Medico:</label>
                                <select name="doctor_id" class="form-control">
                                    @foreach($medicos as $medico)
                                        @if($medico->user->status_id==1)

                                            <option value="{{$medico->id}}" @if($episodio->medicalIncome->doctor_id==$medico->id) selected>{{$medico->user->last_name}} {{$medico->user->name}}  @endif</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Fecha:</label>
                                            <input name="fecha_visita_medica" class="form-control" type="date" value="{{$episodio->medicalIncome->fecha}}">

                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Hora:</label>
                                            <input class="form-control" name="hora_visita_medica" type="time" value="{{$episodio->medicalIncome->hora}}">

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label>Comentario(no obligatorio):</label>
                                            <textarea class="form-control" name="comentario" rows="4">{{$episodio->medicalIncome->comentarios}}</textarea>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
            @endif
            @if($episodio->psycho_social_income!=null)
                    <input type="hidden" name="psychosocialIncome_id" value="{{$episodio->psycho_social_income->id}}">
                  <div class="col-md-6">
                    <div class="panel panel-primary " id="panel-visita-asistente-soc">
                        <div class="panel-heading">Fecha de Visita de Asistente Social</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Seleccione Asist. Social</label>
                                <select name="asist_social" class="form-control" id="asis_social">
                                    @foreach($asistentes_soc as $asis)
                                        @if($asis->user->status_id==1)
                                            <option  value="{{$asis->id}}" @if($asis->id==$episodio->psycho_social_income->social_assistant_id) selected @endif>{{$asis->user->last_name}} {{$asis->user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>


                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Fecha:</label>
                                        <input name="fecha_visita_asis_social" class="form-control" type="date" value="{{$episodio->psycho_social_income->fecha}}">

                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Hora:</label>
                                        <input class="form-control" name="hora_visita_asis_social" type="time" value="{{$episodio->psycho_social_income->hora}}">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>Comentario(no obligatorio):</label>
                                        <textarea class="form-control" name="comentario_asis" rows="4">{{$episodio->psycho_social_income->comentarios}}</textarea>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            @endif
            </div>



            @if($episodio->medicalIncome!=null)
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Actualizar</button>

            </div>
            @endif
        </form>




    </div>

</div>

@endsection


