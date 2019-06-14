@extends('layouts.app')

@section('content')
 <div class="panel panel-default">
     <div class="panel-heading panel-title">Carga de Medicacions</div>
     <div class="panel-body">
         <form action="/cargarmedicacion" method="post">
            <div class="form-group">
                <label>Medicacion</label>
                <input  name="medicacion" type="text" class="form-control input-sm">

            </div>

             <div class="form-group">
                 <label>Dosis</label>

             </div>
         </form>

     </div>

 </div>

@endsection
