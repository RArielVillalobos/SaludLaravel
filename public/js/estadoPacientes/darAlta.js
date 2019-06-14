$(document).ready(function() {
    $('[data-epicrisis]').on('click',function () {
        var epicrisis_id=$(this).data('epicrisis');
       // var fecha_no_ingreso=$(this).data('fechaing');
        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);
        var patient=$(this).data('patient');
        var episodio_id=$(this).data('episodio');

        $('#epicrisis_id').val(epicrisis_id);
        $('#episode_id').val(episodio_id);
        $('#nombrePaciente').html(patient.nombre);
        $('#apellidoPaciente').html(patient.apellido);

        //$('#fecha_ingreso_med').val(fecha_no_ingreso);



        $('#darAlta').modal('show');


    });


});