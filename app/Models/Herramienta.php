<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Herramienta extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_herramienta";
    protected $table  = "herramientas";
    public $timestamps = false;

    public function getHerramientas(){

        $Herramientas = DB::select("select h.* , m.nombre_marca ,ti.descrip_tipo 
        from herramientas h
        join marca m on m.id_marca = h.id_marca
        join tipo_item ti  on ti.id_tipo_item = h.id_item 
        ");

        return $Herramientas;
    }
    public function getHerramientasXCliente($id_cliente){

        $Herramientas = DB::select("select h.* , m.nombre_marca ,ti.descrip_tipo 
        from herramientas h
        join marca m on m.id_marca = h.id_marca
        join rel_tipo_item_cliente ri on ri.id_tipo_item  =h.id_item 
        join tipo_item ti  on ti.id_tipo_item = h.id_item 
        where ri.id_empresa = ?",[$id_cliente]);

        return $Herramientas;
    }

    public function getHerramientasXProveedor($id_proveedor){

        $Herramientas = DB::select("select h.* , m.nombre_marca from herramientas h
        join marca m on m.id_marca = h.id_marca
        where h.id_proveedor = ?",[$id_proveedor]);

        return $Herramientas;
    }
}
