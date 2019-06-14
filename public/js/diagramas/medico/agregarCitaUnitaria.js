$(document).ready(function () {
    $('#agregarTurno').on('click',function(){

        /*var diagrama_id=$(this).data('diagrama_id');
        var dia=$(this).data('dia');

        $('#nursing_diagram_id').val(diagrama_id);
        $('#dia').val(dia);
         */


        $('#agregarTurnoMedi').modal('show');



    });


    //agregar cita unitaria
    $('.agregarCitaMediUni').on('click',function(){

        var fecha=$(this).data('fecha');
        var diagrama_id=$(this).data('diagrama');
        $('#fecha').val(fecha);
        $('#medical_diagrama_id').val(diagrama_id);


        $('#agregarCitaMedi').modal('show');



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



        $('#modificarCita').modal('show');



    });
    //eliminar

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






        $('#eliminarCita').modal('show');



    });

    //eliminar diagrama
    $('.eliminardiagramamedi').on('click',function(){

        var diagrama_id=$(this).data('diagrama_id');


        $('#medical_diagrama_id_eli').val(diagrama_id);






        $('#eliminardiagramaMedi').modal('show');



    });
});
