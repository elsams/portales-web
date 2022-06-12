<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdenCompra extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_orden_compra";
    protected $table  = "orden_compra";
    public $timestamps = false;

    public function ListadoOrdenes($id_centro){
        $querOrdenes = DB::select("select oc.*, cc.desc_cc , p.nombre_fantasia , td.desc_tipo_doc
        from orden_compra oc 
        join centro_costo cc  on cc.id_centro  = oc.id_obra 
        join proveedor p  on p.id_proveedor = oc.id_proveedor 
        join tipo_documento td  on td.id_tipo_doc =oc.id_tipo_doc
        where oc.id_obra = ?
        order by oc.numero_orden desc
        ",[$id_centro]);
        
        return $querOrdenes;
    }

    public function GetDetalleOrden($id_orden){
        $querOrdenes = DB::select("select ioc.*,h.nombre_herramienta ,um.desc_unidad ,
         ioc.cantidad_min,h.modelo ,
         ifnull((select sum(igd.cantidad) 
		from item_guia_despacho igd 
		where igd.id_item_oc = ioc.id_item_oc),0) as recepcionado
        from item_orden_compra ioc 
        join herramientas h  on h.id_herramienta  =ioc.id_item 
        join unidad_medida um  on um.id_unidad_medida =ioc.id_unidad_medida 
        where ioc.id_orden= ?
        ",[$id_orden]);
        
        return $querOrdenes;

    }

    public function resumenOrdenes($id_empresa){
        $sql =  " select oc.* , p.nombre_fantasia , cc.desc_cc , td.desc_tipo_doc
            from orden_compra oc 
            join proveedor p on p.id_proveedor =oc.id_proveedor 
            join centro_costo cc  on cc.id_centro = oc.id_obra 
            join tipo_documento td  on td.id_tipo_doc =oc.id_tipo_doc 
            where cc.id_empresa = ?
            ";

            $Ordenes = DB::select($sql,[$id_empresa]);

        return $Ordenes;

    }

}
