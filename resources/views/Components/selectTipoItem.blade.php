<select id='selTipoItem' class='form-select'>
    <option value='0'>Seleccione Tipo Ítem</value>
    @foreach($tipoItem as $item )
     <option value='{{$item->id_tipo_item}}'>{{$item->descrip_tipo}}</value>
    @endforeach
</select>  