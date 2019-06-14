/*$(document).ready(function(){

    $('[data-episodio]').on('click',function(){

        var episodio=$(this).data('episodio');

        $('#fecha').val(episodio);




        $('#agregarCitaEnfMasiva').modal('show');

    });
});*/
$(document).ready(function(){

    $('[data-diagrama-enf]').on('click',function(){

        var diagrama_id=$(this).data('diagrama-enf');
        console.log(diagrama_id);
        var info_diagrama=$(this).data('info');
        //*or(var i=0; i<=info_diagrama.length; i++){
          //  console.log(info_diagrama[i]);
        //}
        $('#nursing_diagram').val(diagrama_id);
        $('#info-diagramaenf').html('<p> '+info_diagrama.hora_desde+'--'+info_diagrama.hora_hasta+'</p>');
        $('#diagramarenfermeria').modal('show');

    });

    $('#addturno').on('click',function(){

        var episodio_id=$(this).data('episodio');



        $('#agregarturnoepi').modal('show');

    });

    $('#addturnomañana').on('click',function(){

        var episodio_id=$(this).data('episodio');



        $('#agregarturnomañanaenfermeria').modal('show');

    });

    $('#addturnotarde').on('click',function(){

        var episodio_id=$(this).data('episodio');



        $('#agregarturnotardeenfermeria').modal('show');

    });

    //cambiar de enfermero cita enfermeria
    $('[data-citaid]').on('click',function(){

        var cita_id=$(this).data('citaid');
        $('#cita').val(cita_id);



        $('#cambiarenfermero').modal('show');

    });

     //agregrar cita enfermeria
    $('[data-diagrama_id]').on('click',function(){

        var diagrama_id=$(this).data('diagrama_id');
        var dia=$(this).data('dia');

        $('#nursing_diagram_id').val(diagrama_id);
        $('#dia').val(dia);



        $('#agregarcitaunitaria').modal('show');

    });

    //quitar cita enfermeria

    $('.quitarcita').on('click',function(){

        var cita=$(this).data('visita_enf');
        //var diagrama_id=$(this).data('diagrama_id');
        // var diagrama_id=$(this).data('diagrama');
        //$('#fecha').val(fecha);
        $('#cita_id').val(cita);
        //console.log(cita);
        //console.log(diagrama_id);
        var turno=$(this).data('diagramaenf_id');
        var fecha=$(this).data('fecha');
        if(turno==1){
            turno='Mañana';
        }else if(turno==2){
            turno='Tarde';
        }else{
            turno ='24 hrs';
        }


        turno='Turno: '+turno;

        var fecha='Fecha: '+fecha;

        $('#turno_eli').html(turno);
        $('#fecha_eli').html(fecha);

        $('#cita_id_eli').val(cita);

        $('#eliminarCitaEnf').modal('show');



    });

    //eliminar diagrama
    $('.eliminardiagramaenf').on('click',function(){

        var diagrama_id=$(this).data('diagramaenf_id');



        $('#nursing_diagrama_id_eli').val(diagrama_id);






        $('#eliminardiagramaEnf').modal('show');



    });
});