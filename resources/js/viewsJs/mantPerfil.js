var id_perfil =0;
function ActualizaTablaPerfiles(){
    var urlPst =  "./perfil/tablaPerfiles";
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
           $("#divTblPerfiles").html(data);
        },error:function(){
          
        }
    });
}
function ActualizaMenuBase(){
    var urlPst =  "./perfil/tablaMenufilesBase";
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
           $("#divTblMenuPerfil").html(data);
        },error:function(){
          
        }
    });    
}


function limpiar(){
    $("#inpnNomPerfil").val("");
    $("#inpDescPerfil").val("");
    id_perfil = 0;

    ActualizaTablaPerfiles();
    ActualizaMenuBase()
}


$("#inpGuardar").on("click",function(){
 var inpnNomPerfil = $("#inpnNomPerfil").val();
 var inpDescPerfil = $("#inpDescPerfil").val();
 var sw=0;
 var msg="";
 var ArrMenus = new Array();
    $(".checks").each(function(){
        if ($(this).is(':checked')) {
        ArrMenus[ArrMenus.length]=$(this).attr("data-id");
        }       
    });

    if(inpnNomPerfil==""){sw=1;msg="Debe Ingresar Nombre de Perfil";}
    if(inpDescPerfil==""){sw=1;msg="Debe Ingresar Descripción de Perfil";}
    if(ArrMenus.length ==0){sw=1;msg="Debe Seleccionar Items de Menu Para el Perfil";}
    console.log(ArrMenus);

    if(sw==0){
        var urlPst = "./perfil/guardarPerfil"; 
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "GET",
            dataType: "html",
            data: {    
                "id_perfil":id_perfil,
                "ArrMenus": ArrMenus,
                "NomPerfil" : inpnNomPerfil,
                "DescPerfil" :inpDescPerfil,
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

$("#divTblPerfiles").on("click",".btnEdit",function(){
    id_perfil= $(this).attr("data-id");
    var urlPst= "./perfil/tablaMenufiles/"+id_perfil;

    $("#inpnNomPerfil").val($(this).attr("data-codigo"));
    $("#inpDescPerfil").val($(this).attr("data-desc"));

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
        $("#divTblMenuPerfil").html(data);
        },error:function(){
        
        }
    });

});