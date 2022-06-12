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
@if($isModal == 0)
<div class='row'>
            <div id='divMenu'>@include("layouts.Menu")</div>   
        </div>
@endif      

        <div class='row'> 
            <div class='col'> 
                    <div class='divBody'>    
                        <div style='margin:20px;'>  
                            <div class="mb-3 row">        
                                <h3>Mantenedor de Items</h3>  
                            </div>
                        <div class="mb-3 row">
                            <label for="inpNomMarca" class="col-sm-2 col-form-label">Nombre Herramienta</label>
                            <div class="col-sm-10">
                            <input type="text"  class="form-control" id="inpNomHerramienta" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpNomDescHerramienta" class="col-sm-2 col-form-label">Detalle</label>
                            <div class="col-sm-10">
                            <input type="text"  class="form-control" id="inpNomDescHerramienta" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpObs" class="col-sm-2 col-form-label">Observación</label>
                            <div class="col-sm-10">
                            <input type="text"  class="form-control" id="inpObs" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                             <label for="selMarca" class="col-sm-2 col-form-label">Marca</label>
                            <div class="col-sm-10">
                            @include("Components.selectMarca")
                            </div>                                                    
                        </div>
                        <div class="mb-3 row">
                             <label for="selTipoItem" class="col-sm-2 col-form-label">Tipo Item</label>
                            <div class="col-sm-10">
                            @include("Components.selectItem")
                            </div>                                                    
                        </div>
                        <div class="mb-3 row">
                            <label for="inpModelo" class="col-sm-2 col-form-label">Modelo</label>
                            <div class="col-sm-10">
                            <input type="text"  class="form-control" id="inpModelo" value="">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                            <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                        
                        </div>
                        </div>
                    </div>
                @if($isModal == 0)
                <b>Editar Items</b>

                <div class='col divBody' style='margin-right:20px;margin-top:10px;'>
                   
                    <div id='divTblHerramienta'  class='table-responsive' style='height:300px;overflow:auto;'>
                     @include("Components.tblHerramienta")
                    </div>
                   
                </div>
                @endif
            </div>           
        </div>       
</div>
</body>
</html>
<script src="{{URL::asset('../resources/js/viewsJs/mantHerramienta.js?v=1.8').rand()}}"> </script>

<script>
var urlGuardar= "{{URL::asset('/item/guardarItem')}}";
</script>