<table class='table' id='tblMarca'>
    <thead>
        <tr>
            <th>Nombre Marca</th>          
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($marcas  as $marca)
            <tr>
                <td>{{$marca->nombre_marca}}</td>
                <td>
                    @if($_SESSION["role"] == 11)
                    <img id='edit_{{$marca->id_marca}}' class='btnEdit'
                     data-id='{{$marca->id_marca}}' 
                     data-nombre_marca='{{$marca->nombre_marca}}'
                     width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
                    
                        <img id='edit_{{$marca->id_marca}}' class='btnEliminar'
                        data-id='{{$marca->id_marca}}' 
                        width='15px'  heigth='15px' src="{{asset('../resources/icons/001-remove.png')}}" />
                    @endif                   

                </td>
            </tr>
            @endforeach
        
    </tbody>
</table>