var id_proveedor = 0;
var numItem= 0;
function limpiar(){
     id_proveedor = 0;
     numItem= 0;
     files=null;
     $("#tblItemGuia tbody").html("");
     $("#divAgregar").show();
     $("#selProveedor").val(0);
     $("#selProveedor").prop("disabled",false);
};
$("#inpRow").val("0");
limpiar();
$("#tblItemGuia").on("click",".btnBuscarItem",function(){
    id_proveedor  = $("#selProveedor").val();
    $("#inpRow").val($(this).attr("data-num"));
    
    getBuscaItems(id_empresa);
    $("#modalBusqueda").modal("show");

});

$("#tblItemGuia").on("click",".btnCrearItem",function(){
 
    $("#inpRow").val($(this).attr("data-num"));
    
    getTraeFormItems(id_empresa);
    $("#modalBusqueda").modal("show");

});
var files=null;
$("#inpFile1").on("change",function(event){
    var btn_id=$(this).attr("id");
    console.log("archivo agregado");
   // var idCard= btn_id.replace("btnfnd_","");
    //var url_card=  $("#inpt_"+idCard).val();
    files= event.target.files;
});


function GuardarGuia(){
    let tipo_doc = $("#selTipodoc").val();
let idProveedor = $("#selProveedor").val();
let inpFechaRecep =$("#inpFechaRecep").val();
let inpNumDocto= $("#inpNumDocto").val();
let inpNumOrden = $("#inpNumOrden").val();
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
console.log(inpfile);
    $(".itemRow").each(function(){
        let row = $(this).attr("data-num");
        let NumInventario = $("#inpInv_"+row).val();
        let lote= $("#inpLote_"+row).val();
        let NombreItem= $("#inpItem_"+row).val();
        let idItem= $("#inpItem_"+row).attr("data-id");
        let cantidad = $("#inpCant_"+row).val();
        let precio = $("#inpCant_"+row).val();
        let cod_pal = $("#inpPal_"+row).val();
        let patente = $("#inpPatente_"+row).val();
        let UnidadMedida = $("#selUnidadMedida_"+row).val();
        let min_unidad_medida = $("#inpMin_"+row).val();
        let data_item_oc = $("#inpItem_"+row).attr("data_item_oc");
 
        
      
        let item;

        if(NumInventario==""){sw=1;msg="Debe ingresar código de Inventario";}
        // if(lote==""){sw=1;msg="Debe ingresar Lote";}
        if(NombreItem == ""){sw=1;msg="Debe Seleccionar Item";}
        if(cantidad == "" ||  cantidad<=0){sw=1;msg="Debe ingresar Cantidad Recepcionada";}
        if(precio == "" || precio <=0){sw=1;msg="Debe ingresar Precio de Documento Recepcionado";}

        item = {
            cod_inventario: NumInventario,
            id_proveedor :  idProveedor,
            id_item: idItem,        
            valor_ingreso: precio,
            cantidad : cantidad,
            cod_pal: cod_pal,
            id_unidad_medida: UnidadMedida,
            min_unidad_medida: min_unidad_medida,
            patente:patente,
            data_item_oc: data_item_oc
        }

        detalle[detalle.length] = item;
    });

    //FIN DETALLE
    guia ={numero_guia:inpNumDocto,
         orden_compra: inpNumOrden ,
         fecha_ingreso: inpFechaRecep,
         id_proveedor: idProveedor,
         id_tipo_doc: tipo_doc,
         id_obra: id_obra
        };
       
    if(idProveedor == ""  || idProveedor == "0"){sw=1;msg="Debe Ingresar Proveedor";}
    if(inpFechaRecep == "" ){sw=1;msg="Debe Ingresar Fecha Recepción";}
    if(inpNumDocto == "") {sw=1;msg="Debe Ingresar Número de Documento";}
    var form = new FormData(); 
    form.append('guia',JSON.stringify(guia));
    form.append('detalle',JSON.stringify(detalle));
    form.append('imagen', inpfile);
    form.append('_token', $("meta[name='csrf-token']").attr("content"));


    if(sw==0){
        let urlPst =urlGuardaGuia; 
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
                $("#loadGuardarGuia").show();                
            },
            success: function(data){
                var response =JSON.parse(data);
                var resp = response.response;
                var mensaje = response.mensaje;
                if(resp =="true"){
                    let msg1 = "Datos Guardados Correctamente";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(mensaje);
                    $("#msgModal").modal("show");
                    limpiar();
                }else if(resp =="actualizada"){
                    let msg1 = "Datos de Empresa Actualizado";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(msg1);
                    $("#msgModal").modal("show");
                }  else{
                   // let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(mensaje);
                    $("#msgModal").modal("show");
                }
                $("#loadGuardarGuia").hide();     
            },error:function(){
                let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                $("#msgModalTitle").text("Mensaje");
                $("#msgModalMsg").text(msg1);
                $("#msgModal").modal("show");
                $("#loadGuardarGuia").hide();  
            }
        });
    }else{
     
        $("#msgModalTitle").text("Mensaje");
        $("#msgModalMsg").text(msg);
        $("#msgModal").modal("show");
    }
}
$("#btnGuardarGuia").on("click",function(){
    if(files == null)
    {
        $("#modalAlertSinDoc").modal("show");
    }else{
        GuardarGuia();  
    }
});


$("#btnAgregar").on("click",function(){
    console.log("btnAgregar");
    let cnt= $(".itemRow").length+1;
    
    //let urlPst = "../../recepcion/trDetalleGuia/"+cnt;
    let urlPst=  urlTrDetalle+"/"+cnt;
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
           $("#tblItemGuia tbody").append(data);
        }
    });

});

$("#btnOrden").on("click",function(){
    let urlPst=  urlCreaOrden+"/"+id_obra+"/0";
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
           //$("#tblItemGuia tbody").append(data);
           $("#modalFormBody").html(data);
           $("#modalForm").modal('show');

        }
    });

    
}); 

$("#btnBuscaOrden").on("click",function(){
    getOrdenes();
});

$("#tblItemGuia").on("change",".prcUnit",function(){
    console.log("calculando");
    let row = $(this).attr("row");
    let precio =$("#inpPrecio_"+row).val();
    let cantidad = $("#inpCant_"+row).val();
    let total= 0;

    if(precio>0 && cantidad>0){total = (precio*cantidad);}
    $("#inpTotal_"+row).val(total);
});
$("#tblItemGuia").on("change",".cntRecep",function(){
    console.log("calculando");
    let row = $(this).attr("row");
    let precio =$("#inpPrecio_"+row).val();
    let cantidad = $("#inpCant_"+row).val();
    let total= 0;

    if(precio>0 && cantidad>0){total = (precio*cantidad);}
    $("#inpTotal_"+row).val(total);
});


$("#btnLimpiar").on("click",function(){
    limpiar();
});

$("#btnModalGuardar").on("click",function()
{
    GuardarGuia();
});