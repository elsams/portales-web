<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</header>

<div class='row' > 
    <div id='divMenu'>@include("layouts.Menu")</div>
</div>
<div class='row' style='text-align:center;margin-top:10px;'> 
   <h3>Ingreso de Documentos</h3>
   <h3>Centro: {{$nombre_centro}}</h3>
</div>
@php
$disabled="";
@endphp
<div class='container' style='margin-top:20px;'>
<div class='row divBody' >
<!-- Cabecera Guia-->    
<div class='col' style='margin-top:20px; margin-bottom:20px;'>

    <div class='row'>
        <label for="selTipodoc" class="col-sm-2 col-form-label">Tipo de Documento</label>
        <div class="col-sm-10">
            @include("Components.tipo_documento")
        </div>
    </div>   
  
    <div class='row'>
        <label for="selProveedor" class="col-sm-2 col-form-label">Proveedor</label>
        <div class="col-sm-10">
            @include("Components.selectProveedor")
        </div>
    </div>
    <div class='row'>
        <label for="inpFechaRecep" class="col-sm-2 col-form-label">Fecha Recepción</label>
        <div class="col-sm-10">
            <input type="date"  class="form-control" id="inpFechaRecep" value="{{ Date('Y-m-d') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="form-label" for="customFile">Subir Documento </label>
        <input type="file" class="form-control btn btn-primary" accept="image/*" id="inpFile1" />
             
                            
    </div>
</div>
<div class='col' style='margin-top:20px; margin-bottom:20px;'>
    <div class='row'>
        <label for="inpNumDocto" class="col-sm-2 col-form-label">Número de Documento</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control" id="inpNumDocto" value="">
        </div>
    </div>
    <div class='row'>
        <label for="inpNumOrden" class="col-sm-2 col-form-label">Orden de Compra</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control" id="inpNumOrden" attr-id_orden='' value="">
            <br>
            <button type="button" class="btn btn-primary" id='btnOrden'>Crear Orden de Compra</button>
            <button type="button" class="btn btn-primary" id='btnBuscaOrden'>Buscar Orden de Compra</button>
        </div>
    </div>
    <br>
    <div class="mb-3 row">
            <div class='col'> <input type='button' class='form-control btn btn-primary'  value='Guardar' id='btnGuardarGuia'/>
                <div class="spinner-border text-primary" id='loadGuardarGuia' style='display:none;' role="status">
                <span class="visually-hidden">Loading...</span>
                </div></div>

            <div class='col'> <input type='button' class='form-control btn btn-primary'  value='Limpiar' id='btnLimpiar'/></div>
                            
    </div>
    
</div>
<!-- -->
</div>
<input type='text' value=0 id='inpRow' style='display:none;' />
<div id='divAgregar'>
<div class='col'> <input type='button' class='form-control btn btn-primary'  value='Agregar Nuevo Item' id='btnAgregar'/></div>
</div>
<div class='row divBody table-responsive' id='divDetalle' >
        <table id='tblItemGuia' class='table'>
            <thead> 
                <tr>
                    <th>Código de Inventario</th>
                    <th></th>
                    <th width='150px'>Ítem</th>
                    <th>Unidad <br> Medida</th>
                    <th >Uso Mínimo<br>(Tiempo)</th>
                    <th >Código Pal</th>
                    <th>Patente</th>
                    <th>Cantidad Guía</th>
                    <th>Recepcionado</th>
                    <th>Cantidad Orden</th>
                    <th>Precio Unitario<br>(Peso Chileno)</th>
                    <th width='100px'>Total</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @php 
                $cnt= 1;
                @endphp
                <tr data-num='{{$cnt}}' class='itemRow'>
                    <td>
                        <input type='text' class='form-control' id='inpInv_{{$cnt}}' />
                    </td>
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
                        <input type='text' class='form-control tdNumber' id='inpMin_{{$cnt}}' value='0'/>
                    </td>               
                    <td>
                        <input type='text' class='form-control' id='inpPal_{{$cnt}}' value=''/>
                    </td>                
                    <td>
                        <input type='text' class='form-control' id='inpPatente_{{$cnt}}' value=''/>
                    </td>   
                   
                    <td>
                        <input type='text' class='form-control numeric cntIngreso tdNumber' id='inpCant_{{$cnt}}' value='1'/>
                    </td>
                    <td>
                        <input type='text' class='form-control tdNumber' id='inpCantRecep_{{$cnt}}' disabled value='0'/>
                    </td>
                    <td>
                        <input type='text' class='form-control tdNumber' id='inpCantOrden_{{$cnt}}' disabled value='0'/>
                    </td>
                    <td>
                        <input type='text' class='form-control numeric prcUnit tdNumber' id='inpPrecio_{{$cnt}}' value='0'/>
                    </td>
                    <td>
                        <input type='text' disable class='form-control tdNumber' id='inpTotal_{{$cnt}}' value='0'/>
                    </td>
                    <td>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>


</div>

@include("Components/modalBuscaItem")
@include("Components/modalAlertSinDoc")
</body>
</html>
@php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
@endphp
<script>
//$('#inpFechaRecep').val("{{ Date('Y/m/d') }}");
//$(document).ready( function() {
  //  $('#inpFechaRecep').val(new Date());
//});​
//document.getElementById('inpFechaRecep').value = new Date().toDateInputValue();
var id_empresa = "{{$_SESSION['id_empresa']}}";  
var id_obra = "{{ $id_centro }}";      
function getBuscaItems(id_empresa){
    console.log(id_empresa);
    if(id_empresa !=="0")
    {
        let urlPst = "{{URL::asset('item/getTblHerramientasCliente/')}}/"+id_empresa;
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "GET",
            dataType: "html",
            data: {           
                "_token": $("meta[name='csrf-token']").attr("content")                
            },
            async:false,
            beforeSend: function(){
            },
            success: function(data){
               $("#bodyBusqueda").html(data);
            }
        });
    }

}

function getTraeFormItems(){

        let urlPst = "{{URL::asset('/mantItem')}}";
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "GET",
            dataType: "html",
            data: {           
                "isModal": 1,
                "_token": $("meta[name='csrf-token']").attr("content")                
            },
            async:false,
            beforeSend: function(){
            },
            success: function(data){
                $("#titleBusqItem").text("Busqueda de Items");
                $("#bodyBusqueda").html(data);
                $("#modalBusqueda").modal("show");
            }
        });
    
}
let urlTrDetalle ="{{URL::asset('/recepcion/trDetalleGuia')}}";
let urlGuardaGuia ="{{URL::asset('/recepcion/guardarGuia')}}";
let urlCreaOrden ="{{URL::asset('/ordencompra/creaOrden')}}";
var urlTblOrdenes ="{{URL::asset('/ordencompra/ListadoOrdenes/')}}";

function getOrdenes(){
    if(id_obra !=="0")
    {
        let urlPst = urlTblOrdenes+"/"+id_obra;
        $.ajax(urlPst,{
            cache:false,
            global: false,
            type: "POST",
            dataType: "html",
            data: {           
                "_token": $("meta[name='csrf-token']").attr("content")                
            },
            async:false,
            beforeSend: function(){
            },
            success: function(data){
                $("#titleBusqItem").text("Busqueda de Orden de Compra");
               $("#bodyBusqueda").html(data);
               $("#modalBusqueda").modal("show");
            }
        });
    }

}
</script>

<script src="{{URL::asset('../resources/js/viewsJs/recepcionGuia.js?v=2.').rand()}}"> </script>