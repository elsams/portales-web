id_proveedor = 0;
id_contacto = 0;

function getTablaContactosByProveedor(id_proveedor){
    var urlPst = "./contacto/getContactosXProveedor/"+id_proveedor; 
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
          $("#divTblContacto").html(data);
        },error:function(){
        
        }
    });
}

$("#divTblProveedor").on("click",".radioSelect",function(){
id_proveedor = $(this).attr("data-id");
getTablaContactosByProveedor(id_proveedor);
});

$("#divTblContacto").on("click",".selContacto",function(){
    id_contacto = $(this).attr("data-id");
});
    

$("#inpGuardar").on("click",function(){
let sw =0;
let msg="";
let id_empresa= $("#selEmpresa").val();


    if(id_contacto ==0){sw=1;msg="Debe Seleccionar Contacto"; }    
    if(id_proveedor==0){sw=1;msg="Debe Seleccionar Proveedor";}
    if(id_empresa =="" || id_empresa=="0"){sw=1;msg="Debe Seleccionar Empresa"; }

    if(sw==0){

        var urlPst = "./contacto/guardarContactoCliente"; 
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {    
                "id_contacto":id_contacto,
                "id_empresa": id_empresa, 
                "id_proveedor": id_proveedor, 
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
              let msg1 = "Ha ocurrido un Error, contacte al administrador";
              $("#msgModalTitle").text("Mensaje");
               $("#msgModalMsg").text(msg1);
               $("#msgModal").modal("show");
            }
        });
    }
    else{
        $("#msgModalTitle").text("Mensaje");
        $("#msgModalMsg").text(msg);
        $("#msgModal").modal("show");
    }
});