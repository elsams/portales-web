<table class='table'>
<thead>
<tr>
    <th>Tipo Ítem</th>
    <th>Opciones</th>
</tr>
</thead>
<tbody>
    @foreach($tipoItem as $item)
    <tr>
    
        <td>{{$item->descrip_tipo}}</td>
        <td>
        <div class="form-check">
        

        @if($item->checked==0)
            <input class="form-check-input check" type="checkbox" value=""  data-id='{{$item->id_tipo_item}}'>
        @else
            <input class="form-check-input check" type="checkbox" checked value=""  data-id='{{$item->id_tipo_item}}'>
        @endif
                <label class="form-check-label" for="flexCheckDefault">
                    Asignar
                </label>

            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>