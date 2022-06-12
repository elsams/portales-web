<select id='selProveedor' class='form-select'>
    <option value='0'>Seleccione Proveedor</value>
    @foreach($proveedores as $proveedor )
     <option value='{{$proveedor->id_proveedor}}'>{{$proveedor->nombre_fantasia}}</value>
    @endforeach
</select>  