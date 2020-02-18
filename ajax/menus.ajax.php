<?php

require_once "../controladores/viandas.controlador.php";
require_once "../controladores/ingredientes.controlador.php";
require_once "../controladores/unidades.controlador.php";
require_once "../modelos/ingredientes.modelo.php";
require_once "../modelos/viandas.modelo.php";
require_once "../modelos/unidades.modelo.php";



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

        $respuesta2 = ModeloViandas::mdlObtenerIngredientes($respuesta["id"]);

        
        foreach($respuesta2 as &$value){
            $idIngrediente = $value["id_ingrediente"];
            $item = "id";

            $respuestaIng = ControladorIngredientes::ctrMostrarIngredientes($item, $idIngrediente);
            
            $value["nombre"]=$respuestaIng["nombre"];

            $idUnidad = $respuestaIng["id_unidad"];

            $respuestaUnidad = ControladorUnidades::ctrMostrarUnidades($item, $idUnidad);

            $value["unidad"]=$respuestaUnidad["nomenclatura"];
            
        }
        

        
            
        echo json_encode($respuesta2);
            
    }

    
    /*===============================================
    MOSTRAR VIANDA DMC
    ===============================================*/
    
    public $idDmc;
    
    public function ajaxMostrarViandaDmc(){
        
        
        $item = "id";
        $valor = $this->idDmc;
       
        $respuesta = ControladorViandas::ctrMostrarViandas($item, $valor);

        $respuesta2 = ModeloViandas::mdlObtenerIngredientes($respuesta["id"]);

        
        foreach($respuesta2 as &$value){
            $idIngrediente = $value["id_ingrediente"];
            $item = "id";

            $respuestaIng = ControladorIngredientes::ctrMostrarIngredientes($item, $idIngrediente);
            
            $value["nombre"]=$respuestaIng["nombre"];

            $idUnidad = $respuestaIng["id_unidad"];

            $respuestaUnidad = ControladorUnidades::ctrMostrarUnidades($item, $idUnidad);

            $value["unidad"]=$respuestaUnidad["nomenclatura"];
            
        }

        
        
        echo json_encode($respuesta2);
        
    }

    /*===============================================
    TRAER NOMBRE INGREDIENTE
    ===============================================*/
    
    public $idIngrediente;
    
    public function ajaxMostrarIngrediente(){
        
        
        $item = "id";
        $valor = $this->idIngrediente;
       
        $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);
      
            
        echo json_encode($respuesta);
        
    }

      /*===============================================
    TRAER NOMENCLATURA UNIDAD
    ===============================================*/
    
    public $idUnidad;
    
    public function ajaxMostrarUnidad(){
        
        
        $item = "id";
        $valor = $this->idUnidad;
       
        $respuesta = ControladorUnidades::ctrMostrarUnidades($item, $valor);
      
        
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

/*=========================================
OBJETO TRAER DATOS INGREDIENTE
=========================================*/
if(isset($_POST["idIngrediente"])){
    
    $mostrarIngrediente = new AjaxViandas();
    $mostrarIngrediente -> idIngrediente = $_POST["idIngrediente"];
    $mostrarIngrediente -> ajaxMostrarIngrediente();

} 

/*=========================================
OBJETO TRAER UNIDAD
=========================================*/
if(isset($_POST["idUnidad"])){
    
    $mostrarUnidad = new AjaxViandas();
    $mostrarUnidad -> idUnidad = $_POST["idUnidad"];
    $mostrarUnidad -> ajaxMostrarUnidad();

} 