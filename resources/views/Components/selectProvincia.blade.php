<select id='selProvincia' class='form-select'>
    <option value='0'>Seleccione Provincia</value>
    @foreach($provincias as $provincia )
     <option value='{{$provincia->id}}'>{{$provincia->provincia}}</value>
    @endforeach
</select>  