function traeOrdenes(){
    $.ajax(urlTraeOrdenes,{
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
           $("#divTblOrdenes").html(data);
        },error:function(){
          
        }
    });
}
traeOrdenes();

$("#tblOrdenes").on("click",".btnPdf",function(){
    let id_orden= $(this).attr("data-id_orden");
    let urlPst = urlTraeOrdenPdf + "/"+id_orden;
    
        var iframe = $('<embed src="'+urlPst+'" width="100%" height="100%">');
        
       /// iframe.append(data);
       $("#modalFormTitle").text("Documento");
       $("#modalFormBody").html(iframe);
       $("#modalForm").modal("show");
    
});