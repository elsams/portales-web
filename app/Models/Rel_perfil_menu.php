<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rel_perfil_menu extends Model
{
    public $timestamps = false;
    protected $primaryKey  = "id_rel_perfil_menu";
    protected $table  = "rel_perfil_menu";
    
    use HasFactory;
}
