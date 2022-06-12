<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
<?php
$menuitems="";
  if( !isset($_SESSION["menuItems"]) ){
    header('Location: http://localhost/portaleswebtools/public/');
    exit();
 }else{
  $menuitems=$_SESSION["menuItems"];
 }
?>
</head>
<body>
<div class='row'>
            <div id='divMenu'>@include("layouts.Menu")</div>
        </div>
    <div class='' id='divMenuForm'>  
        <div class='row'> 
           
            <div class='col'> 

                <div id='divBody'>
                    <div style='margin:20px;'>
                    <div class="mb-3 row">        
                                <h3>Mantenedor de Menú</h3>  
                            </div>
                    <div class="mb-3 row">
                        <label for="inpNomMenu" class="col-sm-2 col-form-label">Nombre Menú</label>
                        <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpNomMenu" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inpUrl" class="col-sm-2 col-form-label">Url: Menú</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inpUrl">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="SelMenu" class="col-sm-2 col-form-label">Menú Padre</label> 
                        <div class="col-sm-10">                          
                           <div id='SelMenu'></div>
                        </div>                       
                    </div>

                    <div class="mb-3 row">
                        <div class="form-check">
                           <label class="form-check-label" for="inpHabilitado">
                               Habilitado
                            </label>
                            <input class="form-check-input" type="checkbox" checked value="" id="inpHabilitado">
                         
                        </div>                   
                    </div>
                    <div class="mb-3 row">
                        <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                        <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                        
                    </div>

                </div>
            </div>
            <div class='row' style='margin:20px;'>
                    <div id='menuTable'> </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>
<script src="../resources/js/viewsJs/mantMenu.js?v=1"> </script>