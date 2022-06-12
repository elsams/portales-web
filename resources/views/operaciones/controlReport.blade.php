<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
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
if($Item)
{
   
    $nombre = $Item ->nombre_herramienta;
    $desc_unidad = $Item->desc_unidad;
    if($Item->numero_orden != "0"){
        $numero_orden =$Item->numero_orden;
    }else{
        $numero_orden ="Sin Orden";
    }
   
    $proveedor= $Item->nombre_fantasia;
    $modelo =$Item->cod_inventario;
    $codigo =$Item->cod_inventario;
    $numero_guia = $Item->numero_guia;
    $tiempo_solicitado =  $Item->tiempo_sol;
    $umedida = $Item->unid_medida;
    $idumedida  = $Item->id_unidad_medida;
    $km_total = $Item->km_total;
    $total_vuelta =$Item->total_vuelta;
    $horometro_total=$Item->horometro_total;
    $totalDiaSemana = $Item-> diaMesSemana;
    switch($idumedida){
    case 1: //hora
        $valorTotalMedido =$horometro_total;
        break;
    case 2: //dia    
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
<body>
<div class='container divBody' >
    <div class='row' style='text-align:center;'> 
        <h3>Control Report</h3>
    </div>
            
    <div class='row' > 

        <div class='row' style='text-align:center;'>
            <h3>Ítem : {{$Item->nombre_herramienta}} ,Marca: {{$Item->nombre_marca}} , Proveedor: {{$Item->nombre_fantasia}}</h3>        
                <input type="text" id='inpProveedor' value="{{$Item->id_proveedor}}"  style='display:none;'/>
                
        </div>
        <div class='row' style='text-align:center;'>
            <div class="col"> 
                <label for="" class="col-form-label">Tiempo Solicitado: {{$tiempo_solicitado}} {{$umedida}} 
                    , Orden de Compra: {{$numero_orden}} 
                    , Tiempo Utilizado: {{$valorTotalMedido}}  {{$umedida}} 
                </label>
                </div>
            

        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Obra</label>
                <div class="col-sm-10">
                <input type="text"  class="form-control" id="inpObra" disabled value="{{$Item->desc_cc}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Código Inventario</label>
                <div class="col-sm-10">
                <input type="text"  class="form-control" id="inpCodInventario" disabled value="{{$Item->cod_inventario}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Fecha Ingreso</label>
                <div class="col-sm-10">
                <input type="date"  max="{{ Date('Y-m-d') }}" class="form-control" id="inpFecchaIngreso" disabled value="{{$Item->fecha_ingreso}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Número Report</label>
                <div class="col-sm-10">
                <input type="text"  class="form-control" id="inpNumReport" >
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Fecha Report</label>
                <div class="col-sm-10">
                <input type="date"  max="{{ Date('Y-m-d') }}" class="form-control" id="inpFechaReport" value="{{ Date('Y-m-d') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inpLocalidad" class="col-sm-2 col-form-label">Operador</label>
                <div class="col-sm-10">
                <input type="text"  class="form-control" id="inpOperador" value="">
            </div>
        </div>
        <div class="mb-3 row">
                <label for="inpLocalidad" class="col-sm-2 col-form-label">Patente</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" disabled id="inpPatente" value="{{$Item->patente}}">
                </div>
        </div>
    </div>
    @switch($Item->id_unidad_medida)
        @case(1)<!--HORA -->
            <div class='row'>
                <h4 >Horometro</h4>
                <div class='col'>
                    <label for="inpHorometroDesde" class="col-sm-2 col-form-label">Desde</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpHorometroDesde" value="0">
                    </div>
                </div>
                <div class='col'>
                    <label for="inpHorometroHasta" class="col-sm-2 col-form-label">Hasta</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpHorometroHasta" value="0">
                    </div>
                </div>
                <div class='col'>
                    <label for="inpTotalHorometro" class="col-sm-2 col-form-label">Horas</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpTotalHorometro" value="0">
                    </div>
                </div>
            </div>
            <br>
            @break
        @case(2)<!--DIA -->
        @case(3)<!--DIA HABIL-->
              
           
            <div class='row'>
                <h4 >{{$Item->desc_unidad}}</h4>
                <div class='col'>
                    <label for="inpDia" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" placeholder='ingrese entre 0.0 y 1.0' step='0.1' id="inpDia" value="1">
                    </div>
                </div>           
              
            </div>
            @break
        @case(4)  <!--MES-->
        <div class='row'>
                <h4 >{{$Item->desc_unidad}}</h4>
                <div class='col'>
                    <label for="inpSemana" class="col-sm-2 col-form-label">Mes</label>
                    <div class="col-sm-10">
                        <input type="month"  class="form-control" placeholder='Ingrese Mes de Periodo'  id="inpMes" value="1">
                    </div>
                </div>           
              
            </div>
            @break
        @case(5)<!--SEMANA -->
            <div class='row'>
                <h4 >{{$Item->desc_unidad}}</h4>
                <div class='col'>
                    <label for="inpSemana" class="col-sm-2 col-form-label">Semana</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" placeholder='Ingrese fecha para determinar semana de ingreso'  id="inpSemana" value="1">
                    </div>
                </div>           
              
            </div>
            @break
        @case(6)<!--POR VUELTA -->
            <div class='row'>
                 <h4 >{{$Item->desc_unidad}}</h4>
                <div class='col'>
                    <label for="inpVuelta" class="col-sm-2 col-form-label">Vuelta</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" placeholder='ingrese entre 0.0 y 1.0' id="inpVuelta" value="1">
                    </div>
                </div>           
              
            </div>
            <br>
            @break
        @case(7)
        <div class='row'>
                <h4 >Kilómetros</h4>
                <div class='col'>
                    <label for="inpDesdeKm" class="col-sm-2 col-form-label">Desde</label>
                    <div class="col-sm-10">
                        <input type="input"  class="form-control numeric" id="inpDesdeKm" value="0">
                    </div>
                </div>
                <div class='col'>
                    <label for="inpHastaKm" class="col-sm-2 col-form-label">Hasta</label>
                    <div class="col-sm-10">
                        <input type="input"  class="form-control numeric" id="inpHastaKm" value="0">
                    </div>
                </div>
                <div class='col'>
                    <label for="inpTotalKm" class="col-sm-2 col-form-label">Total</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="inpTotalKm" value="0">
                    </div>
                </div>
            </div>
            @break
        @default
        @break
        @endswitch
        <br>
        <div class="form-check" id='dvMin' style='display:none;'>         
           
                        
            <div class="form-check">
                <input class="form-check-input radioMin" type="radio" checked name="radioMin" value='0' id="chkMin1">
                <label class="form-check-label" for="chkMin1" >
                    Tiempo Digitado
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input radioMin" type="radio" name="radioMin" value='1' id="chkMin2">
                <label class="form-check-label" for="chkMin2">
                    Mínimo Pre Establecido
                </label>
            </div>
           
        </div><br>
    <div class="row">
        
            <label for="inpObs" class="col-sm-2 col-form-label">Observaciones</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" id="inpObs" value="">
            </div>
    </div><br>
    <div class="row">
        
        <label for="inpDetalle" class="col-sm-2 col-form-label">Detalle de Trabajo</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control" id="inpDetalle" value="">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="form-label" for="customFile">Subir Documento </label>
        <input type="file" class="form-control btn btn-primary" accept="image/*" id="inpFile1" />
             
                            
    </div>
    <br>
    <div class="mb-3 row">
        <div class='col'> <input type='button' class='form-control btn btn-primary'  value='Guardar' id='inpGuardarRepo'/></div>

       <!-- <div class='col'> <input type='button' class='form-control'  value='Limpiar' id='inpLimpiar'/></div>-->
    
    </div>
</div>
                    

    

</div>
@include("Components/modalAlertSinDoc")
</body>
</html>
<script>
var id_obra = "{{$Item->id_obra}}";
var id_item_guia = "{{$Item->id_item_guia}}";
var urlGuardarReport  ="{{URL::asset('/report/guardarReport/')}}";
var urlTraeReportPdf = "{{URL::asset('/informes/urlTraeReportPdf')}}";
var id_unidad_medida ="{{$Item->id_unidad_medida}}";
</script>
<script src="{{URL::asset('../resources/js/viewsJs/controlReport.js?v=1.').rand()}}"> </script>