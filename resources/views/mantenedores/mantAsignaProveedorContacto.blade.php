<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
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
                            <div class="mb-3 row">        
                                <h3>Mantenedor Asiganción de Contacto por Proveedores </h3>  
                            </div>
                        <div class="mb-3 row">
                            
                            @if(isset($empresa))
                                <label for="inpCliente" class="col-sm-2 col-form-label">Nombre Cliente: </label>
                                <h3>{{$empresa->nombre_empresa}}</h3>
                            
                                <input type="text" id="selEmpresa" value='{{$empresa->id_empresa}}' style='display:none;' />
                            @else
                                @include("Components.selectEmpresa")
                            @endif

                        </div>
                      
                      
                        </div>
                    </div>
                   
                <div class='col divBody' style='margin-right:20px;margin-top:10px;'>
                <div style='margin:5px;'>
                        <b>Proveedores</b>
                        <div>   
                                <span>1.-Seleccione el Proveedor </span>
                        </div>
                    </div>
                    <div id='divTblProveedor' class='table-responsive' style='height:300px;overflow:auto;margin-top:10px;'>
                     @include("Components.tblProveedor")
                    </div>
                </div>
                <div class='col divBody' style='margin-right:20px;margin-top:10px;'>
                    <div style='margin:5px;'>
                        <b>Contactos</b>
                        <div>   
                                <span>2.-Seleccione el Contacto para su Proveedor </span>
                        </div>
                    </div>
                   
                    <div id='divTblContacto' class='table-responsive' style='height:300px;overflow:auto;margin-top:10px;'>
                   
                    </div>
                </div>
                <div class="mb-3 row">
                            <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                            <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                        
                        </div>
            
            </div>           
        </div>       
</div>
</body>
</html>
<script src="../resources/js/viewsJs/mantAsignaProveedorContacto.js?v=1"> </script>