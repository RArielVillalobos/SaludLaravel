@extends('layouts.app')
@section('content')
  <div class="panel panel-primary">
      <div class="panel-heading panel-title">Informe PsicoSocial</div>
      <div class="panel-body">
          <div class="container">

              <form method="post" action="/guardaringresopsicosocial">
                  {{csrf_field()}}
                  <input type="hidden" value="{{$idCita}}" name="ingreso_psico_id">

                  <div class="row">
                      <div class="col-sm">
                          <label class="title-psico">Vivienda Adecuada:</label>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="vivienda_adecuada" id="optionsRadios1" value="si" checked>
                                  si
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="vivienda_adecuada" id="optionsRadios2" value="no">
                                  no
                              </label>
                          </div>
                      </div>

                      <div class="col-sm">
                          <label class="title-psico">Cuidadores:</label>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="cuidadores" id="optionsRadios1" value="si" checked>
                                  si
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="cuidadores" id="optionsRadios2" value="no">
                                  no
                              </label>
                          </div>
                      </div>

                      <div class="col-sm">
                          <label class="title-psico">Cumple Requisitos para Int Dom:</label>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="requi_int_dom" id="optionsRadios1" value="si" checked>
                                  si
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="requi_int_dom" id="optionsRadios2" value="no">
                                  no
                              </label>
                          </div>

                      </div>


                      <div class="row">
                          <div class="col-xs-6">
                              <label>Informe</label>
                              <textarea name="informe" class="form-control" rows="3"></textarea>
                          </div>


                      </div>
                      <br>

                      <button class="btn btn-primary">Enviar</button>
                  </div>
              </form>



          </div>
      </div>
@endsection
