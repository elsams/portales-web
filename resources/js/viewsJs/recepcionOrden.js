$("#btnAgregar").on("click",function(){
    console.log("btnAgregar");
    let cnt= $(".itemRow").length+1;
    
    //let urlPst = "../../recepcion/trDetalleGuia/"+cnt;
    let urlPst=  urlTrDetalleOrden+"/"+cnt;
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
           $("#tblItemOrden tbody").append(data);
        }
    });

});



$(".divBody").on("keyup",".tiempo",function(){
let idx = $(this).attr("id");
let id = idx.replace("inpCantOc_","");
 let cant = $("#inpTiempo_"+id).val();
 let precio = $("#inpPrecioOc_"+id).val();
 let TotalItem = 0;
 console.log("cant: "+cant+ " ,precio: "+precio);
 if(cant>0 && precio >0 )
 {
    TotalItem = cant * precio;
 } 
 console.log("TotalItem: "+TotalItem);

 $("#inpTotal_"+id).val(TotalItem);

});

$(".divBody").on("keyup",".inpPrecio",function(){
    let idx = $(this).attr("id");
    let id = idx.replace("inpPrecioOc_","");
    let cant = $("#inpTiempo_"+id).val();
    let precio = $("#inpPrecioOc_"+id).val();
    console.log("cant: "+cant+ " ,precio: "+precio);
    let TotalItem = 0;
    if(cant>0 && precio >0 )
    {
       TotalItem = cant * precio;
    } 
    console.log("TotalItem: "+TotalItem);
   
    $("#inpTotal_"+id).val(TotalItem);
   
   });

   var id_proveedor = 0;
var numItem= 0;
$("#inpRow").val("0");

$("#tblItemOrden").on("click",".btnBuscarItem",function(){
    id_proveedor  = $("#selProveedor").val();
    $("#inpRow").val($(this).attr("data-num"));
    
    getBuscaItems(id_empresa);
    $("#modalBusqueda").modal("show");

});

$("#tblItemOrden").on("click",".btnCrearItem",function(){
 
    $("#inpRow").val($(this).attr("data-num"));
    
    getTraeFormItems(id_empresa);
    $("#modalBusqueda").modal("show");

});

var files=null;
$("#inpFile").on("change",function(event){
    var btn_id=$(this).attr("id");
    console.log("archivo agregado");
   // var idCard= btn_id.replace("btnfnd_","");
    //var url_card=  $("#inpt_"+idCard).val();
    files= event.target.files;
});

function GuardarOrden(){
    let tipo_doc = 4;// 4 Orden de compra
    let idProveedor = $("#selProveedor").val();
    var FechaEmision =$("#inpFechaEmision").val();
    var FechaRecepcion =$("#inpFechaRecepcion").val();
    let inpNumOrden= $("#inpNumDocto").val();
    let msg ="";
    let detalle  = [];
    let guia;
    let sw = 0;
    let inpfile ;

    if(files == null)
    {
        inpfile= "";
    }else{
        inpfile =files[0];
    }
        $(".itemRow").each(function(){
            console.log("item");
            let row = $(this).attr("data-num");
            //let NumInventario = $("#inpInv_"+row).val();
            let NombreItem= $("#inpItem_"+row).val();
            let idItem= $("#inpItem_"+row).attr("data-id");
            let cantidad = $("#inpCantOc_"+row).val();
            let precio = $("#inpPrecioOc_"+row).val();
            let UnidadMedida = $("#selUnidadMedida_"+row).val();
            let tiempo = $("#inpTiempo_"+row).val();
            let total_item =$("#inpTotal_"+row).val(); 
            let total_unitario =$("#inpPrecioOc_"+row).val(); 
            let min_unidad_medida = $("#inpMin_"+row).val(); 
            
            let item;
    
           // if(NumInventario==""){sw=1;msg="Debe Ingresar Código de Inventario";}
            if(UnidadMedida==""){sw=1;msg="Debe Ingresar Unidad de Medida";}
            if(NombreItem == ""){sw=1;msg="Debe Seleccionar Ítem";}
            if(cantidad == "" ||  cantidad<=0){sw=1;msg="Debe Ingresar Cantidad Solicitada";}
            if(precio == "" || precio <=0){sw=1;msg="Debe Ingresar Precio De Documento Solicitada";}
            if(tiempo == "" || tiempo <=0){sw=1;msg="Debe Ingresar Tiempo Solicitado";}
            
            item = {
               // cod_inventario: NumInventario,
                id_proveedor :  idProveedor,
                id_item: idItem,        
                precio: precio,
                cantidad : cantidad,
                tiempo: tiempo,
                id_unidad_medida: UnidadMedida,
                total_item: total_item,
                total_unitario: total_unitario,
                min_unidad_medida: min_unidad_medida
            }
    
            detalle[detalle.length] = item;
        });
    
        //FIN DETALLE
        orden ={
             orden_compra: inpNumOrden ,
             FechaEmision: FechaEmision,
             FechaRecepcion: FechaRecepcion,
             id_proveedor: idProveedor,
             id_tipo_doc: tipo_doc,
             id_obra: id_obra
            };
    
        if(idProveedor == ""  || idProveedor == "0"){sw=1;msg="Debe Ingresar Proveedor";}
        if(FechaRecepcion == "" ){sw=1;msg="Debe Ingresar Fecha Recepción";}
        if(inpNumDocto == "") {sw=1;msg="Debe Ingresar Número de Documento";}

        var form = new FormData(); 
        form.append('orden',JSON.stringify(orden));
        form.append('detalle',JSON.stringify(detalle));
        form.append('imagen', inpfile);
        form.append('_token', $("meta[name='csrf-token']").attr("content"));

        if(sw==0){
            let urlPst =urlGuardaOrden; 
            $.ajax(urlPst,{
                cache:false,
                global: false,
                type: "POST",
                dataType: "html",
                processData: false,
                contentType: false,
                data: form,
                async:false,
                beforeSend: function(){
                    $("#loadGuardarOrden").show();
                },
                success: function(data){
                    if(data =="true"){
                        let msg1 = "Datos Guardados Correctamente";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(msg1);
                        $("#msgModal").modal("show");
                        limpiar();
                    }else if(data =="actualizada"){
                        let msg1 = "Datos de Empresa Actualizado";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(msg1);
                        $("#msgModal").modal("show");
                    }  else{
                        let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(msg1);
                        $("#msgModal").modal("show");
                    }
                    $("#loadGuardarOrden").hide();
                },error:function(){
                    let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(msg1);
                    $("#msgModal").modal("show");
                    $("#loadGuardarOrden").hide();
                }
            });
        }else{
         
            $("#msgModalTitle").text("Mensaje");
            $("#msgModalMsg").text(msg);
            $("#msgModal").modal("show");
        }
}

$("#btnGuardarOrden").on("click",function(){
    if(files == null)
    {
        $("#modalAlertSinDoc").modal("show");
    }else{
        GuardarOrden();  
    }
});

$("#btnModalGuardar").on("click",function()
{
    GuardarOrden();
});