
@php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
@endphp
<div>
    <label for="inpBuscar" class="col-sm-2 col-form-label">Buscar</label>
    <input type='text'  id='inpBuscar' placeholder='Buscar' />
</div>
<table class='table table-responsive' id='tblHerramientas'>
<thead>
<tr>
    <th>Nombre Herramienta</th>
    <th>Detalle Herramienta</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Tipo Ítem</th>
    @if($_SESSION["role"] == 11)
    <th>Opciones</th>
    @endif

    @if($tipo==2)
    <th>Opciones</th>
    @endif

</tr>
</thead>
<tbody>
    @foreach($herramientas as $herramienta)
    <tr>
        <td>{{$herramienta->nombre_herramienta}}</td>
        <td>{{$herramienta->detalle_herramienta}}</td>
        <td>{{$herramienta->nombre_marca}}</td>
        <td>{{$herramienta->modelo}}</td>
        <td>{{$herramienta->descrip_tipo}}</td>
        @if($_SESSION["role"] == 11)
        <td>
       
            <img id='edit_{{$herramienta->id_herramienta}}' class='btnEdit' 
            data-nombre_herramienta='{{$herramienta->nombre_herramienta}}'
            data-detalle_herramienta='{{$herramienta->detalle_herramienta}}'
            data-id_marca='{{$herramienta->id_marca}}'
            data-modelo='{{$herramienta->modelo}}'
            data-id_item = '{{$herramienta->id_item}}'
            data-observacion = '{{$herramienta->observacion}}'
            width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
            
                <img id='edit_{{$herramienta->id_herramienta}}' class='btnEliminar'
                data-id='{{$herramienta->id_herramienta}}' 
                width='15px'  heigth='15px' src="{{asset('../resources/icons/001-remove.png')}}" />
            
        </td>
        @endif
        @if($tipo==2)
        <td>
        <img id='add_{{$herramienta->id_herramienta}}' 
        src="{{asset('../resources/icons/002-add.png')}}"
        class='bntAgregar'
        data-id_herramienta='{{$herramienta->id_herramienta}}'
        data-nombre_herramienta='{{$herramienta->nombre_herramienta}}'
        data-detalle_herramienta='{{$herramienta->detalle_herramienta}}'
        data-id_marca='{{$herramienta->id_marca}}'
        data-modelo='{{$herramienta->modelo}}'
        data-id_item = '{{$herramienta->id_item}}'
        data-observacion = '{{$herramienta->observacion}}'
        data-marca = '{{$herramienta->nombre_marca}}'

            width='15px'  heigth='15px'
        />

        </td>
        @endif
    </tr>
    @endforeach
</tbody>
</table>
<script>
$("#inpBuscar").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tblHerramientas tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $("#tblHerramientas").on("click",".bntAgregar",function(){
        let numItem =$("#inpRow").val();
        console.log("BUTTON agregar  numItem: "+numItem);
    
        let id_herramienta = $(this).attr("data-id_herramienta");
        let nombre_herramienta = $(this).attr("data-nombre_herramienta") +", "+$(this).attr("data-marca") + ", " +$(this).attr("data-modelo") ;
        $("#inpItem_"+numItem).attr("data-id",id_herramienta);
        $("#inpItem_"+numItem).val(nombre_herramienta);
        $("#modalBusqueda").modal("hide");
    });
</script>