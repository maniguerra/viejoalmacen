<?php

    class ControladorClientes{



                /*===================================================
                CREAR CLIENTE
                ===================================================*/
        static public function ctrCrearCliente(){


            if(isset($_POST["nuevoPartido"])){


                
                if(  preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoPartido"]) &&
                     preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoMunicipio"]) &&
                    
                     preg_match('/^[0-9]+$/', $_POST["nuevoCupo"]) && preg_match('/^[0-9]+$/', $_POST["nuevoCupoDMC"]) ){

                        
                        $tabla = "clientes";
                        $datos = array(
                            "partido" => $_POST["nuevoPartido"],
                            "municipio" => $_POST["nuevoMunicipio"],
                            "organo" => $_POST["nuevoOrgano"],
                            "establecimiento" => $_POST["nuevoEstablecimiento"],
                            "cuit" => $_POST["nuevoCuit"],
                            "cupos" => $_POST["nuevoCupo"],
                            "cupos_dmc" => $_POST["nuevoCupoDMC"],
                            "tipo" => $_POST["nuevoTipo"]
                            
                            
                        );

                        $respuesta = ModeloClientes::mdlCrearCliente($tabla,$datos);

                        if($respuesta == "ok"){

                            // El cliente se creó correctamente
                             
                            echo '<script>
                            swal.fire({
                                type: "success",
                                title: "El cliente ha sido creado correctamente",
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
                         // Los datos no son correctos

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
        MOSTRAR TODOS LOS CLIENTES
        ===================================================*/

                  static public function ctrMostrarClientes($item, $valor){
                
                $tabla = "clientes";
                
                $respuesta = ModeloClientes::MdlMostrarClientes($tabla, $item, $valor);
                
                return $respuesta;
    
                }





                    /*===================================================
                    EDITAR CLIENTE
                    ===================================================*/
                    
                    static public function ctrEditarCliente(){
                        
                        
                        if(isset($_POST["editarPartido"])){


                
                            if(  preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarPartido"]) &&
                                 preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarMunicipio"]) &&
                                  preg_match('/^[0-9]+$/', $_POST["editarCupo"]) && preg_match('/^[0-9]+$/', $_POST["editarCupoDMC"])){
            
                                    if($_POST["editarCuit"] != ""){
                                        if(preg_match('/^[0-9]+$/', $_POST["editarCuit"])){

                                            $tabla = "clientes";
                                            $datos = array(
                                                "partido" => $_POST["editarPartido"],
                                                "municipio" => $_POST["editarMunicipio"],
                                                "organo" => $_POST["editarOrgano"],
                                                "establecimiento" => $_POST["editarEstablecimiento"],
                                                "cuit" => $_POST["editarCuit"],
                                                "cupos" => $_POST["editarCupo"],
                                                "cupos_dmc" => $_POST["editarCupoDMC"],
                                                "tipo" => $_POST["editarTipo"],
                                                "id" => $_POST["idCliente"]
                                                
                                                
                                            );
                    
                                            $respuesta = ModeloClientes::mdlEditarCliente($tabla,$datos);
                    
                                            if($respuesta == "ok"){
                    
                                                // El cliente se editó correctamente
                                                
                                                echo '<script>
                                                swal.fire({
                                                    type: "success",
                                                    title: "El cliente ha sido editado correctamente",
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
                                            // eL CUIT SOOLO DEBE TENR NUMEROS
                   
                                               echo '<script>
                                               swal.fire({
                                                   type: "error",
                                                   title: "El CUIT sólo debe contener números",
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
            
                                    
                                
            
                                 }else{
                                     // Los datos no son correctos
            
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
    ELIMINAR CLIENTE
    ===================================================*/

    static public function ctrEliminarCliente(){

        if(isset($_GET["idCliente"])){
            
            $tabla = "clientes";
            $datos = $_GET["idCliente"];

            
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla,$datos);

            
            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "El cliente ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "clientes"
                            
                        
                    }   
                    
                });
                </script>';
            }   

        }

       
    }
}