<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;


class marcaController extends Controller
{
    //
    public function mantMarca(){
        $marcas = Marca::all();
        
        return view("mantenedores/mantMarca", ["marcas"=>$marcas]);
    }

    public function guardarMarca(Request $request){
        $count = Marca::where('id_marca', $request->id_marca)->count();
        if($count>0){
            $Marca = Marca::find( $request->id_marca);
            $Marca->nombre_marca = $request->nombre_marca;
            $Marca->save();
        }else{
            $Marca =new Marca();
            $Marca->nombre_marca = $request->nombre_marca;
            $Marca->save();
        }
        return "true";
    }
    public function getTblMarcas(){
        $Marcas = Marca::all();
        return view("Components.tblMarca" ,["marcas"=> $Marcas ]);
    }
    
    public function eliminarMarca(Request $request){
        $Marca = Marca::find( $request->id_marca);
        $Marca->delete();

        return "true";
    }
}
