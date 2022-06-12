var idMenu =0;
$(document).ready(function(){


    function ActualizaMenuTable(){
        var urlPst =  "./menu/getMenuTable";
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
               $("#menuTable").html(data);
            }
        });
    }
    function ActualizaMenuSelect(){
        var urlPst =  "./menu/getMenuSelect";
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
               $("#SelMenu").html(data);
            }
        });
    }
    function limpiar(){
        $("#inpNomMenu").val("");
        $("#inpUrl").val("");
        $("#SelMenu").val(0);
        ActualizaMenuTable();
        ActualizaMenuSelect();
    }
    ActualizaMenuTable();
    ActualizaMenuSelect();

    $("#inpGuardar").on("click",function(){
        let inpNomMenu =$("#inpNomMenu").val();
        let inpUrl =$("#inpUrl").val();
        
        let SelMenu =$("#SelMenu select").val();
        console.log($("#SelMenu select").val());
        console.log(SelMenu);
        let inpHabilitado =0;
        let sw= 0;
        let msg ="";       

        if(inpUrl==""){sw=1;msg="Debe ingresar Nombre de Menu";}
        if(inpNomMenu==""){sw=1;msg="Debe ingresar Nombre de Menu";}
        if ($('#inpHabilitado').is(':checked')) {inpHabilitado = 1;}

        if(sw==0){
            var urlPst =  "./menu/GuardarMenu";

            $.ajax(urlPst,{
                cache:false,
                global: false,
                type: "POST",
                dataType: "html",
                data: {           
                    "nombre":  inpNomMenu,
                    "url": inpUrl,       
                    "idpadre" : SelMenu,
                    "habilitado" :inpHabilitado ,
                    "idMenu": idMenu,
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


    $("#divMenuForm").on("click",".btnEdit",function(){
    //$(".btnEdit").on("click",function(){
        idMenu =  $(this).attr("data-id");
       let habilitado = $(this).attr("data-vigencia");
      //  alert(typeof $(this).attr("data-idparent"));
       if( $(this).attr("data-idparent")==""){
         $("#SelMenu select").val(0);
       }else{
        $("#SelMenu select").val($(this).attr("data-idparent"));
       }
       $("#inpNomMenu").val($(this).attr("data-cod_menu"));
       $("#inpUrl").val($(this).attr("data-url"));
      
       if(habilitado==1){$('#inpHabilitado').prop('checked', true);}else{$('#inpHabilitado').prop('checked', false);}
       
    });

    $("#divMenuForm").on("click","#inpLimpiar",function(){
        limpiar();
    });
});