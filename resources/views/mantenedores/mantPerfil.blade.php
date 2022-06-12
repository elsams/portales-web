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
                                <h3>Mantenedor de Perfil</h3>  
                            </div>
                            <div class="mb-3 row">
                                <label for="inpnNomPerfil" class="col-sm-2 col-form-label">Nombre Perfil</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" id="inpnNomPerfil" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inpDescPerfil" class="col-sm-2 col-form-label">Descripción Perfil</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" id="inpDescPerfil" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class='col'> <input type='button' class='form-control'  value='Guardar' id='inpGuardar'/></div>

                                <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class='divBody'>
                        <div id='divTblMenuPerfil'>
                        @include("Components.tblMenuPerfil")  
                          
                        </div>
                        
                    </div>
            </div>
            <div class='col col-3 divBody' style='margin-right:20px;margin-top:10px;'>
                Editar Perfil
                <div id='divTblPerfiles'>
                @include("Components.tblPerfiles")  
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<script src="../resources/js/viewsJs/mantPerfil.js?v=1.2"> </script>

