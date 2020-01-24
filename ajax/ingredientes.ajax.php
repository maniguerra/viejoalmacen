<?php 

require_once "../modelos/ingredientes.modelo.php";

require_once "../controladores/ingredientes.controlador.php";

class AjaxIngredientes{




    /*=====================
    EDITAR INGREDIENTES
    =======================*/


    public $idIngrediente;

    public function ajaxEditaringrediente(){

        $item = "id";
        $valor = $this->idIngrediente;

        $respuesta = ControladorIngredientes::ctrMostrarIngredientes($item, $valor);

        echo json_encode($respuesta);

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

