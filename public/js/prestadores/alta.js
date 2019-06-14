$(document).ready(function () {

    $('.select-rol').change(function () {
        var idrol=$('#idrol').val();


        //si el usuario a cargar es administrador o coordinacion ocultamos el input de diagrama
        if(idrol==1 || idrol==7){
           $('#ocultar-admin').hide();
        }else{
            $('#ocultar-admin').show();
        }

    });

});