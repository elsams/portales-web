


<select id='selUnidadMedida_{{$cnt}}' class='form-select'  {{$disabled}} >
    <option value='0'>Seleccione <br>Unidad de Medida</value>
    @foreach($unidadesMedida as $Unidad )
    @if(isset($id_unidad_medida))

        @if($id_unidad_medida == $Unidad->id_unidad_medida)
             <option value='{{$Unidad->id_unidad_medida}}' selected>{{$Unidad->desc_unidad}}</value>
        @else
              <option value='{{$Unidad->id_unidad_medida}}'>{{$Unidad->desc_unidad}}</value>
        @endif
    @else
        <option value='{{$Unidad->id_unidad_medida}}'>{{$Unidad->desc_unidad}}</value>
    @endif
    @endforeach
</select>  