<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</header>
@if($menu==1)
<div class='row' > 
    <div id='divMenu'>@include("layouts.Menu")</div>
</div>
@endif
<div class='row' style='text-align:center;margin-top:10px;'> 
   <h3>Ingreso de Orden de Compra</h3>
   <h4>Centro: {{$nombre_centro}}</h4>
</div>
@php
$disabled="";
@endphp
<div class='container' style='margin-top:20px;'>
<div class='row divBody' >
<!-- Cabecera Guia-->    
<div class='col' style='margin-top:20px; margin-bottom:20px;'>

    <div class='row'>
        <label for="selTipodoc" class="col-sm-2 col-form-label">Tipo Documento</label>
        <div class="col-sm-10">
          <b> Orden de Compra  </b>
        </div>
    </div>   
  
    <div class='row'>
        <label for="selProveedor" class="col-sm-2 col-form-label">Proveedor</label>
        <div class="col-sm-10">
            @include("Components.selectProveedor")
        </div>
    </div>
    <div class='row'>
        <label for="inpFechaEmision" class="col-sm-2 col-form-label">Fecha Emisión</label>
        <div class="col-sm-10">
            <input type="date" max="{{ Date('Y-m-d') }}" class="form-control" id="inpFechaEmision" value="{{ Date('Y-m-d') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <label class="form-label" for="customFile">Subir Documento </label>
            <input type="file" class="form-control btn btn-primary" accept="image/*" id="inpFile" /> 
        </div>                
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
        <label for="inpFechaEmision" class="col-sm-2 col-form-label">Fecha Recepción</label>
        <div class="col-sm-10">
            <input type="date"  class="form-control" id="inpFechaRecepcion" value="{{ Date('Y-m-d') }}">
        </div>
    </div>
    <div class="row">
            <div class='col-sm-10'>
                 <input type='button' class='form-control btn btn-primary'  value='Guardar' id='btnGuardarOrden'/>
               <!--  <div><img src="{{URL::asset('../resources/icons/loading.gif')}}" width='25px' height='25px'>-->
               <div class="spinner-border text-primary" id='loadGuardarOrden' style='display:none;' role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
                       
    </div>
</div>

<!-- -->
</div>
<input type='text' value=0 id='inpRow' style='display:none;' />
<div id='divAgregar'>
<div class='col'> <input type='button' class='form-control btn btn-primary'  value='Agregar Nuevo Item' id='btnAgregar'/></div>
</div>
<br>
    <div class='row divBody table-responsive' id='divDetalle' >
        <table id='tblItemOrden' class='table'>
            <thead> 
                <tr>                   
                    <th ></th>
                    <th style='width:200px;'>Ítem</th>
                    <th >Unidad <br>Medida</th>
                    <th>Tiempo<br> Solicitado</th>
                    <th >Uso Mínimo<br>(Tiempo)</th>
                    <th title='Cantidad Orden de Compra'>Cantidad O.C</th>
                    <th title='Precio Orden de Compra'>Precio O.C</th>
                    <th>Total($)</th>
                </tr>
            </thead>
            <tbody>
                @php 
                  $cnt= 1;
                @endphp
                
                @include("Components/trDetalleOrden")
            </tbody>
        </table>
    </div>


</div>

@include("Components/modalBuscaItem")
@include("Components/modalAlertSinDoc")
</body>
</html>
<script>

var urlTrDetalleOrden ="{{URL::asset('/ordencompra/trDetalleOrden')}}";
var urlGuardaOrden ="{{URL::asset('/ordencompra/guardaOrden')}}";

 
function getBuscaItems(id_proveedor){
    console.log(id_proveedor);
    if(id_proveedor !=="0")
    {
        let urlPst = "{{URL::asset('item/getTblItemByProv/')}}/"+id_proveedor;
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
               //$("#titleBusqItem").html(data);
            }
        });
    }

}

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
       $("#bodyBusqueda").html(data);
    }
});

}


</script>
<script src="{{URL::asset('../resources/js/viewsJs/recepcionOrden.js?v=1.2').rand()}}"> </script>