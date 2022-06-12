<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rel_perfil_menu;
use Illuminate\Support\Facades\DB;

class Perfil extends Model
{
    protected $primaryKey  = "id_perfil";
    protected $table  = "perfil";
    public $timestamps = false;
    use HasFactory;

    public function GuardarPerfil($id_perfil, $nombrePerfil,$descPerfil,$arrayPerfil){
        $count = Perfil::where("id_perfil",$id_perfil)->count();
        //echo $count ;
       // exit();
        $idPerfil = $id_perfil;
        if($count>0){
            $Perfil = Perfil::find($id_perfil);
            $Perfil->codigo_perfil = $nombrePerfil;
            $Perfil->descrip_perfil= $descPerfil;
            $Perfil->save();
            $idPerfil=  $Perfil->id_perfil;
        }else{
            $Perfil = new Perfil();
            $Perfil->codigo_perfil = $nombrePerfil;
            $Perfil->descrip_perfil= $descPerfil;
            $Perfil->save();
            $idPerfil=  $Perfil->id_perfil;
        }

        $Rel1 = Rel_perfil_menu::where("id_perfil",$idPerfil);
        $Rel1->delete();
        for($i=0;$i< count($arrayPerfil);$i++){
        $Rel_perfil_menu = new Rel_perfil_menu();
        $Rel_perfil_menu->id_menu= $arrayPerfil[$i];
        $Rel_perfil_menu->id_perfil= $idPerfil;
        $Rel_perfil_menu->save();
        }
        return "ok";
    }

    public function getRelMenuPerfil($id_perfil){
        $menu = DB::select("select m.id_menu ,  m.cod_menu, m.url, m.id_parent,
        m.vigencia , (select count(r.id_perfil) 
            from  rel_perfil_menu r 
            where r.id_perfil = ?
            and r.id_menu = m.id_menu	
            ) as checked 
        from menu m ",[$id_perfil]);
        
        return $menu;
    }
}
