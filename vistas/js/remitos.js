if (!Array.prototype.forEach) {
    Array.prototype.forEach = function(fn, scope) {
        for (var i = 0, len = this.length; i < len; ++i) {
            fn.call(scope, this[i], i, this);
        }
    }
}

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

    var idCliente = $("#select-cliente").val();
    var idDmc = $("#select-dmc").val();
    var idComedor = $("#select-comedor").val();
    var checkComedor = $("#check-comedor").attr("checked");
    var checkDmc = $("#check-dmc").attr("checked");
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


        if (checkComedor) {
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
                        // console.log(respuesta)

                        productosRemitoComedor.push(respuesta["productos"])

                    }
                })

            } else {
                alert("Debe seleccionar un menu comedor")
            }
        }

        if (checkDmc) {
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
                        console.log(respuesta["dmc"])
                        console.log(respuesta["productos"])

                        productosRemitoDmc.push(respuesta["productos"])
                    }
                })
            } else {
                alert("Debe seleccionar un menu DMC")
            }


        }


    } else {
        alert("Debe seleccionar un cliente")
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

    function cargarDetalle(productosRemitoComedor, productosRemitoDmc) {

        if (productosRemitoComedor != "") {
            $("#remito").append(
                "<div class='row'>" +
                "<div class='col-6'" +
                "<p class='d-inline'><b>Detalle Comedor:</b><p>" +
                "</div>" +
                "</div>"
            )

            for (let i = 0; i < productosRemitoComedor.length; i++) {


                var ingredientesC = JSON.parse(productosRemitoComedor[i])


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
                        "<div class='row'>" +
                        "<div class='col-10'" +
                        "<p class='d-inline'>" + ingredientesC[i]["ingrediente"] + "</b>" +
                        "</div>" +
                        "<div class='col-1'" +
                        "<p class='d-inline ml-5'>" + cantidadTotal + "</b>" +
                        "</div>" +
                        "<div class='col-1'" +
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
                "<div class='col-6'" +
                "<p class='d-inline'><b>Detalle DMC:</b><p>" +
                "</div>" +
                "</div>"
            )
            for (let i = 0; i < productosRemitoDmc.length; i++) {

                var ingredientesD = JSON.parse(productosRemitoDmc[i])

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
                        "<div class='row'>" +
                        "<div class='col-10'" +
                        "<p class='d-inline'>" + ingredientesD[i]["ingrediente"] + "</b>" +
                        "</div>" +
                        "<div class='col-1'" +
                        "<p class='d-inline ml-5'>" + cantidadTotal + "</b>" +
                        "</div>" +
                        "<div class='col-1'" +
                        "<p class='d-inline ml-5'>" + unidadFinal + "</b>" +
                        "</div>" +


                        "</div>"
                    )

                }

            }
        }



    }

    setTimeout(function(e) { cargarDetalle(productosRemitoComedor, productosRemitoDmc) }, 500);
    setTimeout(function(e) { cargarEncabezado(clienteRemito) }, 300);
})



/*============================================
IMPRIMIR REMITO
==============================================*/
$(".btnImprimirRemito").click(function() {




    //CAPTURAR TODOS LOS ELEMENTOS DEL REMITO

    // FECHA
    var dia = $("#dia").val();
    var mes = $("#mes").val();
    var ano = $("#ano").val();
    console.log(dia, mes, ano)

    // ENCABEZADO



    //CUERPO

    window.open("extensiones/tcpdf/remito/remito.php", "_blank")



})