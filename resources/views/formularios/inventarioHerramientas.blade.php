<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</head>
<body>

    <div class='' >
        <div class='row'>
            <div id='divMenu'>@include("layouts.Menu")</div>
        </div>
        <div class='container' style='text-align:center;margin-top:25px;'> 
            
            <div class='row'>
                <div class='col'>
                    <h3>Inventario Herramientas : {{date('d-m-Y')}}</h3>
                </div>
                <div class='col'>
                     <button type="submit" class="btn btn-primary" id='btnPrintLista'>Imprimir</button>
                </div>
            </div>
            <div class='row'>
                 @include("Components.formItem")
            </div>
        </div>
        
    </div>
    
</body>
</html>
<script>
    var id_centro = "{{$id_centro}}";
    var urlImprimir  ="{{URL::asset('/invHerramienta/imprimir/')}}";
</script>
<script src="{{URL::asset('../resources/js/viewsJs/inventarioHerramientas.js?v=1.').rand()}}"> </script>