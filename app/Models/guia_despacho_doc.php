<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class guia_despacho_doc extends Model
{
    use HasFactory;
    protected $table = "guia_despacho_doc";
    protected $primaryKey  = "id_gd_doc";
    public $timestamps = false;

    public function insertBlob($id_guia,$path){
       // echo $path;
        //exit();
       /* 
        $this->pdf_doc =base64_encode(file_get_contents($path));
        $this->id_guia = $id_guia;
        $this->save();*/
        DB::table('guia_despacho_doc')->insert([
            'pdf_doc' => file_get_contents($path),
            'id_guia'=>$id_guia
        ]);
        
    }
    
}
