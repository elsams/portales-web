<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Models\Menu;

class perfilController extends Controller
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
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }

    public function mantPerfil(){
        $menu = new Menu();
        $menuItems=$menu->getAllMenu();

        $perfiles = Perfil::all();
        return view('mantenedores/mantPerfil',["menuItems"=>$menuItems,"perfiles"=>$perfiles]);
    }

    public function getMenuPerfiles(){
        $menu = new Menu();
        $menuItems=$menu->getAllMenu();
        return view("Components.tblMenuPerfil",["menuItems"=>$menuItems]);
    }
    public function tablaPerfiles(){
        $perfiles = Perfil::all();
        return view('Components.tblPerfiles',["perfiles"=>$perfiles]);

    }
    public function GuardarPerfil(Request $R){
        $perfil = new Perfil();
        $respuesta = $perfil->GuardarPerfil($R->id_perfil, $R->NomPerfil,$R->DescPerfil,$R->ArrMenus);

        return $respuesta;
    }

    public function getRelMenuPerfilfunction($id_perfil)
    {
        $perfilMenu = new Perfil();
        $menu = $perfilMenu->getRelMenuPerfil($id_perfil);
        return view('Components.tblMenuPerfil',["menuItems"=>$menu]);
    }
}
