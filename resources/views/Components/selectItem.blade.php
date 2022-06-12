<select id='selTipoItem' class='form-select'>
    <option value='0'>Seleccione Cargo</value>
    @foreach($tipoItems as $tipoitem )
     <option value='{{$tipoitem->id_tipo_item}}'>{{$tipoitem->descrip_tipo}}</value>
    @endforeach
</select>  