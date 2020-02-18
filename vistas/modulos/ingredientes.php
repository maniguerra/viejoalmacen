<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ingredientes<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><i class="fas fa-users-cog"></i></li>
                        <li class="breadcrumb-item active">Ingredientes</li>
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
                <button class="btn btn-info" data-toggle="modal" data-target="#modalAgregarIngrediente">
                    Agregar Ingrediente
                </button>
            </div>



            <div class="modal-body">
                <table class="table table-bordered table-striped dt-responsive tablaIngredientes" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Ingrediente</th>
                            <th>Unidad de Medida</th>
                            <th>Precio de Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        
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

                                  

                                    <select class="form-control" name="nuevaUnidad">
                                        <option value="1">Kilo</option>
                                        <option value="2">Litro</option>
                                        <option value="3">Unidad</option>
                                    </option></select>

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

<!-- =========================================
MODAL EDITAR INGREDIENTE
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalEditarIngrediente" tabindex="-1" role="dialog" aria-labelledby="modalEditarIngrediente"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <form role="form" method="post" action="">


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Ingrediente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                        <div class="form-group">
                            <!-- Entrada para el nombre de Ingrediente -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-seedling"></i></span>
                                    </div>

                                    <input class="form-control" type="text" name="editarIngrediente"
                                        id="editarIngrediente" required>
                                    <input type="hidden" name="idIngrediente" id="idIngrediente">

                                </div>

                            </div>

                            <!-- Entrada para el precio de ingrediente -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-money-bill-wave"></i></span>
                                    </div>

                                    <input class="form-control" type="text" id="editarPrecio" min="0" step="any"
                                        name="editarPrecio" required>

                                </div>

                            </div>



                            <!-- Entrada para la unidad de medida -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-weight-hanging"></i></span>
                                    </div>

                                    <select class="form-control" name="editarUnidad">
                                        <option id="editarUnidad" value=""></option>
                                        <option value="1">Kilo</option>
                                        <option value="2">Litro</option>
                                        <option value="3">Unidad</option>
                                    </option></select>

                                </div>

                            </div>



                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>

                <?php

                            $editarIngrediente = new ControladorIngredientes();
                            $editarIngrediente -> ctrEditarIngrediente();

                ?>

            </form>
        </div>
    </div>
</div>


<?php

            $eliminarIngrediente = new ControladorIngredientes();
            $eliminarIngrediente -> ctrEliminarIngrediente();
        ?>