<select id='selCargo' class='form-select'>
    <option value='0'>Seleccione Cargo</value>
    @foreach($cargos as $cargo )
     <option value='{{$cargo->id_cargo}}'>{{$cargo->nombre_cargo}}</value>
    @endforeach
</select>  