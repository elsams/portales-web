<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</header>

<div class='row' > 
    <div id='divMenu'>@include("layouts.Menu")</div>
</div>
<div class='row' style='text-align:center;margin-top:10px;'> 
   <h3>Control de Inventario / Report</h3>
   <h3>Centro: {{ $NombreCentro }}</h3>
   
</div>

<div class='container' style='margin-top:20px;'>
 
    <h3>Ítems Recibidos</h3>
    <div class='row divBody' id='divTablaInv'>
        @include("Components/tblInventario")
    </div>


</div>

@include("Components/modalBuscaItem")
</body>
</html>
<script>
var  urlReportForm ="{{URL::asset('/report/getControlReport/')}}";  
var  urlReportHist ="{{URL::asset('/report/getHistoryReport/')}}";  

</script>
<script src="{{URL::asset('../resources/js/viewsJs/listadoItemsRepo.js?v=1.2').rand()}}"> </script>