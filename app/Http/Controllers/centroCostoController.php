<?php

namespace App\Http\Controllers;

use App\Models\CentroCosto;
use Illuminate\Http\Request;
use App\Models\Empresa;


class centroCostoController extends Controller
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
     * @param  \App\Models\CentroCosto  $centroCosto
     * @return \Illuminate\Http\Response
     */
    public function show(CentroCosto $centroCosto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CentroCosto  $centroCosto
     * @return \Illuminate\Http\Response
     */
    public function edit(CentroCosto $centroCosto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CentroCosto  $centroCosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CentroCosto $centroCosto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CentroCosto  $centroCosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CentroCosto $centroCosto)
    {
        //
    }

    public function mantCCosto(){
       
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $empresas = Empresa::all();
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
        return view("mantenedores/mantCConsto",["Empresas"=>$empresas,"empresa"=>$Empresa]);
    }

    public function getCCostoByEmpresa($id_empresa){
        $Ccosto = CentroCosto::where("id_empresa",$id_empresa)->get();

        return view('Components/tblCentroCosto',["Centros"=>$Ccosto]);

    }

    public function GuardarCentro(Request $r){
        
  
            $CentroCosto = new CentroCosto();
        
            $desc_cc= $r->NombreCentro; 
            $localidad = $r->Localidad;
            $id_empresa = $r->id_empresa;
            $vigencia= $r->inpHabilitado;
            $principal=$r->inpPrincipal;
            $id_centro=$r->id_centro;
    
            $CentroCosto->GuardarCentro($desc_cc,
             $localidad,
             $id_empresa,
             $vigencia,
             $principal,
             $id_centro);

        return "true";
    }

    public function OperacionesXCentro($id_centro){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
        $CentroCosto = CentroCosto::find($id_centro);
        
        return view("operaciones/MainOpereaciones",["CentroCosto"=>$CentroCosto,"id_centro"=>$id_centro]);
    }
   

}
