<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ControlReport extends Model
{
    use HasFactory;
    protected $table = "control_report";
    protected $primaryKey  = "id_control";
    public $timestamps = false;
    
    
    public function getReportsHistory($idItemGuia){
        
        $sql = "select h.id_herramienta ,h.nombre_herramienta ,igd.id_unidad_medida,gd.id_obra ,
        um.desc_unidad ,cr.*, ifnull(oc.numero_orden,0) as numero_orden, p.nombre_fantasia, h.modelo,igd.cod_inventario
        ,gd.numero_guia,ioc.tiempo_sol ,um.unid_medida 
        ,(select sum(ifnull(co.km_total,0)) from control_report co 
        where co.id_item = cr.id_item 
        ) as km_total
        ,(select sum(ifnull(co.vuelta,0)) from control_report co 
        where co.id_item = cr.id_item 
        ) as total_vuelta,
        (select sum(ifnull(co.horometro_total ,0)) from control_report co 
        where co.id_item = cr.id_item 
        ) as horometro_total,
        (select sum(ifnull(co.diaMesSemana ,0)) from control_report co 
        where co.id_item = cr.id_item 
        ) as diaMesSemana
        from control_report cr 
        join item_guia_despacho igd   on igd.id_item_guia =  cr.id_item
        join herramientas h  on h.id_herramienta  = igd.id_item 
        join guia_despacho gd  on igd.id_guia  = gd.id_guia 
        join unidad_medida um  on um.id_unidad_medida = igd.id_unidad_medida 
        left join item_orden_compra ioc on ioc.id_item_oc = igd.id_item_oc
        left join orden_compra oc on oc.id_orden_compra = ioc.id_orden
        join proveedor p  on p.id_proveedor  = gd.id_proveedor 
        where igd.id_item_guia = ?";

        $Reports = DB::select($sql,[$idItemGuia]);
        return $Reports;
    }
    public function verificaReportProveedor($num_report, $id_proveedor){
        $sql = " select   count(1)  as existe       
           from control_report r
           join item_guia_despacho igd  on r.id_item = igd.id_item_guia 
           join guia_despacho gd  on gd.id_guia =igd.id_guia 
           where gd.id_proveedor =?
           and r.num_report = ?";

        $existe = DB::select($sql,[$id_proveedor,$num_report]);
        //var_dump($existe[0]->existe);
        //exit();
        return $existe[0]->existe;
    }
}
