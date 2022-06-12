
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="es">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{URL::asset('../resources/js/popper.min.js')}}" ></script> 
<script src="{{URL::asset('../resources/js/jquery-3.5.1.min.js')}}"></script> 
<link rel="stylesheet" href="{{URL::asset('../resources/css/main.css?v=4.3').rand()}}" >
<link rel="stylesheet" href="{{URL::asset('../resources/js/bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
<script src="{{URL::asset('../resources/js/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')}}" ></script>	
<script src="{{URL::asset('../resources/js/viewsJs/demostry.js?v=1')}}"></script>
<script src="{{URL::asset('../resources/js/formatvalids.js?v=1.2').rand()}}"></script>
</head>
<body>
@if($status == 0)
<div class='container'>
    <div class='row' style='text-align:center;border-top:20px;'>
        <h4>Bienvenido a {{env("APP_NAME")}}</h4>
        <n>Debe Actualizar las claves y correos de acceso de usuarios</n>
    </div>

    <table class='table' style='margin:30px;'>
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Correo Electrónico</th>
        <th>Contraseña Nueva</th>
        <th>Repetir Contraseña</th>
    </tr>
    </thead>
        <tbody>
            @php
                $cnt=0;
            @endphp
            @foreach($usuarios as $user)
            <tr class='tdUsuario' row='{{$cnt}}' nombre='{{$user->username}}' idUsuario='{{$user->id}}' >
                <td>{{$user->username}}</td>  
                <td><input type='input' class='form-control mail' value="" id='mail_{{$cnt}}'/></td>  
                <td> <input type='password' class='form-control' value= "" id='pass1_{{$cnt}}'/></td>  
                <td><input type='password' class='form-control' value= "" id='pass2_{{$cnt}}'/></td>  
            </tr> 
                @php
                $cnt=$cnt+1;
            @endphp
            @endforeach
        </tbody>
    </table>
    <div class='row'>
            <input type='button' class='btn btn-primary' id='btnGuardarUsers' value="Guardar Cambios" />
    </div>

</div>
@else
<div class='container'>
    <div class='row' stle='text-align:center;'>
        <h4>Este Link ya no está disponible</h4>
    </div>
</div>
@endif
<div class="modal" tabindex="-1" id='msgModal' >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='msgModalTitle'>Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <p id='msgModalMsg'>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id='msgModalClose'>OK</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
    $("#btnGuardarUsers").on("click",function(){
        let usuarios = new Array();
        let sw = 0;
        let msg= "";
        $(".tdUsuario").each(function(){
                var row= $(this).attr("row");
                console.log("row:"+row);
                var usuario = $(this).attr("nombre");
                var idUsuario = $(this).attr("idUsuario");
                var pass1 = $("#pass1_"+row).val();
                var pass2 = $("#pass2_"+row).val();
                var mail = $("#mail_"+row).val();
                if(pass1!==pass2){sw=1;msg="La primera y segunda contraseña deben coincidir para "+usuario+"";}
                if(pass1=="" || pass2==""){sw=1;msg="Debe ingresa la clave nueva para usuario: "+usuario+"";}
                var user = {email: mail,pass1:pass1,pass2:pass2,id: idUsuario } ;
                usuarios[usuarios.length]=user;
                console.log(sw);
        });

        if(sw==0){

            var vartoken = "{{$token}}";
            var urlPst ="{{URL::asset('/user/welcomeformConfirm/')}}"; 
            $.ajax(urlPst,{
                cache:false,
                global: false,
                type: "POST",
                dataType: "html",
                data: {
                    "usuarios":usuarios,
                    "tokencambio": vartoken,
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
                        //limpiar();
                    }else{
                        let msg1 = "Ocurrio un problema ,notificar al Administrador del sistema";
                        $("#msgModalTitle").text("Mensaje");
                        $("#msgModalMsg").text(data);
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
            $("#msgModalTitle").text("Advertencia");
            $("#msgModalMsg").text(msg);
            $("#msgModal").modal("show");
        }
      


    });
  

</script>