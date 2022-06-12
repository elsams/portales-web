<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $primaryKey  = "id_unidad_medida";
    protected $table  = "unidad_medida";
    public $timestamps = false;
    use HasFactory;
}
