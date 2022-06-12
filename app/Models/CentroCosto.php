<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CentroCosto extends Model
{
    use HasFactory;
    protected $table = "centro_costo";
    public $timestamps = false;
    protected $primaryKey  = "id_centro";
    


    public function GuardarCentro($desc_cc, $localidad,$id_empresa,$vigencia,$principal,$id_centro){

        $Existe =  $this->where("id_centro",$id_centro)->count();

        if($Existe>0){
            $Ccosto = CentroCosto::find($id_centro);
            $Ccosto->desc_cc = $desc_cc;
            $Ccosto->localidad = $localidad;
            $Ccosto->vigencia = $vigencia;
            $Ccosto->principal = $principal;
            $Ccosto->save();

        }else{
            $this->desc_cc = $desc_cc;
            $this->localidad = $localidad;
            $this->id_empresa = $id_empresa;
            $this->vigencia = $vigencia;
            $this->principal = $principal;
            $this->save();
        }
        return "true";
    
    }

    public function CentrosPorUsuario($idUsuario){
        $Centros = DB::select("select cc.*
        from centro_costo cc 
        join rel_centro_costo_usuario rccu on rccu.id_centro  = cc.id_centro 
        where rccu.id_usuario = ?",[$idUsuario]);

        return $Centros;
    }

    public function UsuariosPorCentro($id_centro){
        $Users = DB::select("select u.*, cc.id_empresa , cc.desc_cc
        from usuario u 
        join rel_centro_costo_usuario rccu on rccu.id_usuario  = u.id 
        join centro_costo cc on cc.id_centro = rccu.id_centro
        where rccu.id_Centro = ?",[$id_centro]);

        return $Users;
        
    }

    


}
