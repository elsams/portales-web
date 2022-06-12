<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\rel_tipo_item_cliente;


class Tipoitem extends Model
{
    use HasFactory;

    protected $primaryKey  = "id_tipo_item";
    protected $table  = "tipo_item";
    public $timestamps = false;

    public function getTipoItemCliente($id_empresa){
        $tipoitem = DB::select("   select ti.* , (
            select count(r.id_empresa)
            from rel_tipo_item_cliente r
            where r.id_tipo_item = ti.id_tipo_item 
            and r.id_empresa = ?
            ) as checked
            from tipo_item ti ",[$id_empresa]);

            return  $tipoitem;
    }


}
