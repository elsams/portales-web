<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
<script src="{{asset(   '../resources/js/jquery.rut.js?v=1')}}"></script>
</head>
<body>

    <div class=''>
    <div class='row'>
            <div id='divMenu'>@include("layouts.Menu")</div>
        </div>
        <div class='row'> 
            <div class='col'> 
                    <div class='divBody'>
                        <div style='margin:20px;'>
                            <div class="row" style='margin:20px;'>
                                <h4>Registro de Persona / Contacto
                            </div>
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
                                <input type='text' class="form-control" id='inpRut' placeholder='Rut' />            
                            </div>
                            <div class='row'>
                                @include("Components.selectProvincia")
                            </div>
                            <div class='row'>
                                @include("Components.selectCargo")
                            </div>
                            <div class='row'>
                                @include("Components.selectProveedor")
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control phoneNumber" id='inpContact1' placeholder='Celular / Teléfono 1' />            
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control phoneNumber" id='inpContact2' placeholder='Celular / Teléfono 2' />            
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control phoneNumber" id='inpContact3' placeholder='Celular / Teléfono 3' />            
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control mail" id='inpEmail1' placeholder='E-mail 1' />            
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control mail" id='inpEmail2' placeholder='E-mail 2' />            
                            </div>
                            <div class='row'>
                                <input type='text' class="form-control" id='inpDireccion' placeholder='Dirección' />            
                            </div>
                            <div class="mb-3 row" style='margin-top:10px;'>
                                <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                                <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                                
                            </div>
                        </div>
                    </div>
                
                    </div>
           
          
           
        </div>
        <div class='row divBody' >
                Editar Contacto
                <div id='divTblPersona' class='table-responsive'>
                 @include("Components.tblContacto")
                </div>
        </div>
    </div>
    
</body>
</html>
<script src="../resources/js/viewsJs/mantContacto.js?v=1"> </script>

