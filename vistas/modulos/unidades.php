<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Unidades de Medida<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><i class="fas fa-users-cog"></i></li>
                        <li class="breadcrumb-item active">Unidades de Medida</li>
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
                <button class="btn btn-info" data-toggle="modal" data-target="#modalAgregarUnidad">
                    Agregar Unidad de Medida
                </button>
            </div>



            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive tablas tablaUnidades" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Nomenclatura</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php

                    $item = null;
                    $valor = null;

                     $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);


                    foreach ($unidades as $key => $value){
                        echo '
                        <tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["nomenclatura"].'</td>
                        <td>
                            <button class="btn btn-warning btnEditarUnidad" idUnidad="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarUnidad"><i class="fa fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btnEliminarUnidad" idUnidad="'.$value["id"].'"><i class="fa fa-times"></i></button>
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
MODAL AGREGAR UNIDAD DE MEDIDA
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalAgregarUnidad" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUnidad"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <form role="form" method="post" action="">


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Unidad de Medida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">

                            <!-- Entrada para el nombre de Unidad de Medida-->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-balance-scale-right"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="nuevaUnidad" name="nuevaUnidad"
                                        placeholder="Ingrese Nombre de Unidad de Medida" required>

                                </div>

                            </div>

                            <!-- Entrada para la nomenclatura -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-weight-hanging"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="nuevaNomen" name="nuevaNomen"
                                        placeholder="Ingrese Nomenclatura" required>

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

                        $crearUnidad = new ControladorUnidades();
                        $crearUnidad -> ctrCrearUnidad();
                    ?>

            </form>
        </div>
    </div>
</div>

<!-- =========================================
MODAL EDITAR UNIDAD DE MEDIDA
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalEditarUnidad" tabindex="-1" role="dialog" aria-labelledby="modalEditarUnidad"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <form role="form" method="post" action="">


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Unidad de Medida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">

                            <!-- Entrada para el nombre de Unidad -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-balance-scale-right"></i></span>
                                    </div>

                                    <input class="form-control" type="text" name="editarUnidad" id="editarUnidad"
                                        required>
                                    <input type="hidden" id="idUnidad" name="idUnidad">
                                </div>

                            </div>


                            <!-- Entrada para la nomenclatura -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-weight-hanging"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarNomen" name="editarNomen"
                                        placeholder="Ingrese Nomenclatura" required>

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

            $editarUnidad = new ControladorUnidades();
            $editarUnidad -> ctrEditarUnidad();
        ?>

            </form>
        </div>
    </div>
</div>

<?php

            $eliminarUnidad = new ControladorUnidades();
            $eliminarUnidad -> ctrEliminarUnidad();
        ?>