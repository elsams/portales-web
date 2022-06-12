@php
$nombre ="";
$desc_unidad= "";
$numero_orden ="";
$proveedor ="";
$modelo ="";
$codigo ="";
$numero_guia = "";
$tiempo_solicitado = "";
$umedida = "";
$km_total = "0";
$total_vuelta ="0";
$horometro_total="0";
$totalDiaSemana = "0";
$valorTotalMedido = "0";
$idumedida = "0";
if($Reportes)
{
   
    $nombre = $Reportes[0] ->nombre_herramienta;
    $desc_unidad = $Reportes[0]->desc_unidad;
    if($Reportes[0]->numero_orden != "0"){
        $numero_orden =$Reportes[0]->numero_orden;
    }else{
        $numero_orden ="Sin Orden";
    }
   
    $proveedor= $Reportes[0]->nombre_fantasia;
    $modelo =$Reportes[0]->cod_inventario;
    $codigo =$Reportes[0]->cod_inventario;
    $numero_guia = $Reportes[0]->numero_guia;
    $tiempo_solicitado =  $Reportes[0]->tiempo_sol;
    $umedida = $Reportes[0]->unid_medida;
    $idumedida  = $Reportes[0]->id_unidad_medida;
    $km_total = $Reportes[0]->km_total;
    $total_vuelta =$Reportes[0]->total_vuelta;
    $horometro_total=$Reportes[0]->horometro_total;
    $totalDiaSemana = $Reportes[0]-> diaMesSemana;
    switch($idumedida){
    case 1: //hora
        $valorTotalMedido =$horometro_total;
        break;
    case 2: //dia
        $valorTotalMedido =$totalDiaSemana;
        break;
    case 3: //dia habil
        $valorTotalMedido =$totalDiaSemana;
        break;
    case 4: //mes
        $valorTotalMedido =$totalDiaSemana;
        break;
    case 5: //semana
        $valorTotalMedido =$totalDiaSemana;
        break;
    case 6: //vuelta
        $valorTotalMedido =$total_vuelta;
        break;
    case 7: //Kms
        $valorTotalMedido =$km_total;
        break;
    }
    
}

@endphp
<style>

</style>
<div class='row'>
    <div class='col'>Ítem : {{$nombre}}, {{$modelo}}</div>
    <div class='col'>Proveedor : {{  $proveedor }}</div>
    <div class='col'>Medida: {{$desc_unidad}} </div>
    <div class='col'>Tiempo Solicitado: {{$tiempo_solicitado}} {{$umedida}} </div>
    
    
</div>
<div class='row'>
    <div class='col'>Orden de Compra: {{$numero_orden}} </div>
    <div class='col'>Cod. Inventario: {{$codigo}} </div>
    <div class='col'>Número Guía: {{$numero_guia}} </div>
    <div class='col'>Tiempo Utilizado: {{$valorTotalMedido}}  {{$umedida}} </div>
</div>
<table class='table table-responsive' id='tblReportHist'>
    <thead>
        <tr>
            <th>Fecha Report</th>
            <th>N° Report</th>
            <th>Factura</th>   
            <th>Documento</th>   
        </tr>
    </thead>
    <tbody>
            @foreach($Reportes  as $report)
            <tr>
                <td>{{$report->fecha_report}} </td>
                <td>{{$report->num_report}}</td>
                <td>S/F</td>
                <td>
                     <img id='add_{{$report->id_control}}' 
                        src="{{asset('../resources/icons/pdf.png')}}"
                        class='btnPdf'
                        data-id_report='{{$report->id_control}}'
                            width='15px'  heigth='15px'
                        />                    
                </td>
                
            </tr>
            @endforeach
        
    </tbody>
</table>
<script>
$("#tblReportHist").on("click",".btnPdf",function(){
    let id_report= $(this).attr("data-id_report");
    let urlPst = urlTraeReportPdf + "/"+id_report;
    
        var iframe = $('<embed src="'+urlPst+'" width="100%" height="100%">');
        
       /// iframe.append(data);
       $("#modalFormTitle").text("Documento");
       $("#modalFormBody").html(iframe);
       $("#modalForm").modal("show");
 
});
</script>
  