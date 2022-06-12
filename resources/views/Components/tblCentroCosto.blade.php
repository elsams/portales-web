<table class='table'>
<thead>
<tr>
    <th>Nombre Centro</th>
    <th>Localidad</th>
    <th>Opciones</th>
</tr>
</thead>
<tbody>
    @foreach($Centros as $Ccosto)
    <tr>        
        <td>{{$Ccosto->desc_cc}}</td>
        <td>{{$Ccosto->localidad}}</td>
        <td>
            <img id='edit_{{$Ccosto->id_centro}}' class='btnEdit' 
            data-id='{{$Ccosto->id_centro}}' 
            data-nombreCentro='{{$Ccosto->desc_cc}}' 
            data-localidad='{{$Ccosto->localidad}}' 
            data-vigencia='{{$Ccosto->vigencia}}' 
            data-principal='{{$Ccosto->principal}}' 
            width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
        </td>
    </tr>
    @endforeach
</tbody>
</table>