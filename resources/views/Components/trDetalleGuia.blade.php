@php
    $id_item ="";
    $id_unidad_medida="0"; 
    $tiempo_sol= "0";
    $cantidad_sol ="1";
    $nombre_herramienta = "";
    $total_item ="0";
    $cantidad_min ="0";
    $total_unitario="0";
    $disabled ="";
    $id_item_oc ="";
    $modelo ="";
    $recepcionado ="0";
    $cantPendiente="0";
    if(isset($item)){
        $id_item =$item->id_item;
        $id_unidad_medida=$item->id_unidad_medida; 
        $tiempo_sol= $item->tiempo_sol;
        $cantidad_sol =$item->cantidad_sol;
        $nombre_herramienta =$item->nombre_herramienta;
        $total_item =$item->total_item;
        $cantidad_min = $item->cantidad_min;
        $id_item_oc =$item->id_item_oc;
        $disabled ="disabled";
        $modelo =$item->modelo;
        $recepcionado=$item->recepcionado;
        $cantPendiente=$cantidad_sol-$recepcionado;
    }
@endphp
@for($i=0;$i<$cantidad_sol ;$i++)
<tr data-num='{{$cnt}}' class='itemRow'>
    <td>
        <input type='text' class='form-control' id='inpInv_{{$cnt}}' />
    </td>
    <td >
        
        @if($id_item == "")
                    <img for="inpItem" class='btnBuscarItem' 
                    src="{{URL::asset('../resources/icons/004-loupe.png')}}"
                    width='25px' height='25px;'
                    data-num='{{$cnt}}'
                    />
                    <img for="inpItem" class='btnCrearItem' 
                        src="{{URL::asset('../resources/icons/002-add.png')}}"
                        width='25px' height='25px;'
                        data-num='{{$cnt}}'
                    />
        @else
            @php
              $total_unitario =  round($total_item/$cantidad_sol);
            @endphp            
        @endif
    </td>
    <td> 
            <input type='text' class='form-control' data-id='{{$id_item}}' data_item_oc='{{$id_item_oc}}'  disabled id='inpItem_{{$cnt}}' value='{{$nombre_herramienta}} - {{$modelo}}'  />                                                               
    </td>
    <td>
        <div class='row' >
                @include("Components.selectUnidadMedida")
            </div>                           
        </div>
    </td>
    <td>
        <input type='text' class='form-control numeric tdNumber' id='inpMin_{{$cnt}}' value='{{$cantidad_min}}'/>
    </td>
                
    <td>
        <input type='text' class='form-control' id='inpPal_{{$cnt}}' value=''/>
    </td>                
    <td>
        <input type='text' class='form-control' id='inpPatente_{{$cnt}}' value=''/>
    </td>   

    <td>
        <input type='text' class='form-control numeric cntIngreso tdNumber' id='inpCant_{{$cnt}}' row='{{$cnt}}' max='{{ $cantPendiente}}' value='1'/>
    </td>
    <td>
        <input type='text' class='form-control tdNumber' id='inpCantRecep_{{$cnt}}'  disabled value='{{$recepcionado}}'/>
    </td>
    <td>
        <input type='text' class='form-control tdNumber' id='inpCantOrden_{{$cnt}}' disabled value='1'/>
    </td>
    <td>
        <input type='text' disabled class='form-control numeric  prcUnit tdNumber' id='inpPrecio_{{$cnt}}' row='{{$cnt}}' value='{{$total_unitario}}'/>
    </td>
    <td>
        <input type='text' disabled class='form-control tdNumber' id='inpTotal_{{$cnt}}' value='{{$total_item}}'/>
    </td>
    <td>
    
    </td>
</tr>
    @php
        $cnt=$cnt+1;
    @endphp     
@endfor