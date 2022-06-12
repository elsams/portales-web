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
        <div class='row' style='text-align:center;'> 
            
          
            <h3>Formularios</h3>
                    <div class='col CcostoItem' data-id='{{$id_centro}}' >
                        <span> Controles</span>
                        <a class="nav-link dpItem" aria-current="page"  
                            href="./inventarioHerramientas/{{$id_centro}}">
                                <span>Inventario Herramientas</span>
                            </a>  

                    </div>
                   
            </div>
        
    </div>
    
</body>
</html>

