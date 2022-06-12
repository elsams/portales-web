<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_costo_token extends Model
{
    use HasFactory;
    protected $table = "centro_costo_token";
    protected $primaryKey  = "id_ctoken";
    public $timestamps = false;
}
