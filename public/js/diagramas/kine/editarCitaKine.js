$(document).ready(function(){

    $('[data-cita]').on('click',function(){


        var cita_id=$(this).data('cita');

        $('#cita').val(cita_id);




        $('#editarCita').modal('show');

    });
});