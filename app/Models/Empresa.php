<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    use HasFactory;
    protected $table = "empresa";
    protected $primaryKey  = "id_empresa";
    public $timestamps = false;

    public function getTblEmpresas(){
        $Empresas = DB::select("select e.* , ua.id_usuario 
        from empresa e 
        left join user_admin ua on ua.id_empresa  = e.id_empresa");

        return $Empresas;
    }
}
