<?php

class ControladorIngredientes{


    /*==============================================
    MOSTRAR INGREDIENTES
    ==============================================*/

    static public function ctrMostrarIngredientes($item, $valor){

        $tabla = "ingredientes";

        $respuesta = ModeloIngredientes::mdlMostrarIngredientes($tabla,$item,$valor);

        return $respuesta;

    }

   

    /*==============================================
    CARGAR INGREDIENTE
    ==============================================*/

    static public function  ctrCargarIngrediente(){

        if(isset($_POST["nuevoIngrediente"])){

            if( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoIngrediente"]) && preg_match('/^[0-9.]+$/', $_POST["nuevoPrecio"])){

                $tabla = "ingredientes";
                
                $datos = array(
                    "nombre" => $_POST["nuevoIngrediente"],
                    "id_unidad" => $_POST["nuevaUnidad"],
                    "precio" => $_POST["nuevoPrecio"]
                    
                );
                
                $respuesta = ModeloIngredientes::mdlCrearIngredientes($tabla,$datos);
                
                
                if($respuesta == "ok"){
                    
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "El ingrediente ha sido creado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            var url = window.location
                            var parts = url.toString().split("/");
                            var lastSegment = parts.pop() || parts.pop();
                            window.location = lastSegment;
                            
                            
                            
                        }   
                        
                    });
                    </script>';
                    
                }


            } 
            
            
            
            
                    else {
                        echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        var url = window.location
                        var parts = url.toString().split("/");
                        var lastSegment = parts.pop() || parts.pop();
                        window.location = lastSegment;
                        
                    }   
                    
                });
                </script>';
                    
                    
                    
                    
                    }





        }
    }


    /*==============================================
    EDITAR INGREDIENTE
    ==============================================*/

    static public function  ctrEditarIngrediente(){

        if(isset($_POST["editarIngrediente"])){
            echo '<script>console.log("hola");</script>';
            

            if( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarIngrediente"]) && preg_match('/^[0-9.]+$/', $_POST["editarPrecio"])){
                
                $tabla = "ingredientes";
              
                
                $datos = array(
                    "nombre" => $_POST["editarIngrediente"],
                    "id_unidad" => $_POST["editarUnidad"],
                    "precio" => $_POST["editarPrecio"],
                    "id" => $_POST["idIngrediente"]
                );
                
               
                $respuesta = ModeloIngredientes::mdlEditarIngrediente($tabla,$datos);
                
                
                if($respuesta == "ok"){
                   
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "El ingrediente ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            var url = window.location
                            var parts = url.toString().split("/");
                            var lastSegment = parts.pop() || parts.pop();
                            window.location = lastSegment;
                            
                        }   
                        
                    });
                    </script>';

                    
                    
                    
                }


            } 
            
            
            
            
                    else {
                        echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        var url = window.location
                        var parts = url.toString().split("/");
                        var lastSegment = parts.pop() || parts.pop();
                        window.location = lastSegment;
                        
                    }   
                    
                });
                </script>';
                    
                    
                    
                    
                    }





        }
    }

     /*===================================================
    ELIMINAR INGREDIENTE
    ===================================================*/

    static public function ctrEliminarIngrediente(){

        if(isset($_GET["idIngrediente"])){
            
            $tabla = "ingredientes";
            $datos = $_GET["idIngrediente"];

            $respuesta = ModeloIngredientes::mdlEliminarIngrediente($tabla,$datos);

            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "El ingrediente ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "ingredientes"
                   
                        
                    }   
                    
                });
                </script>';
            }   

        }

       
    }

  
}