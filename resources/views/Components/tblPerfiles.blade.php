<table class='table table-responsive' id='tblMenu'>
    <thead>
        <tr>
            <th>Nombre Perfil</th>
            <th>Descripción Perfil</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($perfiles  as $perfil)
            <tr>
                <td>{{$perfil->codigo_perfil}}</td>
                <td>{{$perfil->descrip_perfil}} </td>
                <td>
                <img id='edit_{{$perfil->id_perfil}}' class='btnEdit' data-id='{{$perfil->id_perfil}}'   data-codigo='{{$perfil->codigo_perfil}}' data-desc='{{$perfil->descrip_perfil}}'  width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
               </td>
            </tr>
            @endforeach
        
    </tbody>
</table>