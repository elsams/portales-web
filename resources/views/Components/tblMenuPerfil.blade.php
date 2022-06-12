<table class='table' id='tblMenu'>
    <thead>
        <tr>
            <th>Código</th>
            <th>Url</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($menuItems  as $menu)
            <tr>
                <td>{{$menu->cod_menu}}</td>
                <td>{{$menu->url}} </td>
                <td>
                    @if($menu->checked==0)
                            <input class="form-check-input checks"  datra-checkd="{{$menu->checked}}" data-id='{{$menu->id_menu}}' type="checkbox" value="" id="flexCheckDefault">
                       @else 
                           <input class="form-check-input checks" datra-checked="{{$menu->checked}}" checked data-id='{{$menu->id_menu}}' type="checkbox" value="" id="flexCheckDefault">
                        
                    @endif
               </td>
            </tr>
            @endforeach
        
    </tbody>
</table>