<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\Provincias;
use App\Models\Comunas;

class proveedorController extends Controller
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
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }

    public function mantProveedor(){
        $proveedores = Proveedor::All();
        $comunas = Comunas::orderBy('comuna')->get();
        return view("mantenedores/mantProveedor",["proveedores"=>$proveedores,"comunas"=>$comunas,"swContacto"=>"0"]);
    }

    public function getProvedores(){
        $proveedores = Proveedor::all();

        return view("Components/tblProveedor",["proveedores"=>$proveedores,"swContacto"=>"0"]);
    }

    public function guardarProveedor(Request $r){

        $cnt_proveedor  = Proveedor::where("id_proveedor",$r->id_proveedor)->count();

        $fantasia  = Proveedor::where("nombre_fantasia",$r->nombreFantasia)->count();

        if($cnt_proveedor>0){
            $provveodor = Proveedor::find($r->id_proveedor);
            $provveodor->razon_social = $r->razonSocial;
            $provveodor->nombre_fantasia = $r->nombreFantasia;
            $provveodor->giro_principal = $r->giroprin;
            $provveodor->giro_secunadario = $r->girosec;
            $provveodor->rutProv = $r->rut;
            $provveodor->comuna_id = $r->id_comuna;
            $provveodor->direccion = $r->Direccion;
            $provveodor->fono_matriz = $r->FonoMatriz;
            $provveodor->fono_bodega = $r->FonoBodega;
            $provveodor->fono_venta = $r->FonoVentas;
            $provveodor->correo = $r->Email;
            $provveodor->save();
        }else{
            $provveodor = new Proveedor();
            $provveodor->razon_social = $r->razonSocial;
            $provveodor->nombre_fantasia = $r->nombreFantasia;
            $provveodor->giro_principal = $r->giroprin;
            $provveodor->giro_secunadario = $r->girosec;
            $provveodor->rutProv = $r->rut;
            $provveodor->comuna_id = $r->id_comuna;
            $provveodor->direccion = $r->Direccion;
            $provveodor->fono_matriz = $r->FonoMatriz;
            $provveodor->fono_bodega = $r->FonoBodega;
            $provveodor->fono_venta = $r->FonoVentas;
            $provveodor->correo = $r->Email;
            $provveodor->save();
        }
        return "true";
    }
}
