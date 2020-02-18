if (!Array.prototype.forEach) {
    Array.prototype.forEach = function(fn, scope) {
        for (var i = 0, len = this.length; i < len; ++i) {
            fn.call(scope, this[i], i, this);
        }
    }
}


// Manejo de botones y cajas al seleccionar un remito personalizado
$("#check-personalizado").click(function() {

    var check = $(this).attr("checked");

    if (!check) {
        var check = $(this).attr("checked", true);


        $("#select-comedor").attr("disabled", true);
        $("#cupos-comedor").attr("readonly", true);
        $("#check-comedor").prop("checked", false);


        $("#select-dmc").attr("disabled", true);
        $("#cupos-dmc").attr("readonly", true);
        $("#check-dmc").prop("checked", false);



        $(".div-comedor").hide();
        $(".div-dmc").hide();

        $(".agregarIngredientePersonalizado").removeClass("d-none");


    } else {
        var check = $(this).attr("checked", false);



        $(".div-comedor").show();
        $(".div-dmc").show();

        $(".agregarIngredientePersonalizado").addClass("d-none");
        $(".listaIngredientes").remove()




    }
})

/*============================================
Agregar elementos de remito personalizado
==============================================*/

$(".agregarIngredientePersonalizado").on("click", function() {
    $(".ingredientesPersonalizados").append(

        '<div class="row listaIngredientes mb-2">' +
        '<div class="col-sm-12 col-md-8 nombreIngrediente">' +
        ' <div class="input-group">' +

        '<span class="input-group-text"><button type="button" class="btn btn-danger btn-xs quitarIngredientePersonalizado" ><i class="fa fa-times"></i></button></span>' +
        '<input type="text" class="form-control ingredientePersonalizado" required>' +


        '</div>' +
        ' <span class="small text-muted">&nbsp; Ingrese nombre producto</span>' +
        '</div>' +

        '<div class="col-sm-6 col-md-2 ingresoCantidad">' +
        '<input type="number" class="form-control cantidadPersonalizado" name="cantidadPersonalizado" min="1" placeholder="0" required>' +

        ' <span class="small text-muted">&nbsp; Ingrese cantidad</span>' +
        '</div>' +

        '<div class="col-sm-6 col-md-2 unidadPersonalizado">' +
        '<select class="form-control unidad-de-medida-personalizada" required>' +
        '<option value="Kgs.">Kilos</option>' +
        '<option value="Lts.">Litros</option>' +
        '<option value="U.">Unidad</option>' +
        '</select>' +
        ' <span class="small text-muted">&nbsp; Unidad de medida</span>' +
        '</div>' +




        '</div>'



    );
});






$(document).on("click", ".quitarIngredientePersonalizado", function() {
    $(this).parent().parent().parent().parent().remove();
});



/*============================================
COLOCO BUSCADOR EN CADA SELECT Y CARGO EL CAMPO
FECHA CON EL DIA ACTUAL.
==============================================*/

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
})

$(document).ready(function() {
    $('#datePicker').val(new Date().toDateInputValue());
    $('#select-cliente').select2();
    $('#select-comedor').select2();
    $('#select-dmc').select2();
})




/*============================================
HABILIAR Y DESHABILITAR SELECT COMEDORT Y DMC
==============================================*/

$("#check-comedor").click(function() {

    var check = $(this).attr("checked");

    if (!check) {
        $("#select-comedor").attr("disabled", false);
        $("#cupos-comedor").attr("readonly", false);
        var check = $(this).attr("checked", true);


    } else {
        $("#select-comedor").attr("disabled", true);
        $("#cupos-comedor").attr("readonly", true);
        var check = $(this).attr("checked", false);

    }
})


$("#check-dmc").click(function() {

    var check = $(this).attr("checked");

    if (!check) {
        $("#select-dmc").attr("disabled", false);
        $("#cupos-dmc").attr("readonly", false);
        var check = $(this).attr("checked", true);


    } else {
        $("#select-dmc").attr("disabled", true);
        $("#cupos-dmc").attr("readonly", true);
        var check = $(this).attr("checked", false);

    }
})

