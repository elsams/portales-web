



$("#divTablaInv").on("click",".btnReport",function(){
    let id_itemdet = $(this).attr("data-id_item_guia");
    console.log("id_itemdet: " + id_itemdet);

     var urlReport =urlReportForm +"/"+id_itemdet;
     $.ajax(urlReport,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {     
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           $("#bodyBusqueda").html(data);
           $("#modalBusqueda").modal("show");
           $("#titleBusqItem").text("Control Report");
        },error:function(){
          
        }
    });
});
$("#divTablaInv").on("click",".btnIngresos",function(){
    let id_itemdet = $(this).attr("data-id_item_guia");
    console.log("id_itemdet: " + id_itemdet);

     var urlReport =urlReportHist +"/"+id_itemdet;
     $.ajax(urlReport,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {     
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           // $("#advModalTitle").html("Listado de Ingresos de Report");
           $("#bodyBusqueda").html(data);
           $("#modalBusqueda").modal("show");
           $("#titleBusqItem").text("Historial Report");
         
        },error:function(){
          
        }
    });
});
