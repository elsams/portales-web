<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrdenCompra extends Model
{
    use HasFactory;
    protected $primaryKey  = "id_item_oc";
    protected $table  = "item_orden_compra";
    public $timestamps = false;
}
