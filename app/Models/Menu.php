<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_menu";
    protected $table  = "menu";
    public $timestamps = false;
    public function getAllMenu(){
       $menu = Menu::all();
       return $menu;
    }

  
    public function getPerfilMenu($id_perfil){
        $menuItemP = DB::select("select m.id_menu ,  m.cod_menu, m.url, m.id_parent,
        m.vigencia 
        from menu m 
        join rel_perfil_menu rp on rp.id_menu = m.id_menu
        join perfil p on p.id_perfil = rp.id_perfil
        where p.id_perfil = ? and  ifnull(m.id_parent,0) =0
        order by id_menu asc
        ",[$id_perfil]);

        $menuItemH = DB::select("select m.id_menu ,  m.cod_menu, m.url, m.id_parent,
        m.vigencia 
        from menu m 
        join rel_perfil_menu rp on rp.id_menu = m.id_menu
        join perfil p on p.id_perfil = rp.id_perfil
        where p.id_perfil = ? and  ifnull(m.id_parent,0) <>0
        order by id_parent asc
        ",[$id_perfil]);

        
        for($i =0 ;$i< count($menuItemP);$i++){
            for($b=0;$b<count($menuItemH);$b++)
            {
                if($menuItemH[$b]->id_parent==$menuItemP[$i]->id_menu )
                {
                    $menuItemP[$i]->hijos[]=$menuItemH[$b]; 
                }
               
            }           
        }
                
        return $menuItemP;
    }
}
