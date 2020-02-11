<?php

class ControladorUsuarios{
    
    /*===================================================
    INGRESO USUARIO
    ===================================================*/
    
    static public function ctrIngresoUsuario(){
        if(isset($_POST["ingUsuario"])){
            
            
            if( preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["ingUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
                
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];
                
                $encriptar = crypt($_POST["ingPassword"],'$2a$07$usesomesillystringforsalt$');
                
                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
                
                if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] ==  $encriptar){
                    
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["perfil"] = $respuesta["perfil"];
                    
                    echo '<script>
                    
                    window.location = "remitos";
                    
                    </script>';
                    
                } else {
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
                
                
                
            }
            
        }
    }
    
    
    
    
    
    
    
    /*===================================================
    REGISTRO NUEVO USUARIO
    ===================================================*/
    
    static public function ctrCrearUsuario(){
        
        if(isset($_POST["nuevoUsuario"])){
            
            
            if( preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
                
                if($_POST["nuevoPassword"] == $_POST["nuevoPassword2"]){
                    
                    
                    $tabla = "usuarios";
                    
                    $encriptar = crypt($_POST["nuevoPassword"],'$2a$07$usesomesillystringforsalt$');
                    
                    $datos = array(         "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["nuevoPerfil"]
                );
                
                $respuesta = ModeloUsuarios::mdlCrearUsuarios($tabla, $datos);
                if($respuesta == "ok"){
                    
                    echo '<script>
                    swal.fire({
                        type: "success",
                        title: "El usuario ha sido creado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            window.location = "usuarios";
                            
                        }   
                        
                    });
                    </script>';
                    
                }
                
            }else{
                
                echo '<script>
                swal.fire({
                    type: "error",
                    title: "Las contraseñas no coinciden",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "usuarios";
                        
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
                    window.location = "usuarios";
                    
                }   
                
            });
            </script>';
            
            
            
        } 
    }
    
    
    
    
    
    
}

/*===================================================
MOSTRAR TODOS LOS USUARIOS
===================================================*/

static public function ctrMostrarUsuarios($item, $valor){
    
    $tabla = "usuarios";
    
    $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
    
    return $respuesta;
    
}


/*===================================================
EDITAR USUARIO
===================================================*/
static public function ctrEditarUsuario(){           
    
    //CUANDO HAGA CLICK EN GUARDAR DE EDITAR USUARIO 

    if(isset($_POST["editarUsuario"])){
        
        $tabla = "usuarios";
        
        // SI VIENE UNA NUEVA CONTRASEÑA
        if($_POST["editarPassword"] != ""){
            

            // SI LOS CARACTERES DE LA CONTRASEÑA SON VALIDOS
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
                

                //SI AMBAS CONTRASEÑAS COINCIDEN
                if($_POST["editarPassword"] == $_POST["editarPassword2"]){
                    
                    // ENCRIPTO CONTRASEÑA
                    $encriptar = crypt($_POST["editarPassword"],'$2a$07$usesomesillystringforsalt$');
                    
                    
                    // GUARDO DATOS DE USUARIO EN ARRAY
                    $datos = array(
                        
                        "usuario" => $_POST["editarUsuario"],
                        "password" => $encriptar,
                        "perfil" => $_POST["editarPerfil"]
                        
                    );
                    
                    // LLAMO AL MODELO PARA UPDATEAR DB
                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                    

                    // MUESTRO RESPUESTA
                    if($respuesta == "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "El usuario ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                                
                            }   
                            
                        });
                        </script>';
                    }   
                    
                }else{
                    
                    // SI LAS CONTRASEÑAS NO COINCIDEN
                    echo    '<script>
                    swal.fire({
                        type: "error",
                        title: "Las contraseñas deben coincidir",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        
                    }).then(function(result){
                        if(result.value){
                            window.location = "usuarios";
                            
                        }   
                        
                    });
                    </script>';
                    
                }
                
                
                
                
            }else{
                
                //SI LA CONTRASEÑA TIENE CARACTERES ESPECIALES
                
                echo    '<script>
                swal.fire({
                    type: "error",
                    title: "La contraseña no puede tener caracteres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "usuarios";
                        
                    }   
                    
                });
                </script>';
                
            }
            
            
            
            
        } else {
            // SI EL PASSWORD VINO VACIO, DEJO EL ANTERIOR
            
            $encriptar = $_POST["passwordActual"];
            
            // GUARDO DATOS EN UN ARRAY
            $datos = array(
                
                "usuario" => $_POST["editarUsuario"],
                "password" => $encriptar,
                "perfil" => $_POST["editarPerfil"]
                
            );

            // LLAMO AL MODELO PARA UPDATEAR DB
            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
            

            // MUESTRO RESPUESTA
            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "El usuario ha sido editado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "usuarios";
                        
                    }   
                    
                });
                </script>';
            }   
            
        }
        
        
        
        
        
        
        
        
        
        
        
    }
    
    
}

  /*===================================================
    ELIMINAR USUARIO
    ===================================================*/

    static public function ctrEliminarUsuario(){

        if(isset($_GET["idUsuario"])){
            
            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla,$datos);

            if($respuesta == "ok"){
                echo '<script>
                swal.fire({
                    type: "success",
                    title: "El usuario ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    
                }).then(function(result){
                    if(result.value){
                        window.location = "usuarios";
                        
                    }   
                    
                });
                </script>';
            }   

        }

       
    }

}