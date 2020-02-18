<?php

require_once("conexion.php");


class ModeloViandas{
     /*============================================
    MOSTRAR VIANDAS
    ============================================*/
    static public function mdlMostrarViandas($tabla,$item,$valor)
    {
        if($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            
            $stmt -> execute();
            
            return $stmt -> fetch();
            
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            
            $stmt -> execute();
            
            return $stmt -> fetchAll();
        }
        
        
        
        $stmt -> close();
        
        $stmt = null;
    }

    /*============================================
    MOSTRAR VIANDAS POR CLIENTE
    ============================================*/
    static public function mdlMostrarViandasCliente($tabla,$item,$valor)
    {
        
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            
            $stmt -> execute();
            
            return $stmt -> fetchAll();
            
        
        
        
        
        $stmt -> close();
        
        $stmt = null;
    }


       /*============================================
    OBTENER ID ULTIMA VIANDA
    ============================================*/
    static public function mdlUltimaVianda(){
                    $tabla = "viandas";
                    $item = "id";
                    $id_vianda = Conexion::conectar()->prepare("SELECT id FROM $tabla ORDER BY id DESC");
                    
                    $id_vianda -> execute();
                    return $id_vianda -> fetch();
    }

       /*============================================
    OBTENER INGREDIENTES DE UNA VIANDA
    ============================================*/
    static public function mdlObtenerIngredientes($idMenu){
        $tabla = "menuingre";
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_vianda = $idMenu");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;

    }

     /*============================================
    CARGAR VIANDA
    ============================================*/
    
    static public function mdlCrearVianda($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, id_cliente, costo, dmc) VALUES ( :nombre, :id_cliente , :costo, :dmc)");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
        $stmt->bindParam(":dmc", $datos["dmc"], PDO::PARAM_STR);
        
        
        if($stmt->execute()){

                    // Aca tendria que hacer una consulta para recuperar el ultimo id cargado
                    

                                 // Aca va la consulta para agregar el id menu, id ingrediente y cantidad a la tabla menuingr
                     $tabla2 = "menuingre";
                     $vianda = ModeloViandas::mdlUltimaVianda();
                    
                           
                            $datosJson = json_decode($datos["productos"], true);
                            
                            $id_vianda = $vianda["id"];
                           
                             foreach($datosJson as $value){

                               
                                
                                $id_ingrediente = $value["id"];
                               
                                $cantidad = $value["cantidad"];
                            

                                $insertarMenuIngr = Conexion::conectar()->prepare("INSERT INTO $tabla2(id_ingrediente, id_vianda, cantidad) VALUES (:id_ingrediente, :id_vianda, :cantidad)");

                                $insertarMenuIngr->bindParam(":id_ingrediente", $id_ingrediente, PDO::PARAM_STR);
                                $insertarMenuIngr->bindParam(":id_vianda", $id_vianda, PDO::PARAM_STR);
                                $insertarMenuIngr->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);

                                $insertarMenuIngr -> execute();

                             }
       
            return "ok";
            
       
        
        $stmt -> close();
        
        $stmt = null;
        
        
    } else {return "error"; }
    }

        /*============================================
        EDITAR VIANDA
        ============================================*/
        
        static public function mdlEditarVianda($tabla, $datos){
            
            
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_cliente = :id_cliente, costo = :costo, dmc = :dmc WHERE id = :id");   
            
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
            $stmt->bindParam(":dmc", $datos["dmc"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                                        $tabla2 = "menuingre";
                                        $datosJson = json_decode($datos["productos"], true);
                                        
                                        $id_vianda = $datos["id"];

                                        // Elimino todos los "menuingre" correspondientes a esta vianda
                                            $eliminar = Conexion::conectar()->prepare("DELETE FROM $tabla2 WHERE id_vianda = $id_vianda");
                                            $eliminar->bindParam(":id_vianda", $id_vianda, PDO::PARAM_STR);
                                            $eliminar->execute();
                                            
                                  
                                         foreach($datosJson as $value){
                                                        
                                            $id_ingrediente = $value["id"];
                                            $cantidad = $value["cantidad"];
                                            
                                            $insertarMenuIngr = Conexion::conectar()->prepare("INSERT INTO $tabla2(id_ingrediente, id_vianda, cantidad) VALUES (:id_ingrediente, :id_vianda, :cantidad)");
            
                                            $insertarMenuIngr->bindParam(":id_ingrediente", $id_ingrediente, PDO::PARAM_STR);
                                            $insertarMenuIngr->bindParam(":id_vianda", $id_vianda, PDO::PARAM_STR);
                                            $insertarMenuIngr->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            
                                            $insertarMenuIngr -> execute();
            
                                         }
                   
                        return "ok";
                        
                   
                    
                    $stmt -> close();
                    
                    $stmt = null;
                    
                    
                } else {return "error"; }
                }

    /*============================================
    ELIMINAR VIANDA
    ============================================*/

    static public function mdlEliminarVianda($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");   
        
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);

        
        
        if($stmt->execute()){
            $tabla2 = "menuingre";
            $stmt2 = Conexion::conectar()->prepare("DELETE FROM $tabla2 WHERE id_vianda = :id");   
            $stmt2->bindParam(":id", $datos, PDO::PARAM_STR);

            $stmt2->execute();
         
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;


    }



     /*============================================
    CALCULAR COSTO VIANDA
    ============================================*/
    static public function mdlCalcularCosto($idVianda){
        $tabla1 = "menuingre";
        $stmt1 = Conexion::conectar()->prepare("SELECT * FROM $tabla1 WHERE id_vianda = $idVianda");
        $stmt1->bindParam(":id_vianda", $idVianda, PDO::PARAM_STR);
        $stmt1 -> execute();
        $ingredientes = $stmt1 -> fetchAll();
        $costo = 0;
        foreach ($ingredientes as $value) {
           
            $id_ingr = ($value["id_ingrediente"]);
            $cant = ($value["cantidad"]);
            $tabla2 = "ingredientes";
            $stmt2 = Conexion::conectar()->prepare("SELECT precio FROM $tabla2 WHERE id = $id_ingr");
            $stmt2->execute();
            $precio = $stmt2->fetch();
            $costo = $costo + ((float)$precio["precio"] * $cant);


        }
        return $costo;
        $stmt1 -> close();
        
        $stmt1= null;

    }


}


?>