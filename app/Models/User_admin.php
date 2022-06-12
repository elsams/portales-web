<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_admin extends Model
{
    protected $primaryKey  = "id_admin";
    protected $table  = "user_admin";
    public $timestamps = false;
    use HasFactory;

   
}
