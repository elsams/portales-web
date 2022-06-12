var id_empresa = 0;
var id_centro =0;
function getCentrosByEmpresa(id_empresa){
    let urlPst= "./centroCosto/getCCostoByEmpresa/"+id_empresa;
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
           $("#tblCentros").html(data);
        },error:function(){
          
        }
    });
}


function limpiar(){
    $('#inpHabilitado').prop('checked',true);
    $('#inpPrincipal').prop('checked',true);
    $("#inpNombreCentro").val('');
    $("#inpLocalidad").val('');
    id_centro =0;
    getCentrosByEmpresa(id_empresa);

}

$("#divBody").on("change","#selEmpresa",function(){
    id_empresa = $("#selEmpresa").val();
    getCentrosByEmpresa(id_empresa);
});
if($("#selEmpresa").val()!=="" && $("#selEmpresa").val() !==0)
{
    id_empresa = $("#selEmpresa").val();
    getCentrosByEmpresa(id_empresa);
}

$("#btnGuardar").on("click",function(){
id_empresa =$("#selEmpresa").val();
let NombreCentro = $("#inpNombreCentro").val();
let Localidad =$("#inpLocalidad").val();
let sw = 0;
let msg= "";
let inpHabilitado = 0;
let inpPrincipal= 0;
console.log("Guardando...");


if(NombreCentro ==""){sw=1;msg="Debe ingresar Nombre Centro";}
if(Localidad ==""){sw=1;msg="Debe ingresar  Localidad";}

if ($('#inpHabilitado').is(':checked')) {inpHabilitado = 1;}
if ($('#inpPrincipal').is(':checked')) {inpPrincipal = 1;}
if(id_empresa == 0){sw=1;msg="Debe Seleccionar Empresa";}

if(sw==0){
    var urlPst =  "./centroCosto/GuardarCentro";

    $.ajax(urlPst,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {           
            "id_empresa":  id_empresa,
            "NombreCentro": NombreCentro,       
            "Localidad" : Localidad,
            "inpPrincipal": inpPrincipal,
            "inpHabilitado": inpHabilitado,
            "id_centro":  id_centro,
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

$(".divBody").on("click",".btnEdit",function(){
     id_centro= $(this).attr("data-id");
     $("#inpNombreCentro").val($(this).attr("data-nombreCentro"));
     $("#inpLocalidad").val($(this).attr("data-localidad"));
     let inpHabilitado  = $(this).attr("data-vigencia");
     let principal = $(this).attr("data-principal");

     if (inpHabilitado==1) {$('#inpHabilitado').prop('checked',true)}
     if (principal==1) {$('#inpPrincipal').prop('checked',true)}
     if (inpHabilitado==0) {$('#inpHabilitado').prop('checked',false)}
     if (principal==0) {$('#inpPrincipal').prop('checked',false)}
});