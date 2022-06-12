var rutValido=0;
$(document).ready(function(){

   // var urlpx = "{{url('/public/user/registrar/')}}";
    //console.log(urlpx);
    $("#inpRut").rut({validateOn: 'keyup change'})
    .on('rutInvalido', function(){ 
      $(this).addClass("is-invalid");
      $(this).removeClass("is-valid");
      rutValido=1;
    })
    .on('rutValido', function(){ 
        $(this).addClass("is-valid");
        $(this).removeClass("is-invalid");
        rutValido=0;
    });
    
    $("#inpCrearUsuario").on("click",function(){
        var inpNames =$("#inpNames").val();
        var inpNickName =$("#inpNickName").val();
        var inpMail =$("#inpMail").val();
        var inpPassw =$("#inpPassw").val();
        var inpRut = $("#inpRut").val();
        var selEmpresa = $("#selEmpresa").val();
        var selPerfil = $("#selRol").val();
        var inpApellidoM =$("#inpApellidoM").val();
        var inpApellidoP =$("#inpApellidoP").val();
        var msg ="";
        var sw =0;


        if(inpPassw =="" ){sw=1;msg="Debe ingresar un Correo Valido"}
        if(inpMail =="" && validaMail(inpMail)==true){sw=1;msg="Debe ingresar un Correo Valido"}
        if(inpNickName==""){sw=1;msg="Debe ingresar un Nombre de Usuario"}
        if(inpNames ==""){sw=1;msg="Debe ingresar Su nombre"}
        if(inpRut==""){sw=1;msg="Debe ingresar Rut";}
        if(rutValido==1){sw=1;msg="Debe ingresar Rut correcto";}
        if(selEmpresa==0){sw=1;msg="Debe seleccionar Empresa";}
        if(inpApellidoM==""){sw=1;msg="Debe ingresar Apellido Materno";}
        if(inpApellidoP==""){sw=1;msg="Debe seleccionar Apellido Paterno";}
        let inpHabilitado =0;
        if ($('#inpHabilitado').is(':checked')) {inpHabilitado = 1;}
       
       

        if(sw==0)
        {
            inpRut = inpRut.replaceAll(".","");
            inpRut = inpRut.replace("-","");
            var urlPst = bpath+"user/registrar/"+inpNames+"/"+inpNickName+"/"+inpMail+"/";
            urlPst = urlPst+inpPassw+"/"+inpRut+"/"+selEmpresa+"/"+selPerfil+"/"+inpApellidoM+"/"+inpApellidoP;
            urlPst = urlPst+"/"+inpHabilitado;
            $.ajax(urlPst,{
                cache:false,
                global: false,
                type: "GET",
                dataType: "json",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                async:false,
                beforeSend: function(){
                },
                success: function(data){                
                    $("#msgModalTitle").text("Mensaje");
                    $("#msgModalMsg").text(data.mensaje);
                    $("#msgModal").modal("show");     
                }
            });
        }else{          
            $("#msgModalTitle").text("Mensaje");
            $("#msgModalMsg").text(msg);
            $("#msgModal").modal("show");  
        }
    });

    $("#inpMail").on("keyup",function(){
        var value = $(this).val();
        if(validaMail(value)==true)
        {
            $(this).addClass('is-valid');
            $(this).removeClass('is-invalid');
        }else{
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        }

    });
    function validaMail(value){
        var nameregex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var resp = nameregex.test( value );
        return resp;
    }


});