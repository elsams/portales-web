var rutValido=1;
$("#inpRut").rut({validateOn: 'keyup change'})
.on('rutInvalido', function(){ 
  //$(this).parents(".control-group").addClass("error")
  //alert("rut invalido");
  $(this).addClass("is-invalid");
  $(this).removeClass("is-valid");
  rutValido=1;
})
.on('rutValido', function(){ 
    $(this).addClass("is-valid");
    $(this).removeClass("is-invalid");
    //alert("rut valid");
    rutValido=0;
});
function updateTablaEmpresas(){
    var urlPst =  "../empresa/tablaEmpresas";
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
           $("#tblEmpresas").html(data);
        },error:function(){
          
        }
    });
}


$("#btnGuardar").on("click",function(){
    var urlPst =  "../empresa/GuardarEmpresa";
    var inpEmpresa =$("#inpEmpresa").val();
    var inpRazon = $("#inpRazon").val();
    var inpRut = $("#inpRut").val();
    //var selUsuario = $("#selUsuario").val();
    var sw =0;
    var msg="";
    let inpHabilitado =0;
    let inpMail = $("#inpMail").val();
    let NombreCentro  = $("#inpNombreCentro").val();
    let Localidad = $("#inpLocalidad").val();

    if(NombreCentro==""){sw=1;msg="Debe Ingresar Nombre de Centro";}
    if(Localidad==""){sw=1;msg="Debe Ingresar Localidad de Centro";}
    if(inpEmpresa==""){sw=1;msg="Debe Ingresar Empresa";}
    if(inpRazon==""){sw=1;msg="Debe Ingresar Razón Social";}
    if(inpRut==""){sw=1;msg="Debe Ingresar Rut";}
    if(rutValido==1){sw=1;msg="Debe Ingresar Rut Correcto";}
    if(inpMail==""){sw=1;msg="Debe Ingresar Correo Electrónico";}
    if(!validaMail(inpMail)){sw=1;msg="Debe Ingresar Correo Electrónico Válido";}
    if ($('#inpHabilitado').is(':checked')) {inpHabilitado = 1;}


    if (sw==0){
        inpRut = inpRut.replaceAll(".","");
        inpRut = inpRut.replace("-","");
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {           
                "inpEmpresa":  inpEmpresa,
                "inpRazon": inpRazon,       
                "inpRut" : inpRut,
                "habilitado" :inpHabilitado ,
                "mail": inpMail,
                "NombreCentro": NombreCentro,
                "Localidad": Localidad,
               // "userAdmin": selUsuario,
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
                   // limpiar();
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
            },error:function(){
                let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                $("#msgModalTitle").text("Mensaje");
                $("#msgModalMsg").text(msg1);
                $("#msgModal").modal("show");
            }
        });

    }else{
        $("#msgModalMsg").text(msg);
        $("#msgModal").modal("show");
    }
});

$("#dvsubEmpresa").on("click",".btnEdit",function(){
    var id=$(this).attr("data-id");
    var nombre=$(this).attr("data-nombre");
    var razon=$(this).attr("data-razon");
    var rut = $(this).attr("data-rut");
    var vigencia =$(this).attr("data-vigencia"); 

    $("#inpEmpresa").val(nombre);
    $("#inpRazon").val(razon);
    $("#inpRut").val(rut);
    $("#inpRut").trigger("change");
    $("#selUsuario").val($(this).attr("data-id_usuario"));
    if (vigencia==1) {$('#inpHabilitado').prop("checked", true); }else{$('#inpHabilitado').prop("checked", false);  }
    
});

$(".divBody").on("change","#selUsuario",function(){
    if($(this).val()!=="0"){
        $('#inpSolUsu').prop('checked',false);
       $('#solUsu').hide();
    }else{
        $('#solUsu').show();
    }
   
});