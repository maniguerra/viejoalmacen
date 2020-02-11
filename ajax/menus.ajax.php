<?php

require_once "../controladores/viandas.controlador.php";
require_once "../modelos/viandas.modelo.php";


class AjaxViandas{

    /*===============================================
    MOSTRAR VIANDAS DEL CLIENTE
    ===============================================*/
    
    public $idCliente;
    
    public function ajaxMostrarViandasCliente(){
        
        
        $item = "id_cliente";
        $valor = $this->idCliente;
       
        $respuesta = ControladorViandas::ctrMostrarViandasCliente($item, $valor);

        
        
        echo json_encode($respuesta);
        
    }

    /*===============================================
    MOSTRAR VIANDA COMEDOR
    ===============================================*/
    
    public $idComedor;
    
    public function ajaxMostrarViandaComedor(){
        
        
        $item = "id";
        $valor = $this->idComedor;
       
        $respuesta = ControladorViandas::ctrMostrarViandas($item, $valor);

        
        
        echo json_encode($respuesta);
        
    }

    
    /*===============================================
    MOSTRAR VIANDA DMC
    ===============================================*/
    
    public $idDmc;
    
    public function ajaxMostrarViandaDmc(){
        
        
        $item = "id";
        $valor = $this->idDmc;
       
        $respuesta = ControladorViandas::ctrMostrarViandas($item, $valor);

        
        
        echo json_encode($respuesta);
        
    }
    
    
}


/*=========================================
OBJETO MOSTRAR VIANDAS DEL CLIENTE
=========================================*/
if(isset($_POST["idCliente"])){
    
    $mostrarViandas = new AjaxViandas();
    $mostrarViandas -> idCliente = $_POST["idCliente"];
    $mostrarViandas -> ajaxMostrarViandasCliente();

} 

/*=========================================
OBJETO MOSTRAR VIANDA COMEDOR
=========================================*/
if(isset($_POST["idComedor"])){
    
    $mostrarComedor = new AjaxViandas();
    $mostrarComedor -> idComedor = $_POST["idComedor"];
    $mostrarComedor -> ajaxMostrarViandaComedor();

} 

/*=========================================
OBJETO MOSTRAR VIANDA DMC
=========================================*/
if(isset($_POST["idDmc"])){
    
    $mostrarDmc = new AjaxViandas();
    $mostrarDmc -> idDmc = $_POST["idDmc"];
    $mostrarDmc -> ajaxMostrarViandaDmc();

} 
