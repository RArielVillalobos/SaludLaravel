$(document).ready(function() {
    $('[data-visita_id]').on('click',function () {
        var visita_id=$(this).data('visita_id');
        var visita=$(this).data('visita');
       // var fecha_no_ingreso=$(this).data('fechaing');
        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);
        var nombre=visita.episode.patient.nombre;
        var apellido=visita.episode.patient.apellido;
        $('#cita_id').val(visita_id);
        $('#fecha_visita').val(visita.fecha);
        $('#hora_visita').val(visita.hora);
        $('#nombre').html(nombre);
        $('#apellidoPaciente').html(apellido);
        //console.log(nombre);

        //$('#fecha_ingreso_med').val(fecha_no_ingreso);



        $('#editarVisitaIng').modal('show');


    });


});