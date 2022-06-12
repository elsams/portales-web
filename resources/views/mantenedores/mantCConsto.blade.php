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
<div class='row' style='margin:5px;'> 
        <div id='divBody' >
                <div class="mb-3 row">        
                    <h3>Mantenedor de Centros de Costo</h3>  
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
                <div class="mb-3 row">
                    <label for="inpNombreCentro" class="col-sm-2 col-form-label">Nombre Centro</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" id="inpNombreCentro" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inpLocalidad" class="col-sm-2 col-form-label">Localidad Centro</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" id="inpLocalidad" value="">
                    </div>
                </div>
                <div id='row'>
                            <div class="form-check">
                            <label class="form-check-label" for="inpPrincipal">
                                Principal / Matriz
                                </label>
                                <input class="form-check-input" type="checkbox" checked value="" id="inpPrincipal">
                            
                            </div> 
                </div>
                @if($_SESSION["role"] == 11)
                    <div id='row'  style=''>
                @else
                    <div id='row' style='display:none;'  >
                @endif               
                            <div class="form-check">
                            <label class="form-check-label" for="inpHabilitado">
                                Vigencia
                                </label>
                                <input class="form-check-input" type="checkbox" checked value="" id="inpHabilitado">
                            
                            </div> 
                
                </div>
                <div class="mb-3 row">
                    <div class='col'> <input type='button' class='form-control'  value='Guardar' id='btnGuardar'/></div>

                    <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                    
                </div>  

                
        
        </div>
</div>
    <div class='row divBody'  style='margin:5px;'>
            Editar Centro Costo
            <div id='tblCentros' class='table-responsive'>
            
            </div>
    </div>
</body>
</html>
<script src="../resources/js/viewsJs/mantCConsto.js?v=1.12"> </script>
