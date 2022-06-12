<select id='selTipodoc' class='form-select'>
    <option value=0>Seleccione Tipo de Documento</option>
    @foreach($tipo_documento as $tipo)
    @if($tipo->id_tipo_doc=="1")
       <option value='{{$tipo->id_tipo_doc}}' selected >{{$tipo->desc_tipo_doc}}</option>
    @else
       <option value='{{$tipo->id_tipo_doc}}' >{{$tipo->desc_tipo_doc}}</option>
    @endif
   
    @endforeach
</select>