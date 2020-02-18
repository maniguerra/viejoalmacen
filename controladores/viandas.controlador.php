<?php


class ControladorViandas{
    
    /*=========================================
    MOSTRAR VIANDAS
    =========================================*/
    
    static public function ctrMostrarViandas($item,$valor){
        $tabla = "viandas";
        $respuesta = ModeloViandas::mdlMostrarViandas($tabla,$item,$valor);
        return $respuesta;
    }

    /*=========================================
    MOSTRAR VIANDAS POR CLIENTE
    =========================================*/
    
    static public function ctrMostrarViandasCliente($item,$valor){
        $tabla = "viandas";
        $respuesta = ModeloViandas::mdlMostrarViandasCliente($tabla,$item,$valor);
        return $respuesta;
    }
    
    /*=========================================
    CREAR VIANDA
    =========================================*/
    
    static public function ctrCrearVianda(){
        
        // Si viene la variable POST nuevo menu, es porque se envio el formulario
        
        if(isset($_POST["nuevoMenu"])){
            
            //Verifico que nuevoMenu no tenga caracteres especiales ni esté vacio
            
            if(  preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoMenu"] && $_POST["nuevoMenu"] != "")) {
                
                
                // Guardo el valor del string con el total de ingrdentes del menu
                $arrayIngredientes = $_POST["ingredientesFinal"];
                
                //Lo paso a JSON para verificar
                $json=json_decode($arrayIngredientes);
                
                //Corroboro que ninguna cantidad sea igual a cero
                $hasZero=FALSE;
                foreach ($json as $item){
                    if($item->cantidad=="") {
                        $hasZero=TRUE;
                    break; #Salimos del bucle
                }
            }
            
            // Si no hay cantidad = a 0
            if($hasZero == FALSE){
                
                // Y se cargo al menos un ingrediente (58 es la cantidad de caracteres que tiene el string si no le pongo ningun dato)
                if( isset($_POST["ingredientesFinal"])) {
                    
                    // Y se seleccionó un cliente
                    if($_POST["seleccionarCliente"] != 0){
                        $tabla = "viandas";
                        $datos = array(
                            "nombre" => $_POST["nuevoMenu"],
                            "id_cliente" => $_POST["seleccionarCliente"],
                            "productos" => $_POST["ingredientesFinal"],
                            "costo" => $_POST["nuevoPrecioMenu"],
                            "dmc" => $_POST["valorDmc"]
                        );
                        
                        $respuesta = ModeloViandas::mdlCrearVianda($tabla,$datos);
                        
                        if($respuesta == "ok"){
                            
                            // El menu se creó correctamente
                            
                            echo '<script>
                            swal.fire({
                                type: "success",
                                title: "El menu ha sido creado correctamente",
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
                        
                    }else{
                        //NO SE SELECCIONO UN CLIENTE
                        echo '<script>
                        swal.fire({
                            type: "error",
                            title: "Debe seleccionar un cliente",
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
                    
                    
                } else {
                    // EL MENU NO PUEDE ESTAR VACIO
                    echo '<script>
                    swal.fire({
                        type: "error",
                        title: "El menu debe contener al menos un ingrediente",
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
                
            } else{
                // AL MENOS UN INGREDIENTE TIENE CANTIDAD = 0
                echo '<script>
                swal.fire({
                    type: "error",
                    title: "La cantidad de los ingredientes no puede ser igual a 0",
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
            
        }else{
            //EL NOMBRE DE MENU NO PUEDE LLEVAR CARACTERES ESPECIALES
            echo '<script>
            swal.fire({
                type: "error",
                title: "El nombre del menu no puede estar vacio o tener caracteres especiales",
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

    /*=========================================
    EDITAR VIANDA
    =========================================*/
    
    static public function ctrEditarVianda(){
        
        // Si viene la variable POST nuevo menu, es porque se envio el formulario
        
        if(isset($_POST["editarMenu"])){

                      
            //Verifico que nuevoMenu no tenga caracteres especiales ni esté vacio
            
            if(  preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarMenu"] && $_POST["editarMenu"] != "")) {
                
                
                // Guardo el valor del string con el total de ingrdentes del menu
                $arrayIngredientes = $_POST["ingredientesFinal"];
                
                //Lo paso a JSON para verificar
                $json=json_decode($arrayIngredientes);
                
                //Corroboro que ninguna cantidad sea igual a cero
                $hasZero=FALSE;
                foreach ($json as $item){
                    if($item->cantidad=="") {
                        $hasZero=TRUE;
                    break; #Salimos del bucle
                }
            }
            
            // Si no hay cantidad = a 0
            if($hasZero == FALSE){
                
                // Y se cargo al menos un ingrediente (58 es la cantidad de caracteres que tiene el string si no le pongo ningun dato)
                if( strlen($arrayIngredientes) > 58) {
                    
                    // Y se seleccionó un cliente
                    if($_POST["seleccionarCliente"] != 0){
                        $tabla = "viandas";
                        
                        $datos = array(
                            "id" => $_GET["idMenu"],
                            "nombre" => $_POST["editarMenu"],
                            "id_cliente" => $_POST["seleccionarCliente"],
                            "productos" => $_POST["ingredientesFinal"],
                            "costo" => $_POST["nuevoPrecioMenu"],
                            "dmc" => $_POST["valorDmc"]
                        );
                        
                        $respuesta = ModeloViandas::mdlEditarVianda($tabla,$datos);
                        
                        if($respuesta == "ok"){
                            
                            // El menu se editó correctamente
                            
                            echo '<script>
                            swal.fire({
                                type: "success",
                                title: "El menu ha sido editado correctamente",
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
                        
                    }else{
                        //NO SE SELECCIONO UN CLIENTE
                        echo '<script>
                        swal.fire({
                            type: "error",
                            title: "Debe seleccionar un cliente",
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
                    
                    
                } else {
                    // EL MENU NO PUEDE ESTAR VACIO
                    echo '<script>
                    swal.fire({
                        type: "error",
                        title: "El menu debe contener al menos un ingrediente",
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
                
            } else{
                // AL MENOS UN INGREDIENTE TIENE CANTIDAD = 0
                echo '<script>
                swal.fire({
                    type: "error",
                    title: "La cantidad de los ingredientes no puede ser igual a 0",
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
            
        }else{
            //EL NOMBRE DE MENU NO PUEDE LLEVAR CARACTERES ESPECIALES
            echo '<script>
            swal.fire({
                type: "error",
                title: "El nombre del menu no puede estar vacio o tener caracteres especiales",
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

  /*=========================================
    ELIMINAR VIANDA
    =========================================*/

    static public function ctrEliminarVianda(){

        if(isset($_GET["idMenu"])){

            $tabla = "viandas";
            $datos = $_GET["idMenu"];
           

            $respuesta = ModeloViandas::mdlEliminarVianda($tabla, $datos);

            echo '<script>console.log("datos enviados al modelo")</script>';
            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "El menú ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "viandas";
                        
                    }   
                    
                });
                </script>';
            }   

        }
    }

}


?>