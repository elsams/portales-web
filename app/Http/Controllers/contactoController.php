<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Models\Provincias;
use App\Models\Regiones;
use App\Models\Cargo;
use App\Models\Proveedor;
use App\Models\Empresa;
use App\Models\rel_contacto_cli_proveedor; 


class contactoController extends Controller
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
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        //
    }

    public function creacionContacto(){
        //$Regiones = Regiones::all();
        $Provincias = Provincias::all();
        $Cargo = Cargo::all();
        $Proveedor = Proveedor::all();
        $Contacto = new Contacto();
        $Contactos = $Contacto->getContactos();
        return view('mantenedores/mantContacto', ["provincias"=>$Provincias, "cargos"=>$Cargo,"proveedores"=>$Proveedor,"contactos"=>$Contactos,"swContacto"=>"0"]);
    }

    public function createContacto(Request $request){

        $contacto = new Contacto();
        
        
        $contacto->createContacto($request->id_contacto,$request->inpNames,$request->inpApellidoP,
        $request->inpApellidoM,
        $request->inpRut,
        $request->selProvincia,
        $request->selectCargo,
        $request->selectProveedor,
        $request->inpContact1, $request->inpContact2, $request->inpContact3,$request->inpEmail1,$request->inpEmail2, 
        $request->inpDireccion);

         return "true";

    }
    public function getContactos(){
        $Contacto = new Contacto();
        $Contactos = $Contacto->getContactos();
        return view("Components/tblContacto",["contactos"=>$Contactos]);
    }

    public function mantAsiganContacto()
    {
        //session_start();
        if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
        $proveedores = Proveedor::all();
        $Contacto = new Contacto(); 
        $Contactos =  $Contacto->getContactoCliente();
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
        $Empresas = Empresa::all();
        return view("mantenedores/mantAsignaProveedorContacto" ,
        ["proveedores"=>$proveedores,"contactos"=>$Contactos,"empresa"=>$Empresa ,"swContacto"=>"1","Empresas"=>$Empresas]);
    }   

    public function getContactosXProveedor($id_proveedor){
        $Contacto = new Contacto(); 
        $contactos= $Contacto->getContactosXProveedor($id_proveedor);
        return view("Components/tblContacto",["contactos"=>$contactos,"swContacto"=>"1"]);
        //return $contactos;

    }


    public function guardarContactoCliente(Request $request){
        
        $count = rel_contacto_cli_proveedor::where("id_empresa",$request->id_empresa)
        ->where("id_proveedor",$request->id_proveedor)->count();

        if($count >0){
            $ContactoCliente = rel_contacto_cli_proveedor::where("id_empresa",$request->id_empresa)
            ->where("id_proveedor",$request->id_proveedor)->first();
            $ContactoCliente->id_contacto= $request->id_contacto;
            $ContactoCliente->save();
        }else{
            $ContactoCliente = new rel_contacto_cli_proveedor();
            $ContactoCliente->id_contacto= $request->id_contacto;
            $ContactoCliente->id_empresa= $request->id_empresa;
            $ContactoCliente->id_proveedor= $request->id_proveedor;
            $ContactoCliente->save();
        }

        return "true";
    }
}
