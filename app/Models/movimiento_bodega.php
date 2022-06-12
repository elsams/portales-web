<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento_bodega extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_movimiento";
    protected $table  = "movimiento_bodega";
    public $timestamps = false;
    
}
