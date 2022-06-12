<select id='selEmpresa' class='form-select'>
    <option value='0'>Seleccione Empresa</value>
    @foreach($Empresas as $Empresa )
     <option value='{{$Empresa->id_empresa}}'>{{$Empresa->nombre_empresa}}</value>
    @endforeach
</select>  