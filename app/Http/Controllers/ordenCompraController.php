<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\CentroCosto;
use App\Models\Empresa;
use App\Models\TipoDocumento;
use App\Models\UnidadMedida;
use App\Models\ItemOrdenCompra;
use App\Models\Fpdf;

class ordenCompraController extends Controller
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
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenCompra $ordenCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenCompra $ordenCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenCompra $ordenCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenCompra $ordenCompra)
    {
        //
    }

    public function creaOrden($id_centro,$menu){
        $proveedores = Proveedor::all();
        $centroCosto = CentroCosto::find($id_centro);
        $NombreCentro= $centroCosto["desc_cc"];
        $tipo_documento = TipoDocumento::all();
        $unidad_medida = UnidadMedida::all();
        return view('operaciones/operacionOrden',["id_centro"=>$id_centro,'nombre_centro'=>$NombreCentro,
        'proveedores'=> $proveedores,'tipo_documento'=>$tipo_documento,'menu'=>$menu,'unidadesMedida'=> $unidad_medida]);
    }

    public function trDetalleOrden($row){

        $unidadesMedida = UnidadMedida::all();
        $disabled = "";
        return view('Components.trDetalleOrden',["cnt"=>$row,"unidadesMedida"=>$unidadesMedida,"disabled"=>""]);
    }

    public function guardaOrden(Request $r){

        $id_estado = 1; // 1 ingresado

        $cabecera =json_decode($r->orden);
        $detalle =json_decode($r->detalle);

       // $cabecera =$r->orden;
        //$detalle =$r->detalle;
        //var_dump($cabecera);
        
        $OrdenCompra = new OrdenCompra();
        $OrdenCompra->numero_orden = $cabecera->orden_compra;
        $OrdenCompra->fecha_emision = $cabecera->FechaEmision;
        $OrdenCompra->fecha_recepcion = $cabecera->FechaRecepcion;
        $OrdenCompra->id_proveedor = $cabecera->id_proveedor;
        $OrdenCompra->id_obra = $cabecera->id_obra;
        $OrdenCompra->id_tipo_doc =$cabecera->id_tipo_doc;
        $OrdenCompra->id_estado = $id_estado;
        $OrdenCompra->save();
        $id_orden= $OrdenCompra->id_orden_compra;
        foreach($detalle as $itemDetalle )
        {
                $item= new ItemOrdenCompra();
                $item->id_proveedor=$itemDetalle->id_proveedor;
                $item->id_item=$itemDetalle->id_item;//id herramienta                
                $item->total_item=$itemDetalle->total_item;
                $item->total_unitario=$itemDetalle->total_unitario;
                $item->tiempo_sol=$itemDetalle->tiempo;        
                $item->cantidad_sol=  $itemDetalle->cantidad;
                $item->id_orden = $id_orden;
                $item->id_unidad_medida = $itemDetalle->id_unidad_medida;
                $item->cantidad_min= $itemDetalle->min_unidad_medida;
                $item->save();
        }

        if($r->imagen!=="")
        {
            $file=$r->imagen;
            $Name=  $file->getClientOriginalName();
            $tmpName = $file->getPathName();
    
          
             $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_ORDEN');
     
             $target_file = $target_dir . basename($Name);
          
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
     
            $fpdf->Output('F',$target_dir.$id_orden.'.pdf',false);
        }

        return "true";
    }


    public function ListadoOrdenes($id_orden){
        $orden_compra = new OrdenCompra();
        $ordenes = $orden_compra->ListadoOrdenes($id_orden);

        return view('Components/tblOrdenesCompra',["ordenes"=> $ordenes ]);
    }

    public function TraeOrdenRecep($id_orden){
        $orden_compra = new OrdenCompra();
        $orden = $orden_compra->find($id_orden);

        return $orden;

    }

    public function TraeDetalleOrdenRecep($id_orden){
        $orden_compra = new OrdenCompra();
        $itemOrden = $orden_compra->GetDetalleOrden($id_orden);
        $unidad_medida = UnidadMedida::all();
        return view('Components/tblDetalleOrdenRecep',["itemOrden"=> $itemOrden,"unidadesMedida"=> $unidad_medida]);
    }

    public function getOrdenes($id_empresa){

        //$guias =  GuiaDespacho::all();
        $OrdenCompra = new OrdenCompra();
        $Ordenes =$OrdenCompra->resumenOrdenes($id_empresa);
        //var_dump($guias);
        return view('Components/tblOrdenes',["ordenes"=>$Ordenes]);
    }

    public function urlTraeOrdenPdf($id_orden){
        $result = 0;      
        $target_dir  =$_SERVER['DOCUMENT_ROOT'].env('URL_ORDEN').$id_orden.".pdf";
        
        header('Content-type: application/pdf');    
        header('Content-Disposition: inline; filename="archivo.pdf"');    
        header('Content-Transfer-Encoding: binary');    
        header('Accept-Ranges: bytes');
        @readfile($target_dir);
     
    }
    
}
