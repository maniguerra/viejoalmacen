<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

/*=========================================
EDITAR USUARIO
=========================================*/

    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    
        echo json_encode($respuesta);
    }


    /*=========================================
    NO REPETIR USUARIO
    =========================================*/

        public $validarUsuario;

        public function ajaxValidarUsuario(){

        $item = "usuario";
        $valor = $this->validarUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    
        echo json_encode($respuesta);


        }
}

/*=========================================
EDITAR USUARIO
=========================================*/
if(isset($_POST["idUsuario"])){
    
    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
}


/*=========================================
VALIDAR USUARIO NO REPETIDO
=========================================*/
if(isset($_POST["validarUsuario"])){

    $valUsuario = new AjaxUsuarios();
    $valUsuario -> validarUsuario = $_POST["validarUsuario"];
    $valUsuario -> ajaxValidarUsuario();
}