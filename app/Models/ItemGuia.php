<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemGuia extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_item_guia";
    protected $table  = "item_guia_despacho";
    public $timestamps = false;

    public function getItemsByCentro($id_centro){
        $Items = DB::select("select i.* , h.nombre_herramienta ,p.nombre_fantasia , gd.numero_guia ,gd.orden_compra,gd.fecha_ingreso 
        from item_guia_despacho i
         join herramientas h  on h.id_herramienta  = i.id_item 
         join proveedor p  on p.id_proveedor  = i.id_proveedor 
         join guia_despacho gd  on gd.id_guia  = i.id_guia 
         where gd.id_obra  =  ?
         order by gd.fecha_ingreso desc
         ",[$id_centro]);

        return $Items;

    }

    public function getItemsById($id_centro){
        $Items = DB::select("select i.* ,
        h.nombre_herramienta ,p.nombre_fantasia , gd.numero_guia ,gd.orden_compra,gd.fecha_ingreso 
        ,m.nombre_marca , gd.fecha_ingreso , cc.desc_cc  ,cc.id_centro ,i.id_unidad_medida,gd.id_obra
        , r.horometro_hasta as horometro_hasta_anterior
        , ifnull(r.horario_hasta,0) as  horario_hasta_anterior
        , ifnull(r.km_hasta,0)  as  km_hasta_anterior
        , r.fecha_report  as fecha_report_anterior
        , um.desc_unidad, p.id_proveedor
        ,um.unid_medida 
        ,ifnull((select sum(ifnull(co.km_total,0)) from control_report co 
        where co.id_item = r.id_item 
        ) ,0) km_total
        ,ifnull((select sum(ifnull(co.vuelta,0)) from control_report co 
        where co.id_item = r.id_item 
        ),0) as total_vuelta,
        ifnull((select sum(ifnull(co.horometro_total ,0)) from control_report co 
        where co.id_item = r.id_item 
        ),0) as horometro_total,
        ifnull( (select sum(ifnull(co.diaMesSemana ,0)) from control_report co 
        where co.id_item = r.id_item 
         ),0) as diaMesSemana
        ,ifnull(oc.numero_orden,0) as numero_orden
        ,ifnull(io.tiempo_sol,0) as tiempo_sol
         from item_guia_despacho i
        join herramientas h  on h.id_herramienta  = i.id_item 
        join proveedor p  on p.id_proveedor  = i.id_proveedor 
        join guia_despacho gd  on gd.id_guia  = i.id_guia 
        join marca m on  m.id_marca  = h.id_marca 
        join centro_costo cc  on cc.id_centro  = gd.id_obra 
        join unidad_medida um on um.id_unidad_medida = i.id_unidad_medida
        left join control_report r 
        on r.id_item = i.id_item_guia   
        and r.id_control =( select max(id_control) 
        from control_report where id_item = i.id_item_guia)
        left  join item_orden_compra io on io.id_item_oc = i.id_item_oc 
	    left join orden_compra  oc on oc.id_orden_compra  = io.id_orden
         where i.id_item_guia  =  ?",[$id_centro]);

        return $Items;

    }
    
}
