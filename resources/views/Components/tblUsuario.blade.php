<table class='table' id='tblUsuario'>
    <thead>
        <tr>
            <th>Nombre Usuario</th>
            <th>Descripción Perfil</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($usuarios  as $usuario)
            <tr>
                <td>{{$usuario->username}}</td>
                <td>{{$usuario->descrip_perfil}} </td>
                <td>
                <img id='edit_{{$usuario->id}}' class='btnEdit' 
                data-id='{{$usuario->id}}'   
                data-username='{{$usuario->username}}'
                data-nombres='{{$usuario->nombres}}' 
                data-rut='{{$usuario->rut}}'
                  width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
               </td>
            </tr>
            @endforeach
        
    </tbody>
</table>