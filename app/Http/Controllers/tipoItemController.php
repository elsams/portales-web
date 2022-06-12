<?php

namespace App\Http\Controllers;

use App\Models\Tipoitem;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\rel_tipo_item_cliente;

class tipoItemController extends Controller
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
     * @param  \App\Models\Tipoitem  $tipoitem
     * @return \Illuminate\Http\Response
     */
    public function show(Tipoitem $tipoitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipoitem  $tipoitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipoitem $tipoitem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipoitem  $tipoitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipoitem $tipoitem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipoitem  $tipoitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipoitem $tipoitem)
    {
        //
    }


    public function mantPlanItem(){

        if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
        $Empresas = Empresa::all();

        $TipoItem = Tipoitem::all();

        return view("mantenedores/mantPlan",["empresa"=>$Empresa,
        "Empresas"=>$Empresas,
        "tipoItem"=> $TipoItem]);
    }

    public function guardarPermisosItems(Request $r){
       $Tipoitem = new rel_tipo_item_cliente();
       
       $Tipoitem->guardarPermisosItems($r->id_empresa, $r->ArrItems);

       return "true";
        
    }

    
    public function getTipoItemCliente($id_empresa){
        $TipoItem = new Tipoitem();
        $ItemCiente= $TipoItem->getTipoItemCliente($id_empresa);

        return  view("Components/tblTipoItem",["tipoItem"=>$ItemCiente]);
    }
}
