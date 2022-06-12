<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rel_tipo_item_cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey  = "id";
    protected $table  = "rel_tipo_item_cliente";

    public function __construct()
    {
        
    }

    public function guardarPermisosItems($id_empresa, $arrayTipoItem){
        

        //$Rel1 = new rel_tipo_item_cliente();
        //$Rel = $Rel1->where("id_empresa",$id_empresa);
        $Rel=$this::where("id_empresa",$id_empresa);
        $Rel->delete();

        for($i=0;$i< count($arrayTipoItem);$i++){
            $rel_tipo_item_cliente = new rel_tipo_item_cliente();
            $rel_tipo_item_cliente->id_tipo_item= $arrayTipoItem[$i];
            $rel_tipo_item_cliente->id_empresa= $id_empresa;
            $rel_tipo_item_cliente->save();
            }
        return "true";
    }
}
