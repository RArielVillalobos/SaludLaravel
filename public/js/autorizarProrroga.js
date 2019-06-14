$(document).ready(function(){

    $('[data-prorroga]').on('click',function(){

        var prorroga_id=$(this).data('prorroga');
        $('#prorroga').val(prorroga_id);



        $('#autorizarProrroga').modal('show');

    });
});