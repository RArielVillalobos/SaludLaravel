$(document).ready(function(){

    $('.modificar-cita').on('click',function(){

        var fecha=$(this).data('fecha');

        $('#fecha').val(fecha);




        $('#agregarCitaKine').modal('show');

    });
});