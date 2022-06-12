<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rel_contacto_cli_proveedor extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_relc";
    protected $table  = "rel_contacto_cli_proveedor";
    public $timestamps = false;
}
