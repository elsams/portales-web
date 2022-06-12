<table id='tblOrdenes' class='table'>
<thead>
    <th>Numero Orden</th>
    <th>Fecha de Ingreso</th>
    <th>Proveedor</th>
    <th>Centro de Costo</th>
    <th>Tipo De Documento</th>
    <th>Opciones</th>
</thead>
<tbody>
@foreach($ordenes as $orden)
<tr>
<td>{{$orden->numero_orden}} </td>
<td> {{$orden->fecha_recepcion}}</td>
<td> {{$orden->nombre_fantasia}}</td>
<td> {{$orden->desc_cc}}</td>
<td> {{$orden->desc_tipo_doc}}</td>
<td>
<img id='add_{{$orden->id_orden_compra}}' 
        src="{{asset('../resources/icons/greencheck.png')}}"
        class='bntSelOden'
        data-id_orden='{{$orden->id_orden_compra}}'
            width='15px'  heigth='15px'
        />
</td>
</tr>
@endforeach
</tbody>
</table>
<script>
    //let id_orden= 0;
$(".bntSelOden").on("click",function(){
    id_orden = $(this).attr("data-id_orden");
    let urlPst= "{{URL::asset('/ordencompra/TraeOrdenRecep')}}"+"/"+id_orden;
    $("#divAgregar").hide();
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
            let datos = JSON.parse(data);
            $("#selProveedor").val(datos.id_proveedor);
            $("#selProveedor").prop( "disabled", true );
 
            $("#inpFechaRecep").val(datos.fecha_recepcion); 
            $("#inpNumOrden").val(datos.numero_orden);
            $("#inpNumOrden").attr("attr-id_orden",datos.id_orden_compra );
            $("#modalBusqueda").modal('hide');
           
        }
    });
    let urlTblDetalleOrden = "{{URL::asset('/ordencompra/TraeDetalleOrdenRecep')}}"+"/"+id_orden;
    $.ajax(urlTblDetalleOrden,{
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
            $("#tblItemGuia tbody").html("");    
            $("#tblItemGuia tbody").append(data);    
        }
    });
});
</script>