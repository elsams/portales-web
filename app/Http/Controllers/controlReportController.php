<?php

namespace App\Http\Controllers;

use App\Models\ControlReport;
use Illuminate\Http\Request;
use App\Models\ItemGuia;
use App\Models\Fpdf;

class controlReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlReport  $controlReport
     * @return \Illuminate\Http\Response
     */
    public function show(ControlReport $controlReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControlReport  $controlReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlReport $controlReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControlReport  $controlReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlReport $controlReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlReport  $controlReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlReport $controlReport)
    {
        //
    }

    public function getControlReport($id_guiadet){

        $itemGuia = new ItemGuia();

        $item = $itemGuia->getItemsById($id_guiadet);

        return view('operaciones.controlReport',["Item"=>$item[0]]);
    }

    public function getHistoryReport($id_guiadet){

        $ControlReport = new ControlReport();

        $Reportes = $ControlReport->getReportsHistory($id_guiadet);

        return view('operaciones.historyReport',["Reportes"=>$Reportes]);
    }

    public function guardarReport(Request $r)
    {
        $response["response"] ="true";
        $response["mensaje"]="Datos ingresados exitosamente";

        $Control = new ControlReport();

        $existe = $Control->verificaReportProveedor($r->NumReport ,$r->idProveedor);
        if($existe>0){
            $response["response"] ="false";
            $response["mensaje"]="Este Report ya ha sido ingresado";
            return $response;
        }
        $Control->id_item = $r->id_item;
        $Control->num_report = $r->NumReport;
        $Control->fecha_report = $r->FechaReport;
        $Control->operador = $r->Operador;

        $Control->horometro_desde = $r->HorometroDesde;
        $Control->horometro_hasta = $r->HorometroHasta;
        $Control->horometro_total = $r->TotalHorometro;
        
        
        $Control->diaMesSemana = $r->diaMesSemana;
       // $Control->horario_desde = $r->Desde;
        //$Control->horario_hasta = $r->Hasta;
        //$Control->horario_total = $r->TotalHrs;

        $Control->km_desde = $r->DesdeKm;
        $Control->km_desde = $r->HastaKm;
        $Control->km_total = $r->TotalKm;
        $Control->opt_minimo = $r->opt_minimo;


        $Control->observaciones = $r->observacion;
        $Control->detalle_trabajo = $r->detalle_trabajo;

        $Control->vuelta = $r->Vuelta;
        $Control->save();
        $id_report = $Control->id_control;
        if($r->imagen!==""  && $r->imagen!==null)
        {
            $file=$r->imagen;
            $Name=  $file->getClientOriginalName();
            $tmpName = $file->getPathName();
    
          
             $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_REPORT');
     
             $target_file = $target_dir . basename($Name);
            // echo $target_file;
             $imageFile =$tmpName;
     
            $rotatedImg =null;
     
                if (move_uploaded_file($imageFile , $target_file)) {
               // echo "imagen subida exitosamente";
                } else {
               // echo "La imagen no ha sido subida";
                }
    
    
            $fpdf= new Fpdf;
            $fpdf->AddPage();
            $fpdf->SetFont('Courier', 'B', 18);
    
            $fpdf->Image($target_file,10,10,190,190);
     
            $fpdf->Output('F',$target_dir.$id_report.'.pdf',false);
        }
        
        return $response;
        
    }

    public function urlTraeReportPdf($id_report){
        $result = 0;      
        $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_REPORT').$id_report.".pdf";
        
        header('Content-type: application/pdf');    
        header('Content-Disposition: inline; filename="archivo.pdf"');    
        header('Content-Transfer-Encoding: binary');    
        header('Accept-Ranges: bytes');
        @readfile($target_dir);
     
    }

}
