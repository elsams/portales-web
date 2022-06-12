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
        <div id='divBody' class='divBody'>
            <div style='margin:10px;'>
            <div class="mb-3 row">        
                                <h3>Mantenedor de Proveedores</h3>  
                            </div>
              <div class="mb-3 row">
                    <label for="inpRazonSocial" class="col-sm-2 col-form-label">Razón Social</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpRazonSocial" value="">
                    </div>
             </div>
             <div class="mb-3 row">
                    <label for="inpNomFantasia" class="col-sm-2 col-form-label">Nombre Fantasía</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpNomFantasia" value="">
                    </div>
             </div>
             <div class="mb-3 row">
                    <label for="inpGiroPrin" class="col-sm-2 col-form-label">Giro Principal</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpGiroPrin" value="">
                    </div>
             </div>
             <div class="mb-3 row">
                    <label for="inpGiroSec" class="col-sm-2 col-form-label">Giro Secundario</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpGiroSec" value="">
                    </div>
             </div>
             <div class="mb-3 row">
                    <label for="inpRut" class="col-sm-2 col-form-label">Rut Empresa</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpRut" value="">
                    </div>
             </div>
             <div class="mb-3 row">
                    <label for="inpDireccion" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpDireccion" value="">
                    </div>
             </div>
             <div class='row'>
             <label for="selProvincia" class="col-sm-2 col-form-label">Comuna</label>
                    <div class="col-sm-10">
                        @include("Components.selectComuna")  
                    </div>
                                
            </div>
            <div class='row'>
                 <label for="inpEmail" class="col-sm-2 col-form-label">Email</label>
                 <div class="col-sm-10">
                    <input type='text' class="form-control mail" id='inpEmail' placeholder='Email' />            
                </div>
            </div>
            <div class='row'>
                 <label for="inpFonoMatriz" class="col-sm-2 col-form-label">Fono Casa Matriz :</label>
                 <div class="col-sm-10">
                    <input type='text' class="form-control phoneNumber" id='inpFonoMatriz' placeholder='Fono Casa Matriz' />            
                </div>
            </div>
            <div class='row'>
                 <label for="inpFonoBodega" class="col-sm-2 col-form-label">Fono Depto. Bodega :</label>
                 <div class="col-sm-10">
                    <input type='text' class="form-control phoneNumber" id='inpFonoBodega' placeholder='Fono Depto. Bodega' />            
                </div>
            </div>
            <div class='row'>
                 <label for="inpFonoVentas" class="col-sm-2 col-form-label">Fono Depto. Ventas :</label>
                 <div class="col-sm-10">
                    <input type='text' class="form-control phoneNumber" id='inpFonoVentas' placeholder='Fono Depto. Ventas' />            
                </div>
            </div>
            <br>
            <div class="mb-3 row">
                <div class='col'> <input type='button' class='form-control'  value='Guardar' id='btnGuardar'/></div>

                <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                
            </div>
            </div>
        </div>


        <div class='col divBody' id='divTblProveedor' style='margin-top:10px;'>
                    <div id='tblProveedor' class='table-responsive'> @include("Components.tblProveedor")              
                    </div>
            </div>
        </div>
</div>
</body>
</html>
<script src="../resources/js/viewsJs/mantProveedor.js?v=1.13"></script>