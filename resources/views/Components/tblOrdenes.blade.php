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
<td> {{$orden->fecha_emision}}</td>
<td> {{$orden->nombre_fantasia}}</td>
<td> {{$orden->desc_cc}}</td>
<td> {{$orden->desc_tipo_doc}}</td>
<td>
<img id='add_{{$orden->id_orden_compra}}' 
        src="{{asset('../resources/icons/pdf.png')}}"
        class='btnPdf'
        data-id_orden='{{$orden->id_orden_compra}}'
            width='15px'  heigth='15px'
        />
        <img id='add_{{$orden->id_orden_compra}}' 
        src="{{asset('../resources/icons/004-loupe.png')}}"
        class='btnConsultar'
        data-id_orden='{{$orden->id_orden_compra}}'
            width='15px'  heigth='15px'
        />
</td>
</tr>
@endforeach
</tbody>
</table>
<script>
var urlTraeOrdenPdf = "{{URL::asset('/informes/urlTraeOrdenPdf')}}";
var urlTraeOrdenInforme = "{{URL::asset('/informes/treOdenInforme')}}";
</script>