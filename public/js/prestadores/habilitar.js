$(document).ready(function() {
    $('[data-usuariohab]').on('click',function () {
        var usuario_id=$(this).data('usuariohab');

        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);

        $('#usuario_id').val(usuario_id);




        $('#habilitar').modal('show');


    });

    $('[data-usuariodes]').on('click',function () {
        var usuario_id=$(this).data('usuariodes');

        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);

        $('#usuariodes_id').val(usuario_id);




        $('#deshabilitar').modal('show');


    });

    $('[data-usuarioedit]').on('click',function () {
        var usuario_id=$(this).data('usuarioedit');

        var usuario=$(this).data('usuario');

        var email_usuario=usuario.email;
        var telefono_usuario=usuario.telefono;
        var direccion_usuario=usuario.domicilio;
        console.log(usuario);

        //console.log(episodio_id);
        //console.log(fecha_no_ingreso);

        $('#usuarioedit_id').val(usuario_id);

        $('#email').val(email_usuario);
        $('#telefono').val(telefono_usuario);
        $('#direccion').val(direccion_usuario);




        $('#editar').modal('show');


    });


});