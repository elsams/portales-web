var files=null;
$("#inpFile1").on("change",function(event){
    console.log("archivo agregado");
    files= event.target.files;
});


function GuardarReport(){
    let obra = id_obra;
    let id_item = id_item_guia;
    let NumReport = $("#inpNumReport").val();
    let FechaReport = $("#inpFechaReport").val();
    let Operador = $("#inpOperador").val();
    let diaMesSemana = $("#inpDia").val();
    let idProveedor =  $("#inpProveedor").val(); 
    let msg ="";
    let sw=0;
    let opt_minimo= $('.radioMin:checked').val();
    //horometro case 1
    let HorometroDesde = $("#inpHorometroDesde").val();
    let HorometroHasta = $("#inpHorometroHasta").val();
    let TotalHorometro = $("#inpTotalHorometro").val();
    let inpfile ;

    if(files == null)
    {
        inpfile= "";
    }else{
        inpfile =files[0];
    }
 
    if(typeof HorometroDesde=="undefined"){HorometroDesde=0;}
    if(typeof HorometroHasta=="undefined"){HorometroHasta=0;}
    if(typeof TotalHorometro=="undefined"){TotalHorometro=0;}
    
    if(typeof diaMesSemana=="undefined"){diaMesSemana=0;}

    let Vuelta  =$("#inpVuelta").val();
    if(typeof Vuelta=="undefined"){Vuelta=0;}

 //por Vuelta case 7
    let DesdeKm=$("#inpDesdeKm").val();
    let HastaKm=$("#inpHastaKm").val();
    let TotalKm=$("#inpTotalKm").val();
    let observaciones=$("#inpObs").val();
    let detalle_trabajo=$("#inpDetalle").val();

    if(typeof DesdeKm=="undefined"){DesdeKm=0;}
    if(typeof HastaKm=="undefined"){HastaKm=0;}
    if(typeof TotalKm=="undefined"){TotalKm=0;}
    if(typeof observaciones=="undefined"){observaciones=0;}
    if(typeof detalle_trabajo=="undefined"){detalle_trabajo=0;}


    if(NumReport =="" || NumReport=="0"){sw=1;msg="Debe Ingresar Número de Report";}
    switch (id_unidad_medida) {
        case 1:
            if(TotalHorometro==0){sw=1;msg="El Total no puede ser cero"}
        break;
        case 2:
        case 3:
            if(diaMesSemana==0){sw=1;msg="El Total no puede ser cero"}
        break;
        case 4:
            if(diaMesSemana==0){sw=1;msg="El Total no puede ser cero"}
        break;
        case 5:
            if(TotalHorometro==0){sw=1;msg="El Total no puede ser cero"}
        break;
        case 6:
            if(TotalHorometro==0){sw=1;msg="El Total no puede ser cero"}
        break;
        case 7:
            if(TotalHorometro==0){sw=1;msg="El Total no puede ser cero"}
        break;
    }
    //if(NumReport =="" || NumReport=="0"){sw=1;msg="Debe Ingresar Número de Report"}
    


    let formReport = new FormData();
    formReport.append("id_item",id_item);
    formReport.append("NumReport",NumReport);
    formReport.append("FechaReport",FechaReport);
    formReport.append("Operador",Operador);
    formReport.append("HorometroDesde",HorometroDesde);
    formReport.append("HorometroHasta",HorometroHasta);
    formReport.append("TotalHorometro",TotalHorometro);
    formReport.append("diaMesSemana",diaMesSemana);
    

    formReport.append("Vuelta",Vuelta);
    formReport.append("DesdeKm",DesdeKm);
    formReport.append("HastaKm",HastaKm);
    formReport.append("TotalKm",TotalKm);
    formReport.append("observaciones",observaciones);
    formReport.append("detalle_trabajo",detalle_trabajo);
    formReport.append("opt_minimo",opt_minimo);
    formReport.append("idProveedor",idProveedor);
    formReport.append("imagen", inpfile);
    
    formReport.append("_token",$("meta[name='csrf-token']").attr("content") );
   
    
    if(sw==0)
    {

        let urlPst =urlGuardarReport; 
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            processData: false,
            contentType: false,
            data: formReport,
            async:false,
            beforeSend: function(){
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
                } else{
                   // let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(mensaje);
                    $("#msgModal").modal("show");
                }
            },error:function(){
                let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                $("#msgModalTitle").text("Mensaje");
                $("#msgModalMsg").text(msg1);
                $("#msgModal").modal("show");
            }
        });
    }else{
     
        $("#msgModalTitle").text("Mensaje");
        $("#msgModalMsg").text(msg);
        $("#msgModal").modal("show");
    }
}

