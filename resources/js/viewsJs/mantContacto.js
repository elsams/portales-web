var rutValido=1;
var id_contacto =0;
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

function getTablaContactos(){
    var urlPst = "./contacto/getContactos"; 
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
          $("#divTblPersona").html(data);
        },error:function(){
        
        }
    });
}

function limpiar(){
    getTablaContactos();
    $("#inpNames").val("");
    $("#inpApellidoP").val("");
    $("#inpApellidoM").val("");
    $("#inpRut").val("");
    $("#selProvincia").val(0);
    $("#selCargo").val(0);
    $("#selProveedor").val(0);
 
    $("#inpContact1").val("");
    $("#inpContact2").val("");
    $("#inpContact3").val("");
    $("#inpEmail1").val("");
    $("#inpEmail2").val("");
    $("#inpDireccion").val("");
    $("#inpRut").trigger("change");
    id_contacto =0;
    
}

$("#inpGuardar").on("click",function(){
   let sw =0;
   let msg ="";
   let inpNames = $("#inpNames").val();
   let inpApellidoP = $("#inpApellidoP").val();
   let inpApellidoM = $("#inpApellidoM").val();
   let inpRut = $("#inpRut").val();
   let selProvincia= $("#selProvincia").val();
   let selectCargo = $("#selCargo").val();
   let selectProveedor =$("#selProveedor").val();

   let inpContact1 = $("#inpContact1").val();
   let inpContact2 = $("#inpContact2").val();
   let inpContact3 = $("#inpContact3").val();
   let inpEmail1  =  $("#inpEmail1").val();
   let inpEmail2  =  $("#inpEmail2").val();
   let inpDireccion = $("#inpDireccion").val();

   if(inpRut==""){sw=1;msg="Debe ingresar Rut";}
   if(rutValido==1){sw=1;msg="Debe ingresar Rut correcto";}
   if(inpApellidoP==""){sw=1;msg="Debe ingresar Apellido Paterno";}
   if(inpApellidoM==""){sw=1;msg="Debe ingresar Apellido Materno";}
   if(selProvincia=="0"){sw=1;msg="Debe seleccionar Provincia";}
   if(selectCargo=="0"){sw=1;msg="Debe seleccionar Cargo";}
   if(selectProveedor=="0"){sw=1;msg="Debe seleccionar Proveedor";}
   if(inpContact1==""){sw=1;msg="Debe ingresar Contacto 1";}

   if(inpEmail1==""){sw=1;msg="Debe ingresar E-Mail 1";}
   if(!validaMail(inpEmail1)){sw=1;msg="Debe ingresar E-Mail 1 Válido";}
   if(inpDireccion==""){sw=1;msg="Debe ingresar Dirección";}
   if(inpNames==""){sw=1;msg="Debe ingresar Nombres";}

   if(inpEmail2!==""){
    if(!validaMail(inpEmail2)){sw=1;msg="Debe ingresar E-Mail 2 Válido";}
   }

   
  if(sw==0){

    var urlPst = "./perfil/guardarContacto"; 
    $.ajax(urlPst,{
        cache:false,
        global: false,
        type: "POST",
        dataType: "html",
        data: {    
            "id_contacto":id_contacto,
            "inpNames": inpNames,
            "inpApellidoP" : inpApellidoP,
            "inpApellidoM" :inpApellidoM,
            "inpRut" :inpRut,
            "selProvincia" :selProvincia,
            "selectCargo" :selectCargo,
            "selectProveedor" :selectProveedor,
            "inpContact1" :inpContact1,
            "inpContact2" :inpContact2,
            "inpContact3" :inpContact3,
            "inpEmail1" :inpEmail1,
            "inpEmail2" :inpEmail2,
            "inpDireccion" :inpDireccion,
            "_token": $("meta[name='csrf-token']").attr("content")                
        },
        async:false,
        beforeSend: function(){
        },
        success: function(data){
           id_perfil=0; 
           let msg1 = "Guardado exitosamente";
           $("#msgModalTitle").text("Mensaje");
            $("#msgModalMsg").text(msg1);
            $("#msgModal").modal("show");
            limpiar();
        },error:function(){
          let msg1 = "Ha ocurrido un Error, contacte al administrador";
          $("#msgModalTitle").text("Mensaje");
           $("#msgModalMsg").text(msg1);
           $("#msgModal").modal("show");
        }
    });
}
else{
    $("#msgModalTitle").text("Mensaje");
    $("#msgModalMsg").text(msg);
    $("#msgModal").modal("show");
}
});

$("#divTblPersona").on("click",".btnEdit",function(){

    $("#inpNames").val($(this).attr("data-nombres"));
    $("#inpApellidoP").val($(this).attr("data-apellido_paterno"));
    $("#inpApellidoM").val($(this).attr("data-apellido_materno"));
    $("#inpRut").val($(this).attr("data-rut_contacto"));
    $("#inpRut").trigger("change");
    $("#selProvincia").val($(this).attr("data-provincia_id"));
    $("#selCargo").val($(this).attr("data-id_cargo"));
    $("#selProveedor").val($(this).attr("data-id_proveedor"));
 
    $("#inpContact1").val($(this).attr("data-contacto1"));
    $("#inpContact2").val($(this).attr("data-contacto2"));
    $("#inpContact3").val($(this).attr("data-contacto2"));
    $("#inpEmail1").val($(this).attr("data-email1"));
    $("#inpEmail2").val($(this).attr("data-email2"));
    $("#inpDireccion").val($(this).attr("data-direccion"));
    id_contacto = $(this).attr("data-id");

});
$("#inpLimpiar").on("click",function(){
    limpiar();
})