/*=====================================================
AGREGAR LOS MENUES A LOS SELECT DEPENDIENDO EL CLIENTE
======================================================*/

$("#select-cliente").change(function() {

    var cuposComedor = $("#cupos-comedor");
    var selectComedor = $("#select-comedor");

    var cuposDmc = $("#cupos-dmc");
    var selectDmc = $("#select-dmc");



    var idCliente = $("#select-cliente").val();

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



            cuposComedor.val(respuesta["cupos"])
            cuposDmc.val(respuesta["cupos_dmc"])

            $.ajax({

                url: "ajax/menus.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {




                    selectDmc.empty()
                    selectComedor.empty()
                    selectDmc.append('<option value="">Seleccionar Menu</option>');
                    selectComedor.append('<option value="">Seleccionar Menu</option>');


                    respuesta.forEach(function(menu) {

                        if (menu["dmc"] == "si") {

                            selectDmc.append('<option value="' + menu["id"] + '">' + menu["nombre"] + '</option>');

                        } else {

                            selectComedor.append('<option value="' + menu["id"] + '">' + menu["nombre"] + '</option>');
                        }


                    });

                }
            })
        }
    })
})

/*============================================
CARGAR DATOS DE REMITO
==============================================*/
var clienteRemito = [];
var productosRemitoComedor = [];
var productosRemitoDmc = [];
var productosRemitoPersonalizado = [];

