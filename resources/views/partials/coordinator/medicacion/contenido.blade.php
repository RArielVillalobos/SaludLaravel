
<form action="{{route('medicine.editar')}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="hidden" name="medicine" value="{{$medicine->id}}">
        <input class="form-control" name="nombre" value="{{$medicine->nombre}}">

    </div>



    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Editar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
</form>




