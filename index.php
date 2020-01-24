<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/viandas.controlador.php";
require_once "controladores/remitos.controlador.php";
require_once "controladores/ingredientes.controlador.php";
require_once "controladores/unidades.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/viandas.modelo.php";
require_once "modelos/remitos.modelo.php";
require_once "modelos/ingredientes.modelo.php";
require_once "modelos/unidades.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();