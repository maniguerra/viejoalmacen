<?php


// Creo la clase que va a manejar el CRUD de unidades

class ControladorUnidades{
    
    
    /*===================================================
    CREAR NUEVA UNIDAD
    ===================================================*/
    static public function ctrCrearUnidad(){
        
        
        // Si viene la variable nuevaUnidad es porque se lleno y envio su formulario
        if(isset($_POST["nuevaUnidad"])){
            
            
            
            // Controlamos que el nombre esté bien escrito
            if( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevaUnidad"])){
                
                $tabla = "unidades";
                
                $datos = array(
                    "nombre" => $_POST["nuevaUnidad"],
                    "nomenclatura" => $_POST["nuevaNomen"]
                );
                
                $respuesta = ModeloUnidades::mdlCrearUnidad($tabla,$datos);
                
                
                if($respuesta == "ok"){
                    
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "La unidad de medida ha sido creada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            window.location = "unidades";
                            
                        }   
                        
                    });
                    </script>';
                    
                }
                
                
            }else {
                echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "unidades";
                        
                    }   
                    
                });
                </script>';
                
                
                
            } 
            
        }
        
    }
    
    /*===================================================
    MOSTRAR TODAS LAS UNIDADES
    ===================================================*/
    
    static public function ctrMostrarUnidades($item, $valor){
        
        $tabla = "unidades";
        
        $respuesta = ModeloUnidades::MdlMostrarUnidades($tabla, $item, $valor);
        
        return $respuesta;
        
    }
    
    /*===================================================
    EDITAR UNIDAD
    ===================================================*/
    
    static public function ctrEditarUnidad(){
        
        
        if(isset($_POST["editarUnidad"])){
            
            if( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarUnidad"])){
                
                
                $tabla = "unidades";
                
                $datos = array(
                    "nombre" => $_POST["editarUnidad"],
                    "nomenclatura" => $_POST["editarNomen"],
                    "id" => $_POST["idUnidad"]
                    
                );
                
                $respuesta = ModeloUnidades::mdlEditarUnidad($tabla,$datos);
                
                
                if($respuesta == "ok"){
                    
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "La unidad de medida ha sido editada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            window.location = "unidades";
                            
                        }   
                        
                    });
                    </script>';
                    
                }
                
            }else{
                echo '<script>
                swal.fire({
                    type: "error",
                    title: "Los datos no pueden estar vacíos o contener carateres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "unidades";
                        
                    }   
                    
                });
                </script>';
            }
            
        }
        
        
    }


    /*===================================================
    ELIMINAR UNIDAD
    ===================================================*/

    static public function ctrEliminarUnidad(){

        if(isset($_GET["idUnidad"])){
            
            $tabla = "unidades";
            $datos = $_GET["idUnidad"];

            $respuesta = ModeloUnidades::mdlEliminarUnidad($tabla,$datos);

            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "La unidad de medida ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "unidades";
                        
                    }   
                    
                });
                </script>';
            }   

        }

       
    }
    
}