$(".btnCrearRemito").click(function() {

    $("#partido").empty();
    $("#municipio").empty();
    $("#organo").empty();
    $("#establecimiento").empty();
    $("#cuit").empty();
    $("#tipo").empty();
    $("#remito").empty();
    $("#cuposComedor").empty();
    $("#cuposDmc").empty();
    $("#fecha").empty();

    clienteRemito = [];
    productosRemitoComedor = [];
    productosRemitoDmc = [];
    productosRemitoPersonalizado = [];

    var idCliente = $("#select-cliente").val();
    var idDmc = $("#select-dmc").val();
    var idComedor = $("#select-comedor").val();
    var checkComedor = $("#check-comedor").attr("checked");
    var checkDmc = $("#check-dmc").attr("checked");
    var checkPersonalizado = $("#check-personalizado").attr("checked");
    var cuposComedor = $("#cupos-comedor").val();
    var cuposDmc = $("#cupos-dmc").val();

    if (idCliente != "") {


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
                // console.log(respuesta)
                clienteRemito.push(respuesta["partido"],
                    respuesta["municipio"],
                    respuesta["organo"],
                    respuesta["establecimiento"],
                    respuesta["cuit"],
                    respuesta["tipo"]
                )
            }
        })


        if (checkComedor && !checkPersonalizado) {
            // Se cargará un menú COMEDOR

            if (idComedor != "") {

                // Hago la llamada Ajax para traer los datos del menu comedor



                var datos = new FormData();
                datos.append("idComedor", idComedor);

                $.ajax({

                    url: "ajax/menus.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {


                        productosRemitoComedor.push(respuesta);

                    }
                })

            } else {
                swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar un menú tipo comedor'
                })
            }
        }

        if (checkDmc && !checkPersonalizado) {
            // Se cargará un menú DMC
            if (idDmc != "") {
                // Hago la llamada Ajax para traer los datos del menu dmc



                var datos = new FormData();
                datos.append("idDmc", idDmc);

                $.ajax({

                    url: "ajax/menus.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {
                        productosRemitoDmc.push(respuesta)
                    }
                })
            } else {
                swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar un menú tipo DMC'
                })
            }


        }

        if (checkPersonalizado) {

            $(".listaIngredientes").each(function() {

                let ingrediente = $(this).children(".nombreIngrediente").children().children(".ingredientePersonalizado").val();
                let cantidad = $(this).children(".ingresoCantidad").children(".cantidadPersonalizado").val();
                let unidad = $(this).children(".unidadPersonalizado").children(".unidad-de-medida-personalizada").val();


                var elemento = [];
                elemento.push(ingrediente, cantidad, unidad);

                productosRemitoPersonalizado.push(elemento)

            });
        }


    } else {
        swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Debes seleccionar un cliente'
        })
    }


    function cargarEncabezado(clienteRemito) {
        $("#partido").append("<b>Partido: </b>" + clienteRemito[0])
        $("#municipio").append("<b>Municipio: </b>" + clienteRemito[1])
        $("#organo").append("<b>Órgano: </b>" + clienteRemito[2])
        $("#establecimiento").append("<b>Establecimiento: </b>" + clienteRemito[3])
        $("#cuit").append("<b>Cuit: </b>" + clienteRemito[4])

        var inputCuposComedor = $("#cupos-comedor")
        var inputCuposDmc = $("#cupos-dmc")

        if (clienteRemito[5] == "mun") {
            $("#tipo").append("<b>Tipo: </b>Municipalizado")
        } else {
            $("#tipo").append("<b>Tipo: </b>Provincial")
        }


        if ($('#cupos-comedor').is('[readonly]')) {;
            var cuposComedor = 0
        } else {
            var cuposComedor = $("#cupos-comedor").val();

        }

        if ($('#cupos-dmc').is('[readonly]')) {;
            var cuposDmc = 0
        } else {
            var cuposDmc = $("#cupos-dmc").val();

        }


        $("#cuposDmc").append("<b>Cupos Dmc: </b>" + cuposDmc);
        $("#cuposComedor").append("<b>Cupos Comedor: </b>" + cuposComedor);
        var fecha = $("#datePicker").val()
        var dia = fecha.substring(8, 10);
        var mes = fecha.substring(5, 7);
        var ano = fecha.substring(0, 4);
        $("#fecha").append("<b>Fecha: </b>" + dia + "/" + mes + "/" + ano);
        $("#dia").val(dia);
        $("#mes").val(mes);
        $("#ano").val(ano);
    }

    function cargarDetalle(productosRemitoComedor, productosRemitoDmc, productosRemitoPersonalizado) {

        if (productosRemitoComedor != "") {
            $("#remito").append(
                "<div class='row'>" +
                "<div class='col-6'" +
                "<p class='d-inline'><b>Detalle Comedor:</b><p>" +
                "</div>" +
                "</div>"
            )

            for (let i = 0; i < productosRemitoComedor.length; i++) {


                var ingredientesC = (productosRemitoComedor[i])


                for (let i in ingredientesC) {

                    var unidadFinal;
                    var cantidadTotal;

                    if (ingredientesC[i]["unidad"] == "U.") {

                        cantidadTotal = ingredientesC[i]["cantidad"] * cuposComedor
                        unidadFinal = "U."

                    } else if (ingredientesC[i]["unidad"] == "Gr.") {

                        cantidadTotal = (ingredientesC[i]["cantidad"] * cuposComedor) / 1000
                        unidadFinal = "Kgs.";

                    } else if (ingredientesC[i]["unidad"] == "Cm3.") {

                        cantidadTotal = (ingredientesC[i]["cantidad"] * cuposComedor) / 1000
                        unidadFinal = "Lts.";

                    }


                    $("#remito").append(
                        "<div class='row imprimirIngredientes'>" +
                        "<div class='col-8 imprimirNombre'" +
                        "<p class='d-inline'>" + ingredientesC[i]["nombre"] + "</b>" +
                        "</div>" +
                        "<div class='col-2 imprimirCantidad'" +
                        "<p class='d-inline ml-5'>" + cantidadTotal + "</b>" +
                        "</div>" +
                        "<div class='col-2 imprimirUnidad'" +
                        "<p class='d-inline ml-5'>" + unidadFinal + "</b>" +
                        "</div>" +


                        "</div>"
                    )

                }
            }
            $("#remito").append(
                "<hr>"
            )
        }

        if (productosRemitoDmc != "") {
            $("#remito").append(
                "<div class='row'>" +
                "<div class='col-sm-12 col-md-6'" +
                "<p class='d-inline'><b>Detalle DMC:</b><p>" +
                "</div>" +
                "</div>"
            )
            for (let i = 0; i < productosRemitoDmc.length; i++) {

                var ingredientesD = (productosRemitoDmc[i])

                for (let i in ingredientesD) {


                    var unidadFinal;
                    var cantidadTotal;

                    if (ingredientesD[i]["unidad"] == "U.") {

                        cantidadTotal = ingredientesD[i]["cantidad"] * cuposDmc
                        unidadFinal = "U."

                    } else if (ingredientesD[i]["unidad"] == "Gr.") {

                        cantidadTotal = (ingredientesD[i]["cantidad"] * cuposDmc) / 1000
                        unidadFinal = "Kgs.";

                    } else if (ingredientesD[i]["unidad"] == "Cm3.") {

                        cantidadTotal = (ingredientesD[i]["cantidad"] * cuposDmc) / 1000
                        unidadFinal = "Lts.";

                    }



                    $("#remito").append(
                        "<div class='row imprimirIngredientes'>" +
                        "<div class='col-8 imprimirNombre'" +
                        "<p class='d-inline'>" + ingredientesD[i]["nombre"] + "</b>" +
                        "</div>" +
                        "<div class='col-2 imprimirCantidad'" +
                        "<p class='d-inline ml-5'>" + cantidadTotal + "</b>" +
                        "</div>" +
                        "<div class='col-2 imprimirUnidad'" +
                        "<p class='d-inline ml-5'>" + unidadFinal + "</b>" +
                        "</div>" +


                        "</div>"
                    )

                }

            }
        }


        if (productosRemitoPersonalizado != "") {

            for (let i = 0; i < productosRemitoPersonalizado.length; i++) {
                $("#remito").append(
                    "<div class='row imprimirIngredientes'>" +
                    "<div class='col-8 imprimirNombre'" +
                    "<p class='d-inline'>" + productosRemitoPersonalizado[i][0] + "</b>" +
                    "</div>" +
                    "<div class='col-2 imprimirCantidad'" +
                    "<p class='d-inline ml-5 '>" + productosRemitoPersonalizado[i][1] + "</b>" +
                    "</div>" +
                    "<div class='col-2 imprimirUnidad'" +
                    "<p class='d-inline ml-5'>" + productosRemitoPersonalizado[i][2] + "</b>" +
                    "</div>" +


                    "</div>"
                )
            }


        }


    }

    setTimeout(function(e) {
        cargarDetalle(productosRemitoComedor, productosRemitoDmc, productosRemitoPersonalizado);

    }, 100);
    setTimeout(function(e) { cargarEncabezado(clienteRemito) }, 50);
})



