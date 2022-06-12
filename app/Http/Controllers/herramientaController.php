<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Tipoitem;


class herramientaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Herrmienta  $herrmienta
     * @return \Illuminate\Http\Response
     */
    public function show(Herrmienta $herrmienta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Herrmienta  $herrmienta
     * @return \Illuminate\Http\Response
     */
    public function edit(Herrmienta $herrmienta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Herrmienta  $herrmienta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Herrmienta $herrmienta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Herrmienta  $herrmienta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Herrmienta $herrmienta)
    {
        //
    }


    public function mantHerramienta(Request $r){
        $herramienta = new Herramienta();
        $herramientas  = $herramienta->getHerramientas();
        $marcas = Marca::all();
        $TipoItems = Tipoitem::all();
        $isModal=0;
        if(isset($r->isModal)){
            $isModal=1;
        }
        $tipo =1;
        return view("mantenedores.mantHerramienta",["herramientas"=>$herramientas,"marcas"=>$marcas,"tipoItems"=>$TipoItems,"tipo"=> $tipo,"isModal"=>$isModal]);
    }
    public function getTblHerramientas(){
        $herramienta = new Herramienta();
        $herramientas  = $herramienta->getHerramientas();
        $tipo =1;
        return view('Components.tblHerramienta',["herramientas"=>$herramientas,"tipo"=>$tipo]);

    }

    public function eliminaHerramienta(Request $r){
            $Herramienta = Herramienta::find($r->id_herramienta);
            $Herramienta->delete();
            return "true";
    }

    public function guardarherramienta(Request $r){

        $cntHerr = Herramienta::where("id_herramienta",$r->id_herramienta)->count();
        $idHerramienta= 0;
        $response =null;
        if($cntHerr>0){
            $herramienta = Herramienta::where("id_herramienta",$r->id_herramienta)->first();
            $herramienta->nombre_herramienta=$r->nombre_herramienta;
            $herramienta->detalle_herramienta=$r->detalle_herramienta;
            $herramienta->id_marca=$r->id_marca;
            $herramienta->modelo=$r->modelo;
            $herramienta->observacion=$r->observacion;
            $herramienta->id_item=$r->id_item;
            $herramienta->save();
            $idHerramienta= $herramienta->id_herramienta;
        }else{
            $herramienta = new Herramienta();
            $herramienta->nombre_herramienta=$r->nombre_herramienta;
            $herramienta->detalle_herramienta=$r->detalle_herramienta;
            $herramienta->id_marca=$r->id_marca;
            $herramienta->modelo=$r->modelo;
            $herramienta->observacion=$r->observacion;
            $herramienta->id_item=$r->id_item;
            $herramienta->save();
            $idHerramienta= $herramienta->id_herramienta;
        }

        $response["id"] =$idHerramienta;
        $response["nombre_herramienta"] =$herramienta->nombre_herramienta;
        $response["response"] ="true";
        return  $response;
    }

    public function getTblHerramientasXProveedor($id_proveedor){
        $herramienta = new Herramienta();
        $herramientas  = $herramienta->getHerramientas();
        $tipo = 2;//2 Ingreso Guia
        return view('Components.tblHerramienta',["herramientas"=>$herramientas,"tipo"=>$tipo]);

        
    }

    public function getTblHerramientasCliente($id_empresa){
        $herramienta = new Herramienta();
        $herramientas  = $herramienta->getHerramientasXCliente($id_empresa);
        $tipo = 2;//2 Ingreso Guia
        return view('Components.tblHerramienta',["herramientas"=>$herramientas,"tipo"=>$tipo]);

    }
}
