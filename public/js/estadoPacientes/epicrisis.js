$(document).ready(function() {
    $('#derivacion').on('change',function () {
        var valor=$('#derivacion').val();
        if(valor=='si'){
            $( "#opciones_derivacion" ).show("slow");
        }else{
            $( "#opciones_derivacion" ).hide("slow");
        }



    });


});