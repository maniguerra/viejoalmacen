<?php

require_once "../controladores/ingredientes.controlador.php";
require_once "../modelos/ingredientes.modelo.php";
require_once "../controladores/unidades.controlador.php";
require_once "../modelos/unidades.modelo.php";


class TablaIngredientes{

    /*====================================================================
    MOSTRAR LA TABLA DE INGREDIENTES DINAMICAMENTE
    ====================================================================*/

    public function mostrarTablaIngredientes(){


          $item = null;
          $valor = null;

          $ingredientes = ControladorIngredientes::ctrMostrarIngredientes($item,$valor);

         
          $datosJson = '{
            "data": [';

            for($i = 0; $i < count($ingredientes); $i++){

              $item = "id";
              $valor = $ingredientes[$i]["id_unidad"];
              $botones = "<button class='btn btn-warning btnEditarIngrediente' idIngrediente='".$ingredientes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarIngrediente'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarIngrediente' idIngrediente='".$ingredientes[$i]["id"]."'><i class='fa fa-times'></i></button>";


              $unidades = ControladorUnidades::ctrMostrarUnidades($item,$valor);


            $datosJson .='
              [
                "'.($i + 1).'",
                "'.$ingredientes[$i]["nombre"].'",
                "'.$unidades["nombre"].'",
                "$ '.$ingredientes[$i]["precio"].' x '.$unidades["nomenclatura"].'",
                "'.$botones.'"
              ],';  
            }

            $datosJson = substr($datosJson, 0, -1);


            $datosJson .=']}';

            echo $datosJson;
        



    }
}


    /*====================================================================
    ACTIVAR LA TABLA DE INGREDIENTES DINAMICAMENTE
    ====================================================================*/


    $activarIngredientes = new TablaIngredientes();
    $activarIngredientes -> mostrarTablaIngredientes();