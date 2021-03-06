<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menús<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><i class="fas fa-users-cog"></i></li>
                        <li class="breadcrumb-item active">Menús</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <!-- FORMULARIO DE NUEVO MENÚ-->
            <div class="col-12">

                <div class="card border border-success">
                    <form role="form" method="post" class="formularioMenu">

                        <div class="card-body">




                            <!-- ENTRADA PARA EL NOMBRE DEL MENÚ-->
                            <div class="form-group row">
                                <div class="col-xs-12 col-12">
                                    <div class="input-group">

                                        <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
                                        <input type="text" class="form-control" id="nuevoMenu" name="nuevoMenu"
                                            placeholder="Ingrese nombre del menú" required>


                                    </div>
                                </div>
                            </div>



                            <!-- ENTRADA PARA SELECCIONAR EL CLIENTE-->
                         
                            <div class="form-group row">
                                <div class="col-sm-12 col-lg-9">
                                    <div class="input-group">

                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                <select class="form-control selectCliente" name="seleccionarCliente" id="seleccionarCliente" required>
                                                    <option value="">Seleccione Cliente</option>
                                                    
                                                    <?php 
                                                    
                                                    $item = null;
                                                    $valor = null;
                                                    $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

                                                    foreach ($clientes as $key => $value){
                                                        echo '<option value="'.$value["id"].'">'.$value["establecimiento"].' - Municipalidad de '.$value["municipio"].' - Partido de '.$value["partido"].'</option>';
                                                    }
                                                    
                                                    ?>


                                                </select>

                                        
                                        
                                                <span class="input-group-prepend d-none d-sm-block">
                                                    <button class="btn btn-warning btn-xs ml-1 rounded" data-toggle="modal"
                                                        data-target="#modalAgregarCliente">
                                                        Crear Cliente
                                                    </button>
                                                    <button class="btn btn-danger btn-xs ml-1 rounded" data-toggle="modal"
                                                        data-target="#modalAgregarIngrediente">
                                                        Crear Ingrediente
                                                    </button>
                                                </span>
                                    </div>

                                </div>

                                    <div class="col-xs-12 form-group">
                                    <div class="icheck-success ">
                                    <input  type="checkbox" id="nuevoDmc" name="nuevoDmc">
                                    
                                    <label  class="ml-5 text-danger" for="nuevoDmc">Es un menu tipo DMC?
                                    </label>
                                    <input type="hidden" name="valorDmc" id="valorDmc">
                                

                                    </div>
                                </div>
                            </div>

                            
                            <!-- ENTRADA PARA AGREGAR INGREDIENTES-->
                            <div class="form-group nuevoIngredienteMenu">
                                

                            </div>
                            <input type="hidden" id="ingredientesFinal" name="ingredientesFinal">
                         
                            



                            <!-- BOTON AGREGAR INGREDIENTE AL MENU -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info btnAgregarIngrediente">Agregar Ingrediente</button>
                                    </div>
                                </div>
                            </div>

                            
                            <hr>

                            <!-- FORMULARIO PRECIO COSTO MENU -->

                            <div class="row">
                                <div class="col-12">
                                    <table class="float-right">

                                        <tbody>
                                            <td>
                                                <div class="input-group">

                                                    <span class="input-group-text"><i
                                                            class="fas fa-money-bill-alt"></i></span>
                                                    <input type="text" class="form-control form-control-lg"
                                                        id="nuevoPrecioMenu" name="nuevoPrecioMenu" placeholder="0"
                                                        required readonly>

                                                </div><span class="text-success">Costo total del menú</span>

                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>







                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-lg float-right botonGuardar">Guardar Menú</button>
                        </div>

                    </form>
                    
                            <!-- =========================================
                            MODAL AGREGAR CLIENTE
                            =========================================  -->


                            <!-- Modal -->
                            <div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCliente"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">


                                        <form role="form" method="post" action="">


                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="form-group">

                                                        <!-- Entrada para el partido Cliente -->
                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-map-marker-alt"></i></span>
                                                                </div>

                                                                <input class="form-control" type="text" id="nuevoPartido" name="nuevoPartido"
                                                                    placeholder="Ingrese Partido" required>

                                                            </div>

                                                        </div>

                                                        <!-- Entrada para el municipio de Cliente -->
                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-thumbtack"></i></span>
                                                                </div>

                                                                <input class="form-control" type="text" id="nuevoMunicipio" name="nuevoMunicipio"
                                                                    placeholder="Ingrese Municipio" required>

                                                            </div>

                                                        </div>

                                                        <!-- Entrada para el organo gubernamental -->

                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-university"></i></span>
                                                                </div>

                                                                <input class="form-control" type="text" id="nuevoOrgano" name="nuevoOrgano"
                                                                    placeholder="Ingrese Órgano Gubernamental">

                                                            </div>

                                                        </div>


                                                        <!-- Entrada para el establecimiento -->

                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-graduation-cap"></i></span>
                                                                </div>

                                                                <input class="form-control" type="text" id="nuevoEstablecimiento"
                                                                    name="nuevoEstablecimiento" placeholder="Ingrese nombre del establecimiento"
                                                                    required>

                                                            </div>

                                                        </div>

                                                        <!-- Entrada para el CUIT -->

                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-money-check"></i></span>
                                                                </div>

                                                                <input class="form-control" type="text" id="nuevoCuit" name="nuevoCuit"
                                                                    placeholder="Ingrese CUIT">

                                                            </div>
                                                            <span class="small">Sin Guiones, sólo números</span>

                                                        </div>


                                                        <!-- Entrada para el numero de cupos COMEDOR -->

                                                        <div class="form-group">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-universal-access"></i></span>
                                                                </div>

                                                                <input class="form-control" type="number" id="nuevoCupo" name="nuevoCupo"
                                                                    placeholder="Cupos para Comedor" min="0" required>

                                                            </div>

                                                        </div>


                                                            <!-- Entrada para el numero de cupos DMC -->

                                                            <div class="form-group">

                                                                <div class="input-group">

                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                                class="fas fa-universal-access"></i></span>
                                                                    </div>

                                                                    <input class="form-control" type="number" id="nuevoCupoDMC" name="nuevoCupoDMC"
                                                                        placeholder="Cupos para DMC" min="0" required>

                                                                </div>

                                                            </div>

                                                        <!-- Entrada para el tipo de cliente -->

                                                        <div class="input-group">

                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="far fa-check-circle"></i></span>
                                                            </div>

                                                            <select class="form-control" name="nuevoTipo" required>
                                                                <option value="">Seleccione tipo de cliente</option>
                                                                <option value="mun">Municipalizado</option>
                                                                <option value="prov">Provincial</option>





                                                            </select>


                                                        </div>






                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-info">Guardar</button>
                                            </div>


                                            <?php

                                        $crearCliente = new ControladorClientes();
                                        $crearCliente -> ctrCrearCliente();
                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>

                           <!-- =========================================
