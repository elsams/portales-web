
<tr data-num='{{$cnt}}' class='itemRow'>
    
    <td >
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
    </td>
    <td>   
        <input type='text' class='form-control' data-id='' disabled id='inpItem_{{$cnt}}'  />                                                                  
    </td>
    <td>
        <div class='row'>
            <div class='col'>
                @include("Components/selectUnidadMedida")
            </div>                           
        </div>
    </td>
    <td>
        <input type='text' class='form-control numeric inp tiempo tdNumber' id='inpTiempo_{{$cnt}}' value='0'/>
    </td>
    <td>
        <input type='text' class='form-control numeric inp tiempo tdNumber' id='inpMin_{{$cnt}}' value='0'/>
    </td>
    
    <td>
        <input type='text' class='form-control numeric inpCant tdNumber' id='inpCantOc_{{$cnt}}' value='0'/>
    </td>                 
    <td>
        <input type='text' class='form-control numeric inpPrecio tdNumber' id='inpPrecioOc_{{$cnt}}' value='0'/>
    </td>                
    <td>
        <input type='text' disable class='form-control tdNumber' disabled id='inpTotal_{{$cnt}}' value='0'/>
    </td>
</tr>