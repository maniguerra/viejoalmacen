<?php

require_once "conexion.php";


class ModeloUnidades{
    
    
    /*============================================
    CREAR UNIDAD DE MEDIDA
    ============================================*/
    static public function mdlCrearUnidad($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, nomenclatura) VALUES ( :nombre, :nomenclatura)");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":nomenclatura", $datos["nomenclatura"], PDO::PARAM_STR);
        
        
        if($stmt->execute()){
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;
        
        
        
    }
    
    
    
    /*============================================
    MOSTRAR UNIDADES DE MEDIDA
    ============================================*/
    
    static public function mdlMostrarUnidades($tabla,$item,$valor){
        
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
    EDITAR UNIDAD DE MEDIDA
    ============================================*/
    static public function mdlEditarUnidad($tabla, $datos){
        
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, nomenclatura = :nomenclatura WHERE id = :id");   
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":nomenclatura", $datos["nomenclatura"], PDO::PARAM_STR);
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
    ELIMINAR UNIDAD DE MEDIDA
    ============================================*/

    static public function mdlEliminarUnidad($tabla,$datos){

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