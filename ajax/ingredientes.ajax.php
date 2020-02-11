<?php 

require_once "../modelos/ingredientes.modelo.php";

require_once "../controladores/ingredientes.controlador.php";

class AjaxIngredientes{




    /*=====================
    EDITAR INGREDIENTES
    =======================*/


    public $idIngrediente;
    public $nombreIngrediente;
    public $traerIngredientes;
    

    public function ajaxEditaringrediente(){

        $item = "id";
        $valor = $this->idIngrediente;

        $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);

        echo json_encode($respuesta);

    }


    
   

    public function ajaxMostraringrediente(){

        
        if($this->traerIngredientes == "ok"){
            $item = null;
            $valor = null;

            $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);

            echo json_encode($respuesta);
            
        }else if($this->nombreIngrediente != ""){

            $item = "nombre";
            $valor = $this->nombreIngrediente;

            $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);

            echo json_encode($respuesta);

        }else{
            $item = "id";
            
            $valor = $this->idIngrediente;

            $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);

            echo json_encode($respuesta);

        }

        
    }



}



  /*=====================
    EDITAR INGREDIENTES
    =======================*/

    if(isset($_POST["idIngrediente"])){

        $editarIngrediente = new AjaxIngredientes();
        $editarIngrediente -> idIngrediente = $_POST["idIngrediente"];
        $editarIngrediente -> ajaxEditaringrediente();

    }


    /*=====================
    TRAER INGREDIENTES
    =======================*/

    if(isset($_POST["traerIngredientes"])){

        $traerIngredientes = new AjaxIngredientes();
        $traerIngredientes -> traerIngredientes = $_POST["traerIngredientes"];
        $traerIngredientes -> ajaxMostraringrediente();

    }

     /*=====================
    TRAER INGREDIENTES
    =======================*/

    if(isset($_POST["nombreIngrediente"])){

        $nombreIngrediente = new AjaxIngredientes();
        $nombreIngrediente -> nombreIngrediente = $_POST["nombreIngrediente"];
        $nombreIngrediente -> ajaxMostraringrediente();

    }
