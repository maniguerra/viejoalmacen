/*=========================================
EDITAR USUARIO
=========================================*/

$(document).on("click", ".btnEditarUsuario", function() {

    var idUsuario = $(this).attr("idUsuario");


    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#passwordActual").val(respuesta["password"]);

        }
    });

})

/*=========================================
REVISAR USUARIO REPETIDO
=========================================*/

$("#nuevoUsuario").change(function() {

    $(".alert").remove();
    var usuario = $(this).val();

    var datos = new FormData();

    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#nuevoUsuario").parent().after('<div class="d-block alert alert-warning">Este usuario ya existe en la base de datos</div>');

                $("#nuevoUsuario").val("");
            }

        }
    });

})


/*=========================================
ELIMINAR USUARIO
=========================================*/

$(document).on("click", ".btnEliminarUsuario", function() {

    var idUsuario = $(this).attr("idUsuario");
    swal.fire({
        title: 'Está seguro que desea borrar el usuario?',
        text: 'Si no lo está puede cancelar la operación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario'
    }).then(function(result) {
            if (result.value) {
                window.location = 'index.php?ruta=usuarios&idUsuario=' + idUsuario;
            }
        }

    )
})