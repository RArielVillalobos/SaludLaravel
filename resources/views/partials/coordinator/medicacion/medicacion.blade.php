<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Medicación</title>
</head>
<body>
    <br>
    <div class="container">

        <p class="text-right">
            <button class="btn btn-success btn-sm" data-medi="med">Agregar Medicacion</button>
        </p>

        <div class="container">
            @if(Session::get('message'))
                <div class="alert alert-{{Session::get('clase')}}">
                    {{Session::get('message')}}
                </div>


            @endif

        </div>
        <p class="text-left">
            <a href="../" class="btn btn-primary btn-sm">Volver</a>
        </p>

    </div>

    <div class="container">
        <table id="medicacion" class="table table-sm table-hover">
            <thead>
            <tr>
                <th width="10px">ID</th>
                <th width="30px">Nombre</th>
                <th width="20px">&nbsp;</th>
            </tr>

            </thead>


        </table>
    </div>


    <div class="modal agregarMedi" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Medicacioión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-add">
                    <form method="post" action="/medicacion/store">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre">

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Agregar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="editarMedi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Medicamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">




                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var jQuery_3_2_1 = $.noConflict(true);
    </script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<script>


    $(document).ready(function() {
        $('#medicacion').DataTable({
            'serverSide': true,
            'ajax':"{{url('api/medicacion')}}",
            'columns':[
                {data:'id'},
                {data:'nombre'},
                {data:'btn'},

            ],
            "language":{
                "info":"_TOTAL_ registros",
                "search":"Buscar",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior",
                },
                "lengthMenu":'Mostrar <select>'+
                    '<option value="10">10</option>'+
                    '<option value="30">30</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select> Registros',
                "loadingRecords":"Cargando..",
                "processing":"Procesando",
                "emptyTable":"No hay datos",
                "zeroRecords":"No hay conincidencias",
                "infoEmpty":"",
                "infoFiltered":"",


            }
        });
    } );
</script>


    <script>


        jQuery_3_2_1(document).ready(function(){





            jQuery_3_2_1("body").on("click","button.btn-modal",function(){

               var medicine= jQuery_3_2_1(this).data('medicine');


                /*jQuery_3_2_1('#editarMedi').modal('show');*/


                $('.modal-body').load('/modal/contenido/'+medicine,function(){
                    jQuery_3_2_1('#editarMedi').modal({show:true});
                });



            });


        });



    </script>
    <script>
        jQuery_3_2_1('[data-medi]').on('click',function () {
            jQuery_3_2_1('.agregarMedi').modal('show');
        });
    </script>

</body>
</html>