/*============================================
IMPRIMIR REMITO
==============================================*/
$(document).ready(function() {
    $(".btnImprimirRemito").click(function() {




        //CAPTURAR TODOS LOS ELEMENTOS DEL REMITO

        cuerpoRemito = [];
        $(".imprimirIngredientes").each(function() {

            let ingrediente = $(this).children(".imprimirNombre").html();
            let cantidad = $(this).children(".imprimirCantidad").html();
            let unidad = $(this).children(".imprimirUnidad").html()


            var imprimirElemento = [];
            imprimirElemento.push(ingrediente, cantidad, unidad);

            cuerpoRemito.push(imprimirElemento)

        });


        // FECHA
        var dia = $("#dia").val();
        var mes = $("#mes").val();
        var ano = $("#ano").val();
        console.log(dia, mes, ano)

        // ENCABEZADO

        var partido = $("#partido").html().substr(16);
        var municipio = $("#municipio").html().substr(18);
        var organo = $("#organo").html().substr(15);
        var establecimiento = $("#establecimiento").html().substr(24);
        var cuit = $("#cuit").html().substr(13);
        var tipo = $("#tipo").html().substr(13);
        var cuposComedor = $("#cuposComedor").html().substr(22);
        var cuposDmc = $("#cuposDmc").html().substr(18);




        window.open("extensiones/tcpdf/remito/remito.php?dia=" + dia + "&mes=" + mes + "&ano=" + ano + "&partido=" + partido + "&municipio=" + municipio + "&organo=" + organo + "&establecimiento=" + establecimiento + "&cuit=" + cuit + "&tipo=" + tipo + "&cuposComedor=" + cuposComedor + "&cuposDmc=" + cuposDmc + "&cuerpoRemito=" + cuerpoRemito, "_blank")



    })
})