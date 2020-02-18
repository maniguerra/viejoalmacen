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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a href="crear-menu">
                    <button class="btn btn-info">
                        Agregar Menú
                    </button>
                </a>
            </div>



            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive tablas tablaViandas" width="100%">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Menú</th>
                            <th>Cliente</th>
                            <th>Costo</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                        $item = null;
                        $valor = null;
                        $respuesta = ControladorViandas::ctrMostrarViandas($item,$valor);

                        foreach($respuesta as $key => $value){
                            $consulta = ModeloViandas::mdlCalcularCosto($value["id"]);
                            echo '  <tr>
                            <td>'.($key + 1).'</td>
                            <td>'.$value["nombre"].'</td>';
                            $itemCliente = "id";
                            $valorCliente = $value["id_cliente"];
                            $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

                            echo '<td>'.$respuestaCliente["establecimiento"].' - '.$respuestaCliente["partido"].'</td>
                            <td>$ '.number_format($consulta ,2).'</td>
                            <td>';

                            if($value["dmc"] == "si"){
                                echo 'DMC';
                            } else { echo 'Comedor'; }
                            
                            echo '</td>
                            <td>
                                <a href="index.php?ruta=editar-menu&idMenu='.$value["id"].'"><button class="btn btn-warning"><i class="fa fa-pencil-alt"></i></button></a>
                                <button class="btn btn-danger btnEliminarVianda" idMenu="'.$value["id"].'"><i class="fa fa-times"></i></button>
                            </td>';

                            ;
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

<?php

$eliminarVianda = new ControladorViandas();
$eliminarVianda -> ctrEliminarVianda();
?>