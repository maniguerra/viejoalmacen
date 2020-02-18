/*==========================================
AGREGANDO INGREDIENTES DESDE EL BOTON
==========================================*/
$(document).ready(function() {
    $('.selectCliente').select2();
});


var numIngredientes = 0;

$(".btnAgregarIngrediente").click(function() {

    numIngredientes++;

    var datos = new FormData();
    datos.append("traerIngredientes", "ok");

    $.ajax({

            url: "ajax/ingredientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                $(".nuevoIngredienteMenu").append(

                    '<div class="row listaIngredientes">' +
                    '<div class="col-sm-12 col-lg-6">' +
                    ' <div class="input-group">' +

                    '<span class="input-group-text"><button type="button" class="btn btn-danger btn-xs quitarIngrediente" idIngrediente><i class="fa fa-times"></i></button></span>' +
                    '<select class="form-control nuevoNombreIngrediente selectIngrediente" id="ingrediente' + numIngredientes + '" style="min-height:50px" name="nuevoNombreIngrediente" required>' +
                    '<option value="" required>Seleccione un ingrediente</option>' +
                    '</select>' +

                    '<input type="hidden" class="ingredienteID">' +


                    '</div>' +
                    '</div>' +

                    '<div class="col-sm-6 col-lg-2 ingresoCantidad">' +
                    '<input type="number" class="form-control nuevaCantidadIngrediente" name="nuevaCantidadIngrediente" min="1" placeholder="0" required>' +

                    ' <span class="small text-muted">&nbsp; Ingrese cantidad</span>' +
                    '</div>' +

                    '<div class="col-sm-6 col-lg-2 div-unidad">' +
                    '<input type="text" class="form-control unidad-de-medida" readonly required>' +

                    ' <span class="small text-muted">&nbsp; Unidad de medida</span>' +
                    '</div>' +



                    '<div class="col-sm-12 col-lg-2 ingresoPrecio">' +

                    '<div class="input-group">' +

                    ' <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>' +
                    ' <input type="text" class="form-control precioIngrediente" precioReal="" name="precioIngrediente"  readonly>' +

                    ' </div>' +
                    '<span class="small text-muted">Costo</span>' +



                    '</div>' +
                    '</div>'



                );

                $(document).ready(function() {
                    $('.selectIngrediente').select2();
                });


                /*==========================================
                AGREGAR LOS INGREDIENTES AL SELECT
                ==========================================*/


                respuesta.forEach(funcionForEach);



                function funcionForEach(item, index) {


                    $("#ingrediente" + numIngredientes).append(
                        '<option idIngrediente="' + item.id + '" value="' + item.nombre + '">' + item.nombre + '</option>'
                    )


                }



            }
        })
        /*==========================================
        CALCLUAR PRECIO MENU
        ==========================================*/
    sumarTotalPrecio();
    /*==========================================
    DAR FORMATO AL PRECIO
    ==========================================*/
    $(".precioIngrediente").number(true, 2);






})


/*==========================================
QUITANDO INGREDIENTES DE LA LISTA
==========================================*/

$(".formularioMenu").on("click", "button.quitarIngrediente", function() {

    $(this).parent().parent().parent().parent().remove();

    /*==========================================
    CALCLUAR PRECIO MENU
    ==========================================*/
    sumarTotalPrecio();
    /*==========================================
    DAR FORMATO AL PRECIO
    ==========================================*/
    $(".precioIngrediente").number(true, 2);


})

/*==========================================
SELECCIONAR INGREDIENTE
==========================================*/

$(".formularioMenu").on("change", "select.nuevoNombreIngrediente", function() {



    var nombreIngrediente = $(this).val();

    var precioIngrediente = $(this).parent().parent().parent().children(".ingresoPrecio").children(".input-group").children(".precioIngrediente");
    //* Aca creo una variable para referirme al input del id
    var ingredienteID = $(this).parent().children(".ingredienteID");
    var nomenclatura = $(this).parent().parent().parent().children(".div-unidad").children(".unidad-de-medida");



    var datos = new FormData();
    datos.append("nombreIngrediente", nombreIngrediente);




    $.ajax({

        url: "ajax/ingredientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {



            datos.append("id_unidad", respuesta["id_unidad"]);

            // Tengo que ir a las unidades a buscar el nombre
            $.ajax({

                url: "ajax/unidades.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {



                    $(nomenclatura).val(respuesta["nomenclatura"]);

                }
            })

            //* Aca cargo el id en el input, sale de la respuesta

            $(precioIngrediente).val(respuesta["precio"]);
            $(precioIngrediente).attr("precioReal", respuesta["precio"]);
            $(ingredienteID).val(respuesta["id"])

            /*==========================================
            CALCLUAR PRECIO MENU
            ==========================================*/
            sumarTotalPrecio();
            /*==========================================
            DAR FORMATO AL PRECIO
            ==========================================*/
            $(".precioIngrediente").number(true, 2);

        }


    })



})

/*==========================================
MODIFICAR LA CANTIDAD
==========================================*/

$(".formularioMenu").on("change", "input.nuevaCantidadIngrediente", function() {


    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".precioIngrediente");

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    /*==========================================
    CALCLUAR PRECIO MENU
    ==========================================*/
    sumarTotalPrecio();
    /*==========================================
    DAR FORMATO AL PRECIO
    ==========================================*/
    $(".precioIngrediente").number(true, 2);

})




/*==========================================
CALCULAR PRECIO TOTAL DEL MENU
==========================================*/

function sumarTotalPrecio() {

    var precioIngrediente = $(".precioIngrediente");
    arraySumaPrecio = []

    for (var i = 0; i < precioIngrediente.length; i++) {

        arraySumaPrecio.push($(precioIngrediente[i]).val())

    }

    suma = 0;
    arraySumaPrecio.forEach(function(numero) {
        suma += parseFloat(numero);
    });



    $("#nuevoPrecioMenu").val(suma);


    /*==========================================
    DAR FORMATO AL PRECIO
    ==========================================*/
    //  $("#nuevoPrecioMenu").number(true, 2);

}



/*==========================================
ELIMINAR MENU
==========================================*/


$(".tablaViandas tbody").on('click', 'button.btnEliminarVianda', function() {

    var idMenu = $(this).attr("idMenu");

    swal.fire({
        title: 'Está seguro que desea borrar el menú?',
        text: 'Si no lo está puede cancelar la operación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar menú'
    }).then(function(result) {
            if (result.value) {
                window.location = 'index.php?ruta=viandas&idMenu=' + idMenu;
            }
        }

    )
})