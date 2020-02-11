/*=========================================
EDITAR CLIENTE
========================================= */


$(".tablaClientes tbody").on('click', 'button.btnEditarCliente', function() {

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();

    datos.append("idCliente", idCliente);


    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {


            $("#editarPartido").val(respuesta["partido"]);
            $("#editarMunicipio").val(respuesta["municipio"]);
            $("#editarOrgano").val(respuesta["organo"]);
            $("#editarEstablecimiento").val(respuesta["establecimiento"]);
            $("#editarCuit").val(respuesta["cuit"]);
            $("#editarCupo").val(respuesta["cupos"]);
            $("#editarCupoDMC").val(respuesta["cupos_dmc"]);
            $("#idCliente").val(respuesta["id"]);

            $("#editarPartido").html(respuesta["partido"]);
            $("#editarMunicipio").html(respuesta["municipio"]);
            $("#editarOrgano").html(respuesta["organo"]);
            $("#editarEstablecimiento").html(respuesta["establecimiento"]);
            $("#editarCuit").html(respuesta["cuit"]);
            $("#editarCupo").html(respuesta["cupos"]);
            $("#editarCupoDMC").html(respuesta["cupos_dmc"]);

            $("#idCliente").html(respuesta["id"]);

            if (respuesta["tipo"] == "mun") {

                $("#editarTipo").val(respuesta["tipo"]);
                $("#editarTipo").html('Municipalizado');


            } else {
                $("#editarTipo").val(respuesta["tipo"]);
                $("#editarTipo").html('Provincial');

            }


        }
    })



})



/*=========================================
ELIMINAR CLIENTE
========================================= */


$(".tablaClientes tbody").on('click', 'button.btnEliminarCliente', function() {

    var idCliente = $(this).attr("idCliente");

    swal.fire({
        title: 'Está seguro que desea borrar el cliente?',
        text: 'Si no lo está puede cancelar la operación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente'
    }).then(function(result) {
            if (result.value) {
                window.location = 'index.php?ruta=clientes&idCliente=' + idCliente;
            }
        }

    )

})