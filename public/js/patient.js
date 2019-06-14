$(document).ready(function(){

    $('#asis_social').val(null);
   $('#visita_asist_soc').on('click',function () {

      // var boton_asist_social=$('#visita_asist_soc').css('display');
      // console.log(boton_asist_social);
      var boton_asist_social=$('#panel-visita-asistente-soc').css('display');
      if(boton_asist_social=='none'){

          $('#panel-visita-asistente-soc').show('slow');
      }else{
          $('#panel-visita-asistente-soc').hide('slow');
          $('#asis_social').val(null);
      }

       //alert('hola');



   });
});