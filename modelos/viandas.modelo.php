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
    CARGAR VIANDA
    ============================================*/
    
    static public function mdlCrearVianda($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, id_cliente, productos, costo, dmc) VALUES ( :nombre, :id_cliente, :productos, :costo, :dmc)");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
        $stmt->bindParam(":dmc", $datos["dmc"], PDO::PARAM_STR);
        
        
        if($stmt->execute()){
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;
        
        
        
    }

        /*============================================
        EDITAR VIANDA
        ============================================*/
        
        static public function mdlEditarVianda($tabla, $datos){
            
            
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_cliente = :id_cliente, productos = :productos, costo = :costo, dmc = :dmc WHERE id = :id");   
            
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
            $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
            $stmt->bindParam(":dmc", $datos["dmc"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                
                return "ok";
                
            }else{
                return "error";
            }
            
            $stmt -> close();
            
            $stmt = null;
        
        
        
    }

    /*============================================
    ELIMINAR VIANDA
    ============================================*/

    static public function mdlEliminarVianda($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");   
        
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);

         
        if($stmt->execute()){
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;


    }

}


?>