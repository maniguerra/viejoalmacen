<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"> <i class="fas fa-users"></i></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <button class="btn btn-info" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar Cliente
                </button>
            </div>



            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive tablas tablaClientes" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Partido</th>
                            <th>Municipio</th>
                            <th>Org. Gubernamental</th>
                            <th>Establecimiento</th>
                            <th>CUIT</th>
                            <th>Cupos Comedor</th>
                            <th>Cupos DMC</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>


                    <tbody>

                        <?php

                            $item = null;
                            $valor = null;

                            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);


                            foreach ($clientes as $key => $value){

                                $tipo;
                                if($value["tipo"] == "mun"){
                                    $tipo = '<i class="fab fa-medium-m" title="Municipalizado"></i>';
                                }else{
                                    $tipo = '<i class="fab fa-product-hunt" title="Provincial"></i>';
                                }

                                echo '
                                <tr>
                                <td>'.($key + 1).'</td>
                                <td>'.$value["partido"].'</td>
                                <td>'.$value["municipio"].'</td>
                                <td>'.$value["organo"].'</td>
                                <td>'.$value["establecimiento"].'</td>
                                <td>'.$value["cuit"].'</td>
                                <td>'.$value["cupos"].'</td>
                                <td>'.$value["cupos_dmc"].'</td>
                                <td>'.$tipo.'</td>
                                <td>
                                    <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"s><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                                ';
                            }

                            ?>



                    </tbody>





                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


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
MODAL EDITAR CLIENTE
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="editarCliente"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <form role="form" method="post" action="">


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Cliente</h5>
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

                                    <input class="form-control" type="text" id="editarPartido" name="editarPartido"
                                        required>
                                    <input type="hidden" id="idCliente" name="idCliente">

                                </div>

                            </div>

                            <!-- Entrada para el municipio de Cliente -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-thumbtack"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarMunicipio" name="editarMunicipio"
                                        required>

                                </div>

                            </div>

                            <!-- Entrada para el organo gubernamental -->

                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-university"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarOrgano" name="editarOrgano">

                                </div>

                            </div>


                            <!-- Entrada para el establecimiento -->

                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-graduation-cap"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarEstablecimiento"
                                        name="editarEstablecimiento" required>

                                </div>

                            </div>

                            <!-- Entrada para el CUIT -->

                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-money-check"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarCuit" name="editarCuit">

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

                                    <input class="form-control" type="number" id="editarCupo" name="editarCupo"
                                        required>

                                </div>

                            </div>

                              <!-- Entrada para el numero de cupos DMC -->

                              <div class="form-group">

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fas fa-universal-access"></i></span>
                                            </div>

                                            <input class="form-control" type="number" id="editarCupoDMC" name="editarCupoDMC"
                                                required>

                                        </div>

                                </div>

                                <!-- Entrada para el tipo de cliente -->
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="far fa-check-circle"></i></span>
                                </div>

                                <select class="form-control" name="editarTipo" required>


                                    <option value="" id="editarTipo"></option>
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

            $editarCliente = new ControladorClientes();
            $editarCliente -> ctrEditarCliente();
      ?>

            </form>
        </div>
    </div>
</div>


<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente -> ctrEliminarCliente();
?>