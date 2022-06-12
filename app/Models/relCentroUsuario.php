<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class relCentroUsuario extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_relcco";
    protected $table  = "rel_centro_costo_usuario";
    public $timestamps = false;
    


    public function creaRelacion($idCentro,$idUsuario){
        DB::table('rel_centro_costo_usuario')->insert([
            'id_usuario' => $idUsuario,
            'id_centro' => $idCentro
        ]);
        return true;
    }
}
