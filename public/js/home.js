$(document).ready(function(){
    $('[data-obser]').on('click',addObsr);
    $('[data-history]').on('click',function(){
        var episode_id=$(this).data('history');
        $.ajax({
            type: "GET",
            url: 'episodio/'+episode_id+'/observaciones',
            beforeSend: function(){
                $(".containerobs").html("cargando informacion");
            },
            success: function(data){
                $(".containerobs").html(data);


            },
            error: function(data){
                $(".containerobs").html(data)
            }
        });
        //$('.containerobs').html(html);
        $('#modalHistoryObs').modal('show');
        });
});

function addObsr(){
    var episode_id=$(this).data('obser');
    $('#episode').val(episode_id);
    $('#modalAddObsr').modal('show');


}

function historyObsr(){

}