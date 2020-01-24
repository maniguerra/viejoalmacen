/*====================================================================
CARGAR LA TABLA DE INGREDIENTES DINAMICAMENTE
====================================================================*/
/* 
$.ajax({

    url: "ajax/datatable-ingredientes.ajax.php",
    success:function(respuesta){
        console.log("respuesta:", respuesta);
    }


}) */



 $(".tablaIngredientes").DataTable({
    "ajax": "ajax/datatable-ingredientes.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,

    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Registros del _START_ al _END_ - Total: _TOTAL_",
        "sInfoEmpty":      "Registros del  del 0 al 0 - Total: 0",
        "sInfoFiltered":   "(filtrado de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    }
}) 


$("#nuevaUnidad").change(function(){


    var idUnidad = $(this).val();


});

/*==================================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
==================================================*/

$(".tablaIngredientes tbody").on('click', 'button', function(){

    var table = $('.tablaIngredientes').DataTable();
    
    var data = table.row( $(this).parents('tr') ).data(); 

    $(this).attr("idIngrediente", data[6]);

});


/*=====================
EDITAR INGREDIENTE
=======================*/
$(".tablaIngredientes tbody").on('click', 'button.btnEditarIngrediente', function(){


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
        success: function(respuesta){

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
                success: function(respuesta){
        
                    
                    $("#editarUnidad").val(respuesta["id"]);
                    $("#editarUnidad").html(respuesta["nombre"]+' ('+respuesta["nomenclatura"]+')');
                    
        
                }
        
        
            })

            $("#editarIngrediente").val(respuesta["nombre"]);
            $("#idIngrediente").val(respuesta["id"]);
            $("#editarPrecio").val(respuesta["precio"]);

        }


    })


})



/*=========================================
ELIMINAR INGREDIENTE
========================================= */
$(".tablaIngredientes tbody").on('click', 'button.btnEliminarIngrediente', function(){


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
    }).then((result)=>{
        if(result.value){
            window.location = 'index.php?ruta=ingredientes&idIngrediente='+idIngrediente;
        }
    }
    
    )

})