id_herramienta = 0;
function limpiar(){
    id_herramienta = 0;
    $("#inpNomHerramienta").val(""); 
    $("#inpNomDescHerramienta").val("");
    $("#selMarca").val(0);
    $("#inpModelo").val("");
    $("#selTipoItem").val(0);
    $("#inpObs").val("");
   
    getHerramientas();
}
function getHerramientas(){
    let urlPst = "./item/getTblItem";
    $.ajax(urlPst,{
        cache:false,
        global: false,
        type: "GET",
        dataType: "html",
        data: {           
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           $("#divTblHerramienta").html(data);
        }
    });

}

function Eliminar(){
    let urlPst = "./item/eliminaItem";
    $.ajax(urlPst,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {    
            "id_herramienta": id_herramienta,       
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           $("#divTblHerramienta").html(data);
           limpiar();
        }
    });

}
$(document).ready(function(){

     $("#inpGuardar").on("click",function(){
        var sw = 0;
        var msg= "";
        var nombreHerramienta =  $("#inpNomHerramienta").val();;
        var detalle = $("#inpNomDescHerramienta").val();
        var marca =  $("#selMarca").val();
        var modelo = $("#inpModelo").val();
        var id_item =$("#selTipoItem").val();
        var observacion = $("#inpObs").val();
        
        if(sw==0){
           
            var urlPst = urlGuardar;
    
            $.ajax(urlPst,{
                cache:false,
                global: false,
                type: "POST",
                dataType: "html",
                data: {           
                    "id_herramienta": id_herramienta,
                    "nombre_herramienta":  nombreHerramienta,     
                    "detalle_herramienta": detalle,          
                    "id_marca": marca,
                    "modelo" : modelo,
                    "id_item": id_item,
                    "observacion": observacion,
                    "_token": $("meta[name='csrf-token']").attr("content")                
                },
                async:false,
                beforeSend: function(){
                },
                success: function(data){
                    let datas = JSON.parse(data);
                    if(datas.response=="true"){
                        let msg1 = "Datos Guardados Correctamente";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(msg1);
                        $("#msgModal").modal("show");
                        let numItem =$("#inpRow").val();
                        $("#inpItem_"+numItem).attr("data-id",datas.id);
                        $("#inpItem_"+numItem).val(datas.nombre_herramienta);

                        limpiar();
                    }else{
                        let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(msg1);
                        $("#msgModal").modal("show");
                    }
                   
                ///$("#modalBody").html(data);
                }
            });
        }else{
            $("#msgModalTitle").text("Advertencia");
            $("#msgModalMsg").text(msg);
            $("#msgModal").modal("show");
            
        }
     });


    


    $("#divTblHerramienta").on("click",".btnEdit",function(){
        id_herramienta = $(this).attr("data-id");
        $("#inpNomHerramienta").val( $(this).attr("data-nombre_herramienta"));
        $("#inpNomDescHerramienta").val( $(this).attr("data-detalle_herramienta"));
        $("#inpModelo").val( $(this).attr("data-modelo"));
        $("#selMarca").val( $(this).attr("data-id_marca"));
        $("#selTipoItem").val( $(this).attr("data-id_item"));
        $("#inpObs").val( $(this).attr("data-observacion"));
        
    });

    $("#divTblHerramienta").on("click",".btnEliminar",function(){
        id_herramienta = $(this).attr("data-id");
        let msg = "¿Esta seguro de Eliminar este Item?";
        $("#advModalTitle").text("Advertencia");
        $("#advModalMsg").text(msg);
        $("#advModal").modal("show");
    });

    $("#advModalClose").on("click",function(){
        console.log("click eliminar");
        Eliminar();
    });
    
  $("#inpLimpiar").on("click",function(){
    limpiar();
});

  });
