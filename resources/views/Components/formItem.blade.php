<table class='table'>
<thead>
<tr>
    <th>Código Inventario</th>
    <th>Herramienta</th>
    <th>Proveedor</th>
</tr>
</thead>
<tbody>
@foreach($items as $item)
<tr>
  
    <td class='col'>{{$item->cod_inventario}}</td>
    <td class='col'>{{$item->nombre_herramienta}}</td>
    <td class='col'>{{$item-> nombre_fantasia}}</td>
   
</tr>
@endforeach
</tbody>
</table>