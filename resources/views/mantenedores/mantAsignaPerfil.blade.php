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
                         @include("Components.tblUsuario")
                
                    </div>
                <div class='col col-4 divBody' style='margin-right:20px;margin-top:10px;'>
                    Editar Contacto
                    <div id='divTblPersona' class='table-responsive'>
                  
                    </div>
                </div>
            
            </div>           
        </div>       
</div>

</body>
</html>
<script src="../resources/js/viewsJs/mantAsignaPerfil.js"> </script>