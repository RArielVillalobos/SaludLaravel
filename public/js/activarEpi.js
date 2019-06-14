$(document).ready(function(){

    $('[data-epi]').on('click',function(){

        var episode_id=$(this).data('epi');
        $('#episode').val(episode_id);



        $('#activarEpi').modal('show');

    });
});



