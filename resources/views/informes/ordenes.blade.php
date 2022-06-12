<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</head>
<body>


        <div class='row'>
            <div id='divMenu'>@include("layouts.Menu")</div>
        </div>
<div class='container'>
        <div class='row'> 
            <h3>Informes Ordenes de compra</h3>
            <h3>Empresa</h3>
        </div>
        <div class='row' style='height:600px;overflow:auto;'> 
            <div class='divBody'>                        
                Filtros:
                <div class='row'>

                </div>
            </div>
            <div class='divBody' style='width:100%;'>                        
                <div id='divTblOrdenes'>
                   
                </div>
            </div> 
                     
        </div>       
</div>

</body>
</html>
<script>
var urlTraeOrdenes ="{{URL::asset('/informes/traeOrdenes').'/'.$id_empresa}}";

</script>
<script src="{{URL::asset('../resources/js/viewsJs/informeOrdenes.js?v=1.').rand()}}"> </script>

