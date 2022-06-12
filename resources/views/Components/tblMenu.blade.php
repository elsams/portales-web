<table class='table' id='tblMenu'>
    <thead>
        <tr>
            <th>Código</th>
            <th>Url</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($menuitems  as $menu)
            <tr>
                <td>{{$menu->cod_menu}}</td>
                <td>{{$menu->url}} </td>
                <td>
                    <img id='edit_{{$menu->id_menu}}' class='btnEdit' data-id='{{$menu->id_menu}}' data-url='{{$menu->url}}' data-cod_menu='{{$menu->cod_menu}}'  data-idparent='{{$menu->id_parent}}' data-vigencia='{{$menu->vigencia}}' width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
                </td>
            </tr>
            @endforeach
        
    </tbody>
</table>