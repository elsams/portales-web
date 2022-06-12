<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contacto extends Model
{
    use HasFactory;
    protected $table = "Contacto";
    protected $primaryKey  = "id_contacto";
    public $timestamps = false;

    public function getContactos(){
        $contactos = DB::select("select co.* ,ifnull(p.id_proveedor ,0) as id_proveedor , 0 as id_empresa
        , ifnull(p.nombre_fantasia,'S/P') as nombre_fantasia 
        from contacto co
        join proveedor p on p.id_proveedor  = co.id_proveedor");

        return $contactos;
        

    }
    public function createContacto($id_contacto,$nombres,$apellido_paterno,$apellido_materno,
     $rut_contacto,$provincia_id,$id_cargo,$id_proveedor, $contacto1, $contacto2, $contacto3,$email1,$email2, $direccion)
     {
        $Count  = Contacto::where("id_contacto",$id_contacto)->count();
       
        if($Count>0){
            $contacto = Contacto::find($id_contacto);
            $contacto->nombres = $nombres;
            $contacto->apellido_paterno = $apellido_paterno;
            $contacto->apellido_materno = $apellido_materno;
            $contacto->rut_contacto = $rut_contacto;
            $contacto->provincia_id = $provincia_id;
            $contacto->id_cargo = $id_cargo;
            $contacto->id_proveedor = $id_proveedor;
            $contacto->contacto1 = $contacto1;
            $contacto->contacto2 = $contacto2;
            $contacto->contacto3 = $contacto3;
            $contacto->email1 = $email1;
            $contacto->email2 = $email2;
            $contacto->direccion = $direccion;
            $contacto->save();
        }else{
            $contacto = new Contacto();
            $contacto->nombres = $nombres;
            $contacto->apellido_paterno = $apellido_paterno;
            $contacto->apellido_materno = $apellido_materno;
            $contacto->rut_contacto = $rut_contacto;
            $contacto->provincia_id = $provincia_id;
            $contacto->id_cargo = $id_cargo;
            $contacto->id_proveedor = $id_proveedor;
            $contacto->contacto1 = $contacto1;
            $contacto->contacto2 = $contacto2;
            $contacto->contacto3 = $contacto3;
            $contacto->email1 = $email1;
            $contacto->email2 = $email2;
            $contacto->direccion = $direccion;
            $contacto->save();
        }
        
    }
    public function getContactoCliente(){
        $contactos = DB::select("select co.* ,ifnull(p.id_proveedor ,0) as id_proveedor
        , ifnull(p.nombre_fantasia,'S/P') as nombre_fantasia 
        from contacto co
        left join rel_contacto_cli_proveedor rc on rc.id_contacto = co.id_contacto 
        left join proveedor p on p.id_proveedor  = co.id_proveedor
        where ifnull(rc.id_empresa,0) in (1,0)");

        return $contactos;
    }

    public function getContactosXProveedor($id_proveedor){
        $contactos = DB::select("select co.* ,ifnull(p.id_proveedor ,0) as id_proveedor
        , ifnull(p.nombre_fantasia,'S/P') as nombre_fantasia ,ifnull(rc.id_empresa,0) as id_empresa
        from contacto co
        join proveedor p on p.id_proveedor  = co.id_proveedor
        left join rel_contacto_cli_proveedor rc on rc.id_contacto = co.id_contacto         
        where ifnull(p.id_proveedor,0) in (?,0)",[$id_proveedor]);

        return $contactos;

    }



}
