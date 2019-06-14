$(function () {
    //$('#btn-cargar').on('click',function(e){
      //   e.preventDefault();
        // agregarCampo();

    $('#total_col').on('change',totalColumnas);



});


function totalColumnas(){
     num_columnas=$('#total_col').val();
        for(var i=0; i<num_columnas; i++){
        var input=`<input id="${i}" name="input_dinamico[]"class="form-control" type="text"><br>`;
        $('#agregar-campo').append(input);

        $("#total_col").prop('disabled', true);

    }
}
