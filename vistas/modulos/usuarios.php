<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios<small> - Viejo Almacén</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><i class="fas fa-users-cog"></i></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
               <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar Usuario
                </button>
            </div>



            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    $item = null;
                    $valor = null;

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);


                    foreach ($usuarios as $key => $value){
                        echo '
                        <tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["usuario"].'</td>
                        <td>'.$value["perfil"].'</td>
                        <td>
                            <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'"><i class="fa fa-times"></i></button>
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
MODAL AGREGAR USUARIO
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">


        <form role="form" method="post" action="">


      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
         <div class="form-group">
            <!-- Entrada para el nombre de usuario -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>

                    <input class="form-control" type="text" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingrese Nombre de Usuario"
                        required>

                </div>

            </div>

            <!-- Entrada para el password -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>

                    <input class="form-control" type="password" name="nuevoPassword" placeholder="Ingrese Contraseña"
                        required>

                </div>

            </div>

            <!-- Entrada para el password 2 -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>

                    <input class="form-control" type="password" name="nuevoPassword2" placeholder="Ingrese Contraseña Nuevamente"
                        required>

                </div>

            </div>

            <!-- Entrada para el perfil -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                    </div>

                    <select class="form-control" name="nuevoPerfil">
                        <option value="">Seleccionar Perfil</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Normal">Normal</option>
                    
                    </select>

                </div>

            </div>



         </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>

      <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario -> ctrCrearUsuario();

      ?>
      </form>
    </div>
  </div>
</div>

<!-- =========================================
MODAL EDITAR USUARIO
=========================================  -->


<!-- Modal -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">


        <form role="form" method="post" action="">


      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
         <div class="form-group">
            <!-- Entrada para el nombre de usuario -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>

                    <input class="form-control" type="text" name="editarUsuario" id="editarUsuario"
                       readonly >

                </div>

            </div>

            <!-- Entrada para el password -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>

                    <input class="form-control" type="password" name="editarPassword" placeholder="Ingrese Nueva Contraseña"
                        >
                    <input type="hidden" id="passwordActual" name="passwordActual">

                </div>

            </div>

            <!-- Entrada para el password 2 -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>

                    <input class="form-control" type="password" name="editarPassword2" placeholder="Ingrese Contraseña Nuevamente"
                        >

                </div>

            </div>

            <!-- Entrada para el perfil -->
            <div class="form-group">

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                    </div>

                    <select class="form-control" name="editarPerfil">
                        <option value="" id="editarPerfil"></option>
                        <option value="Administrador">Administrador</option>
                        <option value="Normal">Normal</option>
                    
                    </select>

                </div>

            </div>



         </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>

      <?php

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario -> ctrEditarUsuario();
        ?>
      
      </form>
    </div>
  </div>
</div>


<?php

    $eliminarUsuario = new ControladorUsuarios();
    $eliminarUsuario -> ctrEliminarUsuario();
?>