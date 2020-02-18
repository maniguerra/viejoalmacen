<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-cyan">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown user user-menu">

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <!-- Message Start -->

        <li class="nav-item mr-2">
            <a class="nav-link dropdown-toggle " data-widget="control-sidebar" data-slide="true" href="#"
                data-toggle="dropdown">
                <img src="vistas\img\usuarios\anonymous.png" alt="Foto de Perfil"
                    class="brand-image img-circle elevation-2  bg-dark" style="opacity: .8">
                <span><?php echo $_SESSION["usuario"]; ?></span>


            </a>
            <div class="dropdown-menu dropdown-menu-right text-center mr-2">


                <a href="salir" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Cerrar sesión</a>
            </div>

        </li>
    </ul>
    <!-- Dropdown-toggle -->
</nav>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info">
    <!-- Brand Logo -->
    <a href="remitos" class="brand-link bg-dark">


        <img src="vistas/img/logos/logo_solo.png" alt="Viejo Almacén Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Viejo Almacén</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
       