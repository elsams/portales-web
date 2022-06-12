
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</head>
<style>
#divBody .row {
    margin-top:3px;
    margin-bottom:3px;
}
</style>
<body>

    <div class=''>
        <div class='row'> 
            <div class='col col-6' id='menudiv'> 
                <div id='divMenu'>@include("layouts.Menu")</div>
            </div>
            <div class='col'> 
                <div id='divBody'>

                        <div class="login-form" style='margin:20px;'>
                             <div class='row'><h3>Registro de Usuario</h3> 
                        </div>
                        <div  class="form-group" >
                        <div class='row'>          
                            <input type='text' class="form-control" id='inpNames' placeholder='Nombres' />                    
                        </div>                        
                        <div class='row'>          
                            <input type='text' class="form-control" id='inpApellidoP' placeholder='Apellido Paterno' />                    
                        </div>
                        <div class='row'>          
                            <input type='text' class="form-control" id='inpApellidoM' placeholder='Apellido Materno' />                    
                        </div>
                        <div class='row'>
                             <input type='text' class="form-control" id='inpNickName' placeholder='Nick Usuario / Nickname' />            
                        </div>
                        <div class='row'>
                             <input type='text' class="form-control" id='inpRut' placeholder='Rut' />            
                        </div>
                        <div class='row'>
                        <input type='text' class="form-control" id='inpMail'  placeholder='Email' />
                            <div class="invalid-feedback">
                                Debe ingresa un correo valido.
                            </div>
                        </div>
                        <div class='row'>                             
                             <select class="form-select" id='selEmpresa' >
                                    <option value=0>Seleccione Empresa</option>
                                    @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id_empresa}}">{{$empresa->nombre_empresa}}</option>

                                    @endforeach
                             </select>
                        </div>
                        <div class='row'>                             
                             <select class="form-select" id='selRol' >
                                    <option value=0>Seleccione Perfil</option>
                                    @foreach($perfiles as $perfil)
                                    <option value="{{$perfil->id_perfil}}">{{$perfil->codigo_perfil}}</option>

                                    @endforeach
                             </select>
                        </div>
                        <div id='row'>
                            <div class="form-check">
                            <label class="form-check-label" for="inpHabilitado">
                                Vigencia
                                </label>
                                <input class="form-check-input" type="checkbox" checked value="" id="inpHabilitado">
                            
                            </div> 
                        </div>
                        <div class='row'>
                        <input type='password' class="form-control" id='inpPassw'   placeholder='Password' />          
                        </div>
                        </div>
                        <div class='col'>
                            <div class='row' ><input type='button' class='form-control' id='inpCrearUsuario' value='Crear' /> </div>
                            <div class='row' ><input type='button'  class='form-control' id='inpVolver'  onclick='location.href="{{ url('/login') }}"' value='Volver' /> </div>
                        </div>
                        </div>
                        <div  id='myModal' class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <h5 id='modalMsg'></h5>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                        </div>
                        </div>
                        </div>

                   

                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<script src="{{asset('../resources/js/jquery.rut.js')}}"></script>
<script src="{{asset('../resources/js/viewsJs/registry.js?v=2.1')}}" ></script>