<select id='selMarca' class='form-select'>
    <option value='0'>Seleccione Marca</value>
    @foreach($marcas as $marca )
     <option value='{{$marca->id_marca}}'>{{$marca->nombre_marca}}</value>
    @endforeach
</select>  