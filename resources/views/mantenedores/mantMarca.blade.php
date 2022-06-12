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
                            <div class="mb-3 row">        
                                <h3>Mantenedor de Marcas</h3>  
                            </div>
                        <div class="mb-3 row">
                            <label for="inpNomMarca" class="col-sm-2 col-form-label">Nombre Marca</label>
                            <div class="col-sm-10">
                            <input type="text"  class="form-control" id="inpNomMarca" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                            <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                        
                        </div>
                        </div>
                    </div>
                <div class='col col-4 divBody' style='margin-right:20px;margin-top:10px;'>
                    Editar Marca
                    <div id='divTblMarca' class='table-responsive'>
                    @include("Components.tblMarca")
                    </div>
                </div>
            
            </div>           
        </div>       
</div>
</body>
</html>
<script src="../resources/js/viewsJs/mantMarca.js?v=1.5"> </script>