var rutValido=1;

var id_provedor=0;

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

function getProveedores(){
    let urlPst = "./proveedor/getProveedores";
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
           $("#divTblHerramienta").html(data);
        }
    });

}

function limpiar(){
    $("#inpRazonSocial").val("");
    $("#inpNomFantasia").val("");
    $("#inpGiroPrin").val("");
    $("#inpRut").val("");
    $("#inpGiroSec").val("");
    $("#inpDireccion").val("");
    $("#selProvincia").val(0);
    $("#inpFonoMatriz").val("");
   $("#inpFonoBodega").val("");
   $("#inpFonoVentas").val("");
   $("#inpEmail").val("");
    id_provedor = 0;
    getProveedores();
}

$("#btnGuardar").on("click",function(){
    var razonSocial = $("#inpRazonSocial").val();
    var nombreFantasia = $("#inpNomFantasia").val();
    var GiroPrin = $("#inpGiroPrin").val();
    var rut = $("#inpRut").val();
    var GiroSec =$("#inpGiroSec").val();
    var Direccion = $("#inpDireccion").val();
    var id_comuna = $("#selComuna").val();
    var inpFonoMatriz = $("#inpFonoMatriz").val();
    var inpFonoBodega = $("#inpFonoBodega").val();
    var inpFonoVentas = $("#inpFonoVentas").val();
    var inpEmail = $("#inpEmail").val();


    var sw=0;
    var msg="";
    var urlPst= "./proveedor/guardarProveedor";

    if(razonSocial==""){sw=1;msg="Ingrese Razón Social";}
    if(nombreFantasia==""){sw=1;msg="Ingrese Nombre Fanasia";}
    if(GiroPrin==""){sw=1;msg="Ingrese Princiapl";}
    if(rut==""){sw=1;msg="Ingrese Rut";}
    if(Direccion==""){sw=1;msg="Ingrese Dirección";}
    if(id_comuna=="0"){sw=1;msg="Ingrese Comuna";}
    if(rutValido==1){sw=1;msg="Debe ingresar Rut correcto";}
    if(inpEmail=="" && validaMail(inpEmail)){sw=1;msg="Debe ingresar Un Correo Electrónico Válido";}
    if(inpFonoMatriz==""){sw=1;msg="Debe ingresar Un Contacto Principal";}

    if (sw==0){
        rut = rut.replaceAll(".","");
        rut = rut.replace("-","");
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {           
                "id_proveedor": id_proveedor,
                "razonSocial":  razonSocial,
                "nombreFantasia": nombreFantasia,       
                "rut" : rut,
                "giroprin" :GiroPrin ,
                "girosec": GiroSec,
                "Direccion" :Direccion ,
                "id_comuna" : id_comuna,
                "FonoMatriz" : inpFonoMatriz,
                "FonoBodega" : inpFonoBodega,
                "FonoVentas" : inpFonoVentas,
                "Email" : inpEmail,
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

$("#tblProveedor").on("click",".btnEdit",function(){
   $("#inpRazonSocial").val($(this).attr("data-razon_social"));
   $("#inpNomFantasia").val($(this).attr("data-nombre_fantasia"));
   $("#inpGiroPrin").val($(this).attr("data-giro_principal"));
   $("#inpRut").val($(this).attr("data-rut"));
   $("#inpGiroSec").val($(this).attr("data-giro_secundario"));
   $("#inpDireccion").val($(this).attr("data-direccion"));
   $("#selComuna").val($(this).attr("data-comuna_id"));
   $("#inpFonoMatriz").val($(this).attr("data-fono_matriz"));
   $("#inpFonoBodega").val($(this).attr("data-fono_bodega"));
   $("#inpFonoVentas").val($(this).attr("data-fono_venta"));
   $("#inpEmail").val($(this).attr("data-correo"));
   $("#inpRut").trigger("change");
   $("#inpRut").trigger("blur");
   id_proveedor = $(this).attr("data-id");
     
});