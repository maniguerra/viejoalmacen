<?php
  session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Viejo Almacén</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="vistas/img/logos/logo_solo.png">
    <!-- PLUGINS DE CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="vistas\dist\css\ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="vistas\dist\css\css.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vistas\dist\css\responsive.dataTables.min.css">
    <link rel="stylesheet" href="vistas\dist\css\rowReorder.dataTables.min.css">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="vistas\plugins\sweetalert2\sweetalert2.css">
    <script src="vistas\dist\js\promise.min.js"></script>
    <!-- iCheck -->
    <link rel="stylesheet" href="vistas\plugins\icheck-bootstrap\icheck-bootstrap.min.css">




    <!-- PLUGINS DE JAVASCRIPT -->
    <script src="vistas/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="vistas/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
    <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="vistas\dist\js\dataTables.responsive.min.js"></script>
    <script src="vistas\dist\js\dataTables.rowReorder.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="vistas\plugins\sweetalert2\sweetalert2.all.js"></script>
    <script src="vistas\plugins\sweetalert2\sweetalert2.js"></script>
   
    

</head>

<body class="hold-transition sidebar-collapse sidebar-mini login-page">

    <!-- Site wrapper -->


  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ){

   
        /*=================================================
        ENCABEZADO
        =================================================*/

        include "modulos/header.php";


        /*=================================================
        MENU LATERAL
        =================================================*/

        include "modulos/menu.php";


        /*=================================================
        CONTENIDO
        =================================================*/

        if(isset($_GET["ruta"])){

          if($_GET["ruta"] == "inicio" || 
             $_GET["ruta"] == "remitos" || 
             $_GET["ruta"] == "clientes" || 
             $_GET["ruta"] == "viandas" || 
             $_GET["ruta"] == "salir" || 
             $_GET["ruta"] == "usuarios" ||
             $_GET["ruta"] == "ingredientes" ||
             $_GET["ruta"] == "unidades"
             ){

                include "modulos/".$_GET["ruta"].".php";
          
             }else{
              include "modulos/404.php";

             }
        }

        




        /*=================================================
        PIE DE PAGINA
        =================================================*/
        include "modulos/footer.php";

       
      }else{
        include "modulos/login.php";
      }

  ?>

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuario.js"></script>
<script src="vistas/js/unidad.js"></script>
<script src="vistas/js/ingrediente.js"></script>
   

</body>

</html>