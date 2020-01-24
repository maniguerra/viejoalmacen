<?php 

require_once "conexion.php";

class ModeloIngredientes{


    static public function mdlMostrarIngredientes($tabla,$item,$valor)
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
    CARGAR INGREDIENTES
    ============================================*/
    
    static public function mdlCrearIngredientes($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_unidad, nombre, precio) VALUES ( :id_unidad, :nombre, :precio)");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        
        
        if($stmt->execute()){
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;
        
        
        
    }


     /*============================================
    EDITAR INGREDIENTE
    ============================================*/

    static public function mdlEditarIngrediente($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_unidad = :id_unidad, nombre = :nombre, precio = :precio WHERE id = :id");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
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
    ELIMINAR INGREDIENTE
    ============================================*/

    static public function mdlEliminarIngrediente($tabla,$datos){

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