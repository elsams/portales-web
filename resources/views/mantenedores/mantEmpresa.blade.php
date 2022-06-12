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
                        <div class="row">        
                                <h3>Mantenedor de Cliente / Empresas</h3>  
                        </div>
                        <div class='row'>
                            <label for="inpEmpresa" class="col-sm-2 col-form-label">Nombre Empresa</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpEmpresa" value="">
                            </div>
                        </div>
                        <div class='row'>
                            <label for="inpRazon" class="col-sm-2 col-form-label">Razón Social</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpRazon" value="">
                            </div>
                        </div>
                        <div class='row'>
                            <label for="inpRut" class="col-sm-2 col-form-label">Rut</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpRut" value="">
                            </div>
                        </div>
                        <div class='row'>
                            <label for="inpRut" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpMail" value="">
                            </div>
                        </div>
                        <!--CENTRO COSTO -->
                        <div class='row'>
                            <label for="inpNombreCentro" class="col-sm-2 col-form-label">Nombre Centro</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpNombreCentro" value="">
                            </div>
                        </div>
                        <div class='row'>
                            <label for="inpLocalidad" class="col-sm-2 col-form-label">Localidad Centro</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inpLocalidad" value="">
                            </div>
                        </div>
                        <!--
                        <div id='row'>
                            <label for="selUsuario" class="col-sm-2 col-form-label">Administrador</label>
                            <div class="col-sm-10">
                                <select id='selUsuario' class='form-select'>
                                    <option value='0'>Seleccione Supervisor de Empresa</option>
                                    @foreach($usuarios as $usuario)
                                    <option value='{{$usuario->id}}'>{{$usuario->username}}</option>
                                    @endforeach
                                </select>
                                    <div id='solUsu'>
                                        Solicitar Usuario : <input class="form-check-input" type="checkbox" value="" id="inpSolUsu">
                                    </div>
                            </div>
                        </div>
                        -->
                        <div id='row'>
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
            </div>
            <div class='col divBody' id='dvsubEmpresa' style='margin-top:10px;margin-right:20px;'>
                    <div id='tblEmpresas' class='table-responsive'> @include("Components.tblEmpresas")                  
                    </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<script src="{{URL::asset('../resources/js/viewsJs/mantEmpresa.js?v=1.').rand()}}"></script>