jQuery(document).ready(function($) { $('.main-sidebar').height($(document).outerHeight()); });

/*====================================================================
CARGAR LA TABLA DE INGREDIENTES DINAMICAMENTE
====================================================================*/
/*
$.ajax({

    url: "ajax/datatable-ingredientes.ajax.php",
    success: function(respuesta) {

    }


})
*/



$(".tablaIngredientes").DataTable({
    "pageLength": 8,
    "ajax": "ajax/datatable-ingredientes.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,

    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
        "sInfo": "Registros del _START_ al _END_ - Total: _TOTAL_",
        "sInfoEmpty": "Registros del  del 0 al 0 - Total: 0",
        "sInfoFiltered": "(filtrado de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    }
})


$("#nuevaUnidad").change(function() {


    var idUnidad = $(this).val();


});

/*==================================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
==================================================*/

$(".tablaIngredientes tbody").on('click', 'button', function() {

    var table = $('.tablaIngredientes').DataTable();

    var data = table.row($(this).parents('tr')).data();


});


/*=====================
EDITAR INGREDIENTE
=======================*/
$(".tablaIngredientes tbody").on('click', 'button.btnEditarIngrediente', function() {


    var idIngrediente = $(this).attr("idIngrediente");

    var datos = new FormData();

    datos.append("idIngrediente", idIngrediente);

    $.ajax({

        url: "ajax/ingredientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            var datosIngrediente = new FormData();
            datosIngrediente.append("idUnidad", respuesta["id_unidad"]);

            $.ajax({

                url: "ajax/unidades.ajax.php",
                method: "POST",
                data: datosIngrediente,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {

                    let id = respuesta["id"];
                    $("#editarUnidad").val(id);
                    if (id == 1) {
                        $("#editarUnidad").html('Kilo');
                    } else if (id == 2) {
                        $("#editarUnidad").html('Litro');
                    } else {
                        $("#editarUnidad").html('Unidad');
                    }



                }


            })

            if (respuesta["id_unidad"] == 1 || respuesta["id_unidad"] == 2) {
                var precio = respuesta["precio"] * 1000;
            } else {
                var precio = respuesta["precio"];
            }

            $("#editarIngrediente").val(respuesta["nombre"]);
            $("#idIngrediente").val(respuesta["id"]);
            $("#editarPrecio").val(precio);

        }


    })


})



/*=========================================
ELIMINAR INGREDIENTE
========================================= */
$(".tablaIngredientes tbody").on('click', 'button.btnEliminarIngrediente', function() {


    var idIngrediente = $(this).attr("idIngrediente");

    swal.fire({
        title: 'Está seguro que desea borrar el ingrediente?',
        text: 'Si no lo está puede cancelar la operación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar ingrediente'
    }).then(function(result) {
            if (result.value) {
                window.location = 'index.php?ruta=ingredientes&idIngrediente=' + idIngrediente;
            }
        }

    )

})