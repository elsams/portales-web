function traeGuias(){
    $.ajax(urlTraeGuia,{
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
           $("#divTblGuias").html(data);
        },error:function(){
          
        }
    });
}
traeGuias();

$("#tblGuias").on("click",".btnPdf",function(){
    let id_guia= $(this).attr("data-id_guia");
    let urlPst = urlTraeGuiaPdf + "/"+id_guia;
    
        var iframe = $('<embed src="'+urlPst+'" width="100%" height="100%">');
        
       /// iframe.append(data);
       $("#modalFormTitle").text("Documento");
       $("#modalFormBody").html(iframe);
       $("#modalForm").modal("show");
    /*
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
            var iframe = $('<embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://example.com/the.pdf" width="500" height="375">');
            
            iframe.append(data);
           $("#modalFormBody").html(iframe);
           $("#modalForm").modal("show");
        },error:function(){
          
        }
    });
    */
});