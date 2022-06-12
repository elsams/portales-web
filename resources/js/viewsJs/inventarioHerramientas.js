

$("#btnPrintLista").on("click",function(){
    var urlReport =urlImprimir +"/"+id_centro;
    window.open(urlReport);
   /* $.ajax(urlReport,{
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
          // $("#advModalTitle").html("Listado de Ingresos de Report");
          $("#bodyBusqueda").html(data);
          $("#modalBusqueda").modal("show");
          $("#titleBusqItem").text("Historial Report");
        
       },error:function(){
         
       }
   });*/
});