MODAL AGREGAR INGREDIENTE
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalAgregarIngrediente" tabindex="-1" role="dialog"
    aria-labelledby="modalAgregarIngrediente" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <form role="form" method="post" action="">


                <div class="modal-header">
                    <h5 class="modal-title"  id="exampleModalLongTitle">Agregar Ingrediente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">

                            <!-- Entrada para el nombre de ingrediente -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-seedling"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="nuevoIngrediente"
                                        name="nuevoIngrediente" placeholder="Ingrese Nombre de Ingrediente" required>

                                </div>

                            </div>

                            <!-- Entrada para el precio de ingrediente -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-money-bill-wave"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="nuevoPrecio" min="0" step="any"
                                        name="nuevoPrecio" placeholder="Ingrese Precio" required>

                                </div>

                            </div>





                            <!-- Entrada para la unidad de medida -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-weight-hanging"></i></span>
                                    </div>

                                    <select class="form-control" name="nuevaUnidad" id="">
                                        <option value="1">Kilo</option>
                                        <option value="2">Litro</option>
                                        <option value="3">Unidad</option>
                                    </option></select>

                                </div>

                            </div>





                        </div>
                                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>

                <?php

                                    $cargarIngrediente = new ControladorIngredientes();
                                    $cargarIngrediente -> ctrCargarIngrediente();
                                ?>

            </form>
        </div>
    </div>
</div>



                    <script lang="javascript">

                        $('.botonGuardar').unbind('click'); // desactiva el comportamiento por defecto
                        $('.botonGuardar').click(function(event){
                        event.preventDefault();
                        event.stopPropagation();
                         // Guardo el nombre del menu

                                    // Guardo el cliente 

                                    // Corroboro que el Menu sea DMC
                                    var dmc = $("input[type=checkbox][name=nuevoDmc]:checked").val();
                                    if (dmc == "on") {
                                        $("#valorDmc").val("si");
                                        
                                    } else {
                                        $("#valorDmc").val("no");
                                    }

                                    // Creo el objeto JSON 

                                    listaIngredientes = [];

                                    $(".listaIngredientes").each(function() {
                                        var ingrediente = $(this).children(".col-6").children().children(".nuevoNombreIngrediente").val();
                                        var cantidad = $(this).children(".col-2").children(".nuevaCantidadIngrediente").val();
                                        var precio = $(this).children(".ingresoPrecio").children().children(".precioIngrediente").val();
                                        var unidad = $(this).children(".div-unidad").children(".unidad-de-medida").val();
                                        var id = $(this).children(".col-6").children().children(".ingredienteID").val();

                                        listaIngredientes.push({
                                            "id" : id,
                                            "cantidad": cantidad
                                            
                                        })
                                    })




                                    $("#ingredientesFinal").val(JSON.stringify(listaIngredientes));
                                    
                                    console.log(listaIngredientes)
                                $('.formularioMenu').submit();
                        }); // Fin del método
                        </script>
                    <?php
                            
                            $crearMenu = new ControladorViandas();
                            $crearMenu -> ctrCrearVianda();
                                                        
                    ?>
                </div>

            </div>

        </div>


    </section>
    <!-- /.content -->
</div>

