<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuiaDespacho extends Model
{
    use HasFactory;
    protected $table = "guia_despacho";
    protected $primaryKey  = "id_guia";
    public $timestamps = false;

    public function resumenGuias(){
        $sql = "select 
        g.* , p.nombre_fantasia , cc.desc_cc , td.desc_tipo_doc 
        from guia_despacho g
        join proveedor p  on p.id_proveedor  = g.id_proveedor 
        join centro_costo cc on cc.id_centro = g.id_obra 
        join tipo_documento td on td.id_tipo_doc  = g.id_tipo_doc 
        order by g.fecha_ingreso desc";

        $Guias = DB::select($sql);

        return $Guias;

    }

    public function verificaGuiaProveedor($num_guia, $id_proveedor){
        $sql = "select   count(1)  as existe
        from guia_despacho g
        where g.id_proveedor =?
        and g.numero_guia = ?";

        $existe = DB::select($sql,[$id_proveedor,$num_guia]);
        //var_dump($existe[0]->existe);
        //exit();
        return $existe[0]->existe;
    }
}
