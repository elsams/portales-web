var id_empresa =0;

function limpiar(){
    $("#selEmpresa").val("0");
    id_empresa =0;
    getTipoItems();
}

function getTipoItems(){
    var urlPst =  "./tipoItem/getTipoItem/"+id_empresa;
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
           $("#tblTipoItem").html(data);
        },error:function(){
          
        }
    });
}
$("#selEmpresa").on("change",function(){
     id_empresa= $("#selEmpresa").val();
    getTipoItems();
});

$("#btnGuardar").on("click",function(){
    var TiposItem = new Array();
    var sw=0;
    var msg="";
     id_empresa= $("#selEmpresa").val();

    $(".check").each(function(){
        if ($(this).is(':checked')) {
            TiposItem[TiposItem.length]=$(this).attr("data-id");
        }       
    });

    if(TiposItem.length==0){sw=1;msg="Debe Seleccionar Tipo de Item"; }
    if(id_empresa =="" || id_empresa=="0"){sw=1;msg="Debe Seleccionar Empresa"; }

    if(sw==0){
        var urlPst = "./tipoItem/guardarPermisosItems"; 
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {    
                "id_empresa":id_empresa,
                "ArrItems": TiposItem,
                "_token": $("meta[name='csrf-token']").attr("content")                
            },
            async:false,
            beforeSend: function(){
            },
            success: function(data){
            id_perfil=0; 
            let msg1 = "Guardado exitosamente";
            $("#msgModalTitle").text("Mensaje");
                $("#msgModalMsg").text(msg1);
                $("#msgModal").modal("show");
                limpiar();
            },error:function(){
            
            }
        });
    }
    else{
        $("#msgModalTitle").text("Mensaje");
        $("#msgModalMsg").text(msg);
        $("#msgModal").modal("show");
    }
 
});