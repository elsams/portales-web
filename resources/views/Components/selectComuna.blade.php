<select id='selComuna' class='form-select'>
    <option value='0'>Seleccione Comuna</value>
    @foreach($comunas as $comuna )
     <option value='{{$comuna->id}}'>{{$comuna->comuna}}</value>
    @endforeach
</select>  