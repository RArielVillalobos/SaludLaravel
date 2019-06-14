@extends('layouts.app')
@section('content')
 <div class="content">
     <div class="form-group">
         <h4>Seleccione tipo de Cita</h4>
         <form method="post" action="tipocita">
             {{csrf_field()}}


             <label>Tipo</label>
             <select name="tipo_cita">
                 <option value="cita_medica">Cita Medica</option>
                 <option value="cita_enfermeria">Cita Enfermeria</option>
                 <option value="cita_kinesiologia">Cita Kinesiologia</option>
                 <option value="cita_kinesiologia">Cita Psicologia</option>
                 <option value="cita_kinesiologia">Cita para Prorroga</option>

             </select>
             <button type="submit" class="btn btn-primary">Cargar</button>
         </form>
     </div>

     @if(isset($tipo_cita) && $tipo_cita=='cita_medica')

      @include('citas.form')
     @elseif(isset($tipo_cita) && $tipo_cita=='cita_enfermeria')
        @include('citas.formcitasEnfermeria')

     @elseif(isset($tipo_cita) && $tipo_cita=='cita_kinesiologia')

     {{'kine'}}

     @endif



 </div>


@endsection