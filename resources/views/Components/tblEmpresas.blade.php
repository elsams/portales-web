<table class='table'>
<thead>
<tr>
    <th>Empresa</th>
    <th>Razón Social</th>
    <th>Rut</th>
    <th>Opciones</th>
</tr>
</thead>
<tbody>
    @foreach($empresas as $empresa)
    <tr>
        <td>{{$empresa->nombre_empresa}}</td>
        <td>{{$empresa->razon_social_empresa}}</td>
        <td>{{$empresa->id_empresa}}</td>
        <td>
            <img id='edit_{{$empresa->id_empresa}}' class='btnEdit' 
            data-id='{{$empresa->id_empresa}}' 
            data-rut='{{$empresa->rut_empresa}}' 
            data-nombre='{{$empresa->nombre_empresa}}' 
            data-razon='{{$empresa->razon_social_empresa}}' 
            data-vigencia='{{$empresa->vigencia}}' 
            data-id_usuario='{{$empresa->id_usuario}}'
            width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
        </td>
    </tr>
    @endforeach
</tbody>
</table>