$(document).ready(function () {

    //agregar diagrama por turno
    $('#agregarTurno').on('click',function(){

        /*var diagrama_id=$(this).data('diagrama_id');
        var dia=$(this).data('dia');

        $('#nursing_diagram_id').val(diagrama_id);
        $('#dia').val(dia);
         */


        $('#agregarTurnoPsi').modal('show');



    });
    //agregar cita
    $('.agregarCitaPsiUni').on('click',function(){

        var fecha=$(this).data('fecha');
        var diagrama_id=$(this).data('diagrama');
        $('#fecha').val(fecha);
        $('#psychology_diagrama_id').val(diagrama_id);


        $('#agregarCitaPsi').modal('show');



    });

    //modificar cita
    $('[data-cita]').on('click',function(){

        var cita=$(this).data('cita');
        //var diagrama_id=$(this).data('diagrama_id');
        // var diagrama_id=$(this).data('diagrama');
        //$('#fecha').val(fecha);
        $('#cita_id').val(cita);
        //console.log(cita);
        //console.log(diagrama_id);



        $('#modificarCitaPsi').modal('show');



    });

    //eliminar cita
    $('[data-cita_id]').on('click',function(){

        var cita=$(this).data('cita_id');
        //var diagrama_id=$(this).data('diagrama_id');
        // var diagrama_id=$(this).data('diagrama');
        //$('#fecha').val(fecha);
        $('#cita_id').val(cita);
        //console.log(cita);
        //console.log(diagrama_id);
        var diagrama_id=$(this).data('diagrama_id');
        var fecha=$(this).data('fecha');
        diagrama_id='Turno:'+diagrama_id;

        var fecha='Fecha: '+fecha;

        $('#turno_eli').html(diagrama_id);
        $('#fecha_eli').html(fecha);

        $('#cita_id_eli').val(cita);






        $('#eliminarCitaPsi').modal('show');



    });

    //eliminar diagrama
    $('.eliminardiagramapsi').on('click',function(){

        var diagrama_id=$(this).data('diagrama_id');


        $('#psychology_diagrama_id_eli').val(diagrama_id);






        $('#eliminardiagramaPsi').modal('show');



    });
});