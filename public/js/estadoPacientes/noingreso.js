$(document).ready(function() {
    $('[data-paciente]').on('click',function () {
        var episodio_id=$(this).data('paciente');
        var fecha_no_ingreso=$(this).data('fechaing');
        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);

        $('#episode_id').val(episodio_id);
        $('#fecha_ingreso_med').val(fecha_no_ingreso);



        $('#noingreso').modal('show');


    });

    /*$('.idpaci').on('click',function(){

        var episodio_id=$('.epi').val();




        console.log(episodio_id);

        $('.modal-body').load('episodio/modificaringresos/'+episodio_id,function(){
            $('#editarDatosIngreso').modal({show:true});
        });

    });*/


});