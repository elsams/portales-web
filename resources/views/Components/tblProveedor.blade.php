@php
if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
@endphp
<table class='table table-hover table-responsive' id='tblProveedor'>
    <thead>
        <tr>
            <th>Razón Social</th>
            <th>Rut</th>
            <th>Nombre Fantasía</th>
            <th>Giro Principal</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($proveedores  as $proveedor)
            <tr>
                <td>{{$proveedor->razon_social}}</td>
                <td>{{$proveedor->rutProv}}</td>
                <td>{{$proveedor->nombre_fantasia}} </td>
                <td>{{$proveedor->giro_principal}} </td>
                <td>
                    @if($swContacto!=="1" &&  $_SESSION["role"] == 11 )
                   
                  <img id='edit_{{$proveedor->id_proveedor}}' class='btnEdit' 
                  data-id='{{$proveedor->id_proveedor}}'   
                  data-razon_social='{{$proveedor->razon_social}}' 
                  data-rut='{{$proveedor->rutProv}}'  
                  data-giro_principal='{{$proveedor->giro_principal}}' 
                  data-giro_secundario='{{$proveedor->giro_secunadario}}' 
                  data-nombre_fantasia='{{$proveedor->nombre_fantasia}}'  
                  data-direccion='{{$proveedor->direccion}}'  
                  data-comuna_id='{{$proveedor->comuna_id}}'
                  data-fono_matriz='{{$proveedor->fono_matriz}}'  
                  data-fono_bodega='{{$proveedor->fono_bodega}}'  
                  data-fono_venta='{{$proveedor->fono_venta}}'  
                  data-correo='{{$proveedor->correo}}'  
                  width='15px'  heigth='15px' src="{{asset('../resources/icons/001-editar.png')}}" />
                  @endif
                
                  @if($swContacto=="1")
                  <div class="form-check">
                    <input class="form-check-input radioSelect" 
                    data-id='{{$proveedor->id_proveedor}}'   
                    type="radio" name="radioSelect" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Seleccionar
                        </label>
                    </div>
                  @endif
               </td>
            </tr>
            @endforeach
        
    </tbody>
</table>