var id_marca= 0;
function limpiar(){
    id_marca  =0;
    $("#inpNomMarca").val("");
    getMarcas();
    
}

function getMarcas(){
    let urlPst = "./marca/getTblMarcas";
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
           $("#divTblMarca").html(data);
        }
    });

}

function Eliminar(){
    let urlPst = "./marca/eliminarMarca";
    $.ajax(urlPst,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {           
            "id_marca": id_marca,
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           $("#divTblMarca").html(data);
           limpiar();
        }
    });
}

$("#inpGuardar").on("click",function(){
    let sw= 0;
    let msg ="";  
    let inpNomMarca = $("#inpNomMarca").val();

    if(inpNomMarca == ""){sw=1;ms="Debe ingresar Nombre de Marca";}
    if(sw==0){
        var urlPst =  "./marca/GuardarMarca";

        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {           
                "nombre_marca":  inpNomMarca,               
                "id_marca": id_marca,
                "_token": $("meta[name='csrf-token']").attr("content")                
            },
            async:false,
            beforeSend: function(){
            },
            success: function(data){
                if(data =="true"){
                    let msg1 = "Datos Guardados Correctamente";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(msg1);
                    $("#msgModal").modal("show");
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

$("#divTblMarca").on("click",".btnEdit",function(){
    id_marca= $(this).attr("data-id");
    $("#inpNomMarca").val($(this).attr("data-nombre_marca"));
});

$("#inpLimpiar").on("click",function(){
    limpiar();
});
$("#divTblMarca").on("click",".btnEliminar",function(){
    id_marca = $(this).attr("data-id");
    let msg = "¿Esta seguro de Eliminar este Item?";
    $("#advModalTitle").text("Advertencia");
    $("#advModalMsg").text(msg);
    $("#advModal").modal("show");
});


    $("#advModalClose").on("click",function(){
        console.log("click eliminar");
        Eliminar();
    });
