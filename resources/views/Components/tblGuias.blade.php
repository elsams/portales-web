<table id='tblGuias' class='table'>
<thead>
    <th>Numero Guía</th>
    <th>Fecha de Ingreso</th>
    <th>Proveedor</th>
    <th>Centro de Costo</th>
    <th>Tipo De Documento</th>
    <th>Opciones</th>
</thead>
<tbody>
@foreach($guias as $guia)
<tr>
<td>{{$guia->numero_guia}} </td>
<td> {{$guia->fecha_ingreso}}</td>
<td> {{$guia->nombre_fantasia}}</td>
<td> {{$guia->desc_cc}}</td>
<td> {{$guia->desc_tipo_doc}}</td>
<td>
<img id='add_{{$guia->id_guia}}' 
        src="{{asset('../resources/icons/pdf.png')}}"
        class='btnPdf'
        data-id_guia='{{$guia->id_guia}}'
            width='15px'  heigth='15px'
        />
        <img id='add_{{$guia->id_guia}}' 
        src="{{asset('../resources/icons/004-loupe.png')}}"
        class='btnConsultar'
        data-id_guia='{{$guia->id_guia}}'
            width='15px'  heigth='15px'
        />
</td>
</tr>
@endforeach
</tbody>
</table>
<script>
var urlTraeGuiaPdf = "{{URL::asset('/informes/urlTraeGuiaPdf')}}";
var urlTraeGuiaInforme = "{{URL::asset('/informes/treGuiaInforme')}}";
</script>