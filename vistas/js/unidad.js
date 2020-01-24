/*=========================================
EDITAR UNIDAD DE MEDIDA
========================================= */

$(".btnEditarUnidad").click(function(){
    
    var idUnidad = $(this).attr("idUnidad");
    
    var datos = new FormData();
    
    datos.append("idUnidad", idUnidad);
    
    
    $.ajax({
        url: "ajax/unidades.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            
            
            $("#editarUnidad").val(respuesta["nombre"]);
            $("#editarNomen").val(respuesta["nomenclatura"]);
            
            $("#idUnidad").val(respuesta["id"]);
            
            
            
            
        }
    })
    
    
    
})

/*=========================================
ELIMINAR UNIDAD DE MEDIDA
========================================= */

$(".btnEliminarUnidad").click(function(){

    var idUnidad = $(this).attr("idUnidad");

    swal.fire({
        title: 'Está seguro que desea borrar la unidad de medida?',
        text: 'Si no lo está puede cancelar la operación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar unidad'
    }).then((result)=>{
        if(result.value){
            window.location = 'index.php?ruta=unidades&idUnidad='+idUnidad;
        }
    }
    
    )

})