$("#btnModalGuardar").on("click",function()
{
    GuardarReport();    
});
$("#inpGuardarRepo").on("click",function(){
    if(files == null)
    {
        $("#modalAlertSinDoc").modal("show");
    }else{
        GuardarReport();  
    }
   
});

$("#inpVuelta").on("keyup",function(){
 let cant =  $(this).val();
 console.log(cant);
 if(parseFloat(cant) <0){ $(this).val(0);}
 if(parseFloat(cant) >1){$(this).val(0);}


});


$("#inpDia").on("change",function(){
    let cant =  $(this).val();
    console.log(cant);
    //if(isNaN(cant)){cant=0;}
    if(parseFloat(cant) <0){cant=0;}
    if(parseFloat(cant) >1){cant=0;}
    $(this).val(parseFloat(cant).toFixed(1));
    //$(this).val(cant);
   
   });

$("#inpDesdeKm").on("change",function(){
    let DesdeKm=$("#inpDesdeKm").val();
    let HastaKm=$("#inpHastaKm").val();
    let TotalKm=0;
   console.log("DesdeKm: "+DesdeKm+" , HastaKm: "+ HastaKm);
   if((parseInt(DesdeKm)>0 && parseInt(HastaKm) >0) && parseInt(DesdeKm)<parseInt(HastaKm)){
        TotalKm = HastaKm -DesdeKm;
        console.log(TotalKm);
    }
    $("#inpTotalKm").val(TotalKm);
});
$("#inpHastaKm").on("change",function(){
    let DesdeKm=$("#inpDesdeKm").val();
    let HastaKm=$("#inpHastaKm").val();
    let TotalKm=0;
    console.log("DesdeKm: "+DesdeKm+" , HastaKm: "+ HastaKm);
    if((parseInt(DesdeKm)>0 && parseInt(HastaKm) >0) && parseInt(DesdeKm)<parseInt(HastaKm)){
        TotalKm = HastaKm -DesdeKm;
        console.log(TotalKm);
    }else{
        ("#inpHastaKm").val(0);
    }
    $("#inpTotalKm").val(TotalKm);
});

$("#inpHorometroDesde").on("change",function(){
    let HorometroDesde = $("#inpHorometroDesde").val();
    let HorometroHasta = $("#inpHorometroHasta").val();
   
    let TotalH=0;
    console.log("inpHorometroDesde: "+HorometroDesde+" , inpHorometroHasta: "+ HorometroHasta);
    if((parseInt(HorometroDesde)>0 && parseInt(HorometroHasta) >0) && parseInt(HorometroDesde)<parseInt(HorometroHasta)){
        TotalH = HorometroHasta -HorometroDesde;
        console.log(TotalH);
    }
    $("#inpTotalHorometro").val(TotalH);
});

$("#inpHorometroHasta").on("change",function(){
    let HorometroDesde = $("#inpHorometroDesde").val();
    let HorometroHasta = $("#inpHorometroHasta").val();
   
    let TotalH=0;
    console.log("inpHorometroDesde: "+HorometroDesde+" , inpHorometroHasta: "+ HorometroHasta);
    if((parseInt(HorometroDesde)>0 && parseInt(HorometroHasta) >0) && parseInt(HorometroDesde)<parseInt(HorometroHasta)){
        TotalH = HorometroHasta -HorometroDesde;
        console.log(TotalH);
    }
    $("#inpTotalHorometro").val(TotalH);
});



