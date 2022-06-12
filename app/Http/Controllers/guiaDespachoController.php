<?php

namespace App\Http\Controllers;

use App\Models\GuiaDespacho;
use Illuminate\Http\Request;
use App\Models\ItemGuia;
use App\Models\UnidadMedida;
use App\Models\Fpdf;
use App\Models\guia_despacho_doc;
use App\Models\movimiento_bodega;

class guiaDespachoController extends Controller
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
     * @param  \App\Models\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function show(GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function edit(GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuiaDespacho $guiaDespacho)
    {
        //
    }
    
        
       
    
    public function guardarGuia(Request $request)
    {

        $id_estado = 1; // 1 ingresado
        $cabecera =json_decode($request->guia);
        $detalle =json_decode($request->detalle);
        //var_dump($request->imagen);
        $response["response"] ="true";
        $response["mensaje"] ="Datos Guardados Correctamente";
        $num_orden =null;
        if( $cabecera->orden_compra !== ""){$num_orden =$cabecera->orden_compra;}
        $GuiaDespacho = new GuiaDespacho();
        $existeRecepcion= $GuiaDespacho->verificaGuiaProveedor($cabecera->numero_guia, $cabecera->id_proveedor);

        //echo $existeRecepcion;
        if($existeRecepcion >0){
            $response["response"] ="false";
            $response["mensaje"] ="Esta Número de documento ya fue ingresado";
            return $response;
        }
        $GuiaDespacho->numero_guia = $cabecera->numero_guia;
        $GuiaDespacho->orden_compra = $cabecera->orden_compra;
        $GuiaDespacho->fecha_ingreso = $cabecera->fecha_ingreso;
        $GuiaDespacho->id_proveedor = $cabecera->id_proveedor;
        $GuiaDespacho->id_obra = $cabecera->id_obra;
        $GuiaDespacho->id_tipo_doc =$cabecera->id_tipo_doc;
        $GuiaDespacho->id_estado_guia = $id_estado;
        $GuiaDespacho->save();
        $id_guia= $GuiaDespacho->id_guia;
        $tipo_movimiento = 1;
        foreach($detalle as $itemDetalle )
        {
                $item= new ItemGuia();
                $item->id_proveedor=$itemDetalle->id_proveedor;
                $item->id_item=$itemDetalle->id_item;//id herramienta
                //$item->lote=$itemDetalle->lote;
                $item->valor_ingreso=$itemDetalle->valor_ingreso;
                $item->cantidad=  $itemDetalle->cantidad;
                $item->cod_inventario = $itemDetalle->cod_inventario;
                $item->codigo_pal = $itemDetalle->cod_pal;
                $item->id_guia = $id_guia;
                $item->id_unidad_medida = $itemDetalle->id_unidad_medida;
                $item->min_unidad_medida = $itemDetalle->min_unidad_medida;
                if($itemDetalle->data_item_oc ==""){$itemDetalle->data_item_oc=null;}
                $item->id_item_oc = $itemDetalle->data_item_oc;
                $patente=null;
                if( $itemDetalle->patente !=""){
                    $patente=$itemDetalle->patente;
                }

                $item->patente = $itemDetalle->patente;
                


                $item->save();
                $id_item_guia = $item->id_item_guia;

                $movimiento= new movimiento_bodega();
                $movimiento->id_item_guia =  $id_item_guia;
                $movimiento->id_tipo_movimiento = $tipo_movimiento;
                $movimiento->cantidad =$item->cantidad;
                $movimiento->id_unidad_medida =$item->id_unidad_medida;
                $movimiento->fecha_movimiento=$GuiaDespacho->fecha_ingreso;
                //$movimiento->lote=$item->lote;
                $movimiento->id_herramienta =$item->id_item ;
                $movimiento->save();
        }
        
        if($request->imagen!==""  && $request->imagen!==null)
        {
            $file=$request->imagen;
            $Name=  $file->getClientOriginalName();
            $tmpName = $file->getPathName();
    
          
             $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_GUIAS');
     
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
     
            $fpdf->Output('F',$target_dir.$id_guia.'.pdf',false);
        }


        return $response;
        
    }

    public function trDetalleGuia($row){
        $unidadesMedida = UnidadMedida::all();
        return view('Components.trDetalleGuia',["cnt"=>$row,"unidadesMedida"=>$unidadesMedida]);
    }

    public function getGuias(Request $r){

        //$guias =  GuiaDespacho::all();
        $GuiaDespacho = new GuiaDespacho();
        $Guias =$GuiaDespacho->resumenGuias();
        //var_dump($guias);
        return view('Components/tblGuias',["guias"=>$Guias]);
    }
    
    public function urlTraeGuiaPdf($id_guia){
        $result = 0;      
        $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_GUIAS').$id_guia.".pdf";
        
        header('Content-type: application/pdf');    
        header('Content-Disposition: inline; filename="archivo.pdf"');    
        header('Content-Transfer-Encoding: binary');    
        header('Accept-Ranges: bytes');
        @readfile($target_dir);
     
    }

    public function getGuiaInforme($id_guia){

        
        $GuiaDespacho =  GuiaDespacho::find($id_guia);
        
        $item=  ItemGuia::where("id_guia",$id_guia);
    }
}
