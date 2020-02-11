<?php

require_once "../controladores/unidades.controlador.php";
require_once "../modelos/unidades.modelo.php";


class AjaxUnidades{
    
    /*===============================================
    EDITAR UNIDAD
    ===============================================*/
    
    public $idUnidad;
    
    public function ajaxEditarUnidad(){
        
        
        $item = "id";
        $valor = $this->idUnidad;
        $respuesta = ControladorUnidades::ctrMostrarUnidades($item, $valor);
        
        echo json_encode($respuesta);
        
    }

    /*===============================================
    MOSTRAR UNIDAD
    ===============================================*/
    public function ajaxMostrarUnidad(){

        
        if($this->id_unidad != ""){
            $item = "id";
            $valor = $this->idUnidad;;

            $respuesta = ControladorUnidades::ctrMostrarUnidades($item, $valor);

            echo json_encode($respuesta);
            
        }
    }
    
}


/*=========================================
EDITAR UNIDAD
=========================================*/
if(isset($_POST["idUnidad"])){
    
    $editar = new AjaxUnidades();
    $editar -> idUnidad = $_POST["idUnidad"];
    $editar -> ajaxEditarUnidad();
}

/*=========================================
MOSTRAR UNIDAD
=========================================*/
if(isset($_POST["id_unidad"])){
    
    $mostrar = new AjaxUnidades();
    $mostrar -> idUnidad = $_POST["id_unidad"];
    $mostrar -> ajaxEditarUnidad();
}