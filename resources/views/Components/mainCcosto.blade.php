
<div class='container' style='width:95%;text-align:center; box-shadow: 5px 10px 8px #888888;'>
<h3>Centros de Costo</h3>
@if(isset($Centros)) 
    @foreach($Centros as $costo)
        <div class='row CcostoItem' data-id='{{$costo->id_centro}}' >
               
               <a class="nav-link dpItem" aria-current="page"  style='color:black;'
                href="./operaciones/{{$costo->id_centro}}">
                <span>{{$costo->desc_cc}},{{$costo->localidad}}</span>
                </a>
            
        </div>
    @endforeach
@endif
</div>