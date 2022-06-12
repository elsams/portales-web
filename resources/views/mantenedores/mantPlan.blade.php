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
        <!-- Div Empresaa-->
        <div id='divBody'>            
                  <div style='margin:20px;'>  
                    <div class="mb-3 row">        
                        <h3>Mantenedor Asiganción de Servicio</h3>  
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
        <!-- Div Tipo Item-->
        <div id='divBody'>           
            <div id='tblTipoItem' class='table-responsive'> 
             @include("Components.tblTipoItem")
            </div>
        
        </div>
        <div class="mb-3 row">
                <div class='col'> <input type='button' class='form-control'  value='Guardar' id='btnGuardar'/></div>

                <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                
            </div>
    </div>
</div>



</div>
</body>
</html>
<script src="../resources/js/viewsJs/mantPlan.js?v=1.5"></script>

