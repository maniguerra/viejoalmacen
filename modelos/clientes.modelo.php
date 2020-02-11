<?php

require_once("conexion.php");

class ModeloClientes{


    
         /*============================================
        CREAR CLIENTE
        ============================================*/
    static public function mdlCrearCliente($tabla,$datos){

        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(partido, municipio, organo, establecimiento, cuit, cupos, cupos_dmc, tipo) VALUES ( :partido, :municipio, :organo, :establecimiento, :cuit, :cupos, :cupos_dmc, :tipo)");   
        
        $stmt->bindParam(":partido", $datos["partido"], PDO::PARAM_STR);
        $stmt->bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
        $stmt->bindParam(":organo", $datos["organo"], PDO::PARAM_STR);
        $stmt->bindParam(":establecimiento", $datos["establecimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
        $stmt->bindParam(":cupos", $datos["cupos"], PDO::PARAM_STR);
        $stmt->bindParam(":cupos_dmc", $datos["cupos_dmc"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        
        
        if($stmt->execute()){
            
            return "ok";
            
        }else{
            return "error";
        }
        
        $stmt -> close();
        
        $stmt = null;
        
    }


         /*============================================
        MOSTRAR CLIENTES
        ============================================*/
        
        static public function mdlMostrarClientes($tabla,$item,$valor){
            
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
            EDITAR CLIENTE
            ============================================*/
            static public function mdlEditarCliente($tabla, $datos){
                
                ("INSERT INTO $tabla(partido, municipio, organo, establecimiento, cuit, cupos, cupos_dmc, tipo) VALUES ( :partido, :municipio, :organo, :establecimiento, :cuit, :cupos, :cupos_dmc, :tipo)");   
        
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET partido = :partido, municipio = :municipio, organo = :organo, establecimiento = :establecimiento, cuit = :cuit, cupos = :cupos, cupos_dmc = :cupos_dmc, tipo = :tipo WHERE id = :id");   
                
                $stmt->bindParam(":partido", $datos["partido"], PDO::PARAM_STR);
                $stmt->bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
                $stmt->bindParam(":organo", $datos["organo"], PDO::PARAM_STR);
                $stmt->bindParam(":establecimiento", $datos["establecimiento"], PDO::PARAM_STR);
                $stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
                $stmt->bindParam(":cupos", $datos["cupos"], PDO::PARAM_STR);
                $stmt->bindParam(":cupos_dmc", $datos["cupos_dmc"], PDO::PARAM_STR);
                $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
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
    ELIMINAR CLIENTE
    ============================================*/

    static public function mdlEliminarCliente($tabla,$datos){

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

