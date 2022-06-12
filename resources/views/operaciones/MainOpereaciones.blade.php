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
            
          
            <h3>Operaciones</h3>
            <h4>Centro : {{ $CentroCosto["desc_cc"]}} </h4>

                    <div class='col CcostoItem' data-id='{{$id_centro}}' >
                        <span> Movimientos</span>
                        <a class="nav-link dpItem" aria-current="page"  
                            href="./recepcionGuia/{{$id_centro}}">
                                <span>Entradas</span>
                            </a>  

                            <a class="nav-link dpItem" aria-current="page"  
                            href="./devoluciones/{{$id_centro}}">
                             <span>Salidas</span>
                            </a> 
                            <a class="nav-link dpItem" aria-current="page"  
                            href="./formularios/{{$id_centro}}">
                             <span>Formularios</span>
                            </a> 
                    </div>
                    <div class='col CcostoItem' data-id='{{$id_centro}}' >
                        <a class="nav-link dpItem" aria-current="page"  
                            href="../ordencompra/creaOrden/{{$id_centro}}/1">
                            <span>Órdenes de Compra</span>
                            </a>  
                    </div>
                    <div class='col CcostoItem' data-id='{{$id_centro}}' >
                        <a class="nav-link dpItem" aria-current="page"  
                            href="./operacionControl/{{$id_centro}}">
                            <span>Report / Control</span>
                            </a>  
                    </div>

            </div>
        
    </div>
    
</body>
</html>

