<select id='SelMenu' class='form-select'>
<option value="0">Sin Menu Padre</option>
    @foreach($menuitems  as $menu)
    <option value="{{$menu->id_menu}}">{{ $menu->cod_menu}}</option>
    @endforeach
</select>