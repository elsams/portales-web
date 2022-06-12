<table id='tblGuias table-responsive' class='table'>
<thead>
    <th>Ítem</th>
    <th>Cod Inventario</th>
    <th>Número Guía</th>
    <th>Fecha de Ingreso</th>
    <th>Proveedor</th>
    <th>Opciones</th>

</thead>
<tbody>
@foreach($items as $item)
<tr>
<td>{{$item->nombre_herramienta}} </td>
<td>{{$item->cod_inventario}} </td>
<td> {{$item->numero_guia}}</td>
<td> {{$item->fecha_ingreso}}</td>
<td> {{$item->nombre_fantasia}}</td>
<td>
<img id='add_{{$item->id_item_guia}}' 
        src="{{asset('../resources/icons/reporte.png')}}"
        class='btnReport'
        data-id_item_guia='{{$item->id_item_guia}}'
            width='20px'  heigth='20px'
        />
        <img id='add_{{$item->id_item_guia}}' 
        src="{{asset('../resources/icons/tiempo.png')}}"
        class='btnIngresos'
        data-id_item_guia='{{$item->id_item_guia}}'
            width='20px'  heigth='20px'
        />
</td>
</tr>
@endforeach
</tbody>
</table>    