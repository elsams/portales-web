<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Exception\Handler;
use App\Models\Proveedor;
use App\Models\CentroCosto;
use App\Models\Empresa;
use App\Models\TipoDocumento;
use App\Models\GuiaDespacho;
use App\Models\ItemGuia;
use App\Models\UnidadMedida;

class menuController extends Controller
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }

    public function getAllMenu(){
        $menu = new Menu();
        $menuset = $menu->getAllMenu();
        return $menuset;
    }

    public function guardarMenu(Request $request){
        
       
        //echo $request->idMenu;
        try {

            if($request->idMenu !== "0" && $request->idMenu !== 0){
              //  echo "editando";
                $menu=Menu::find($request->idMenu);
               // $menu->find($request->idMenu);
                $menu->cod_menu =$request->nombre;
                $menu->url= $request->url;
                $menu->id_parent=$request->idpadre;
                $menu->vigencia = $request->habilitado;
                $menu->save();
            }else{
                $menu = new Menu();
                $menu->cod_menu =$request->nombre;
                $menu->url= $request->url;
                $menu->id_parent=$request->idpadre;
                $menu->vigencia = $request->habilitado;
                $menu->save();
            }
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          }
        
          return "true";
    }
    public function getMenuTable(){
        $menu = new Menu();
        $menuItems =  $menu->all();
      
        return view("Components/tblMenu",["menuitems"=>$menuItems]);
        
    }
    public function getMenuSelect(){
        $menu = new Menu();
        $menuItems =  $menu->all();
        return view("Components/selectMenu",["menuitems"=>$menuItems ]);
        
    }
    public function getMenuJson($idPerfil){
        $menu = new Menu();
        $menuItems =  $menu->getPerfilMenu($idPerfil);
       
        return $menuItems;
        
    }

    public function operacionRecepcion($id_centro){
        $proveedores = Proveedor::all();
        $centroCosto = CentroCosto::find($id_centro);
        $NombreCentro= $centroCosto["desc_cc"];
        $tipo_documento = TipoDocumento::where("id_tipo_doc",1)->get();

        $unidad_medida = UnidadMedida::all();

        //var_dump($unidad_medida);
        return view('operaciones/recepcionGuia',["id_centro"=>$id_centro,'nombre_centro'=>$NombreCentro,'proveedores'=> $proveedores,'tipo_documento'=>$tipo_documento,"unidadesMedida"=>$unidad_medida]);
    }

    public function operacionOrden($id_centro){
        $proveedores = Proveedor::all();
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
   
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
        return view('operaciones/operacionOrden',["id_centro"=>$id_centro,'proveedores'=> $proveedores,'empresa'=>$Empresa]);
    }

    public function operacionControl($id_centro){
        $centroCosto = CentroCosto::find($id_centro);
        $NombreCentro= $centroCosto["desc_cc"];
        $ItemGuia = new ItemGuia();
        $Items =$ItemGuia->getItemsByCentro($id_centro);
        return view('operaciones/listadoItemsRepo',["id_centro"=>$id_centro,"items"=>$Items,"NombreCentro"=>$NombreCentro]);
    }
    public function ControlRepo($id_centro,$id_item){
        
        return view('operaciones/operacionControl',["id_centro"=>$id_centro,'id_item'=>$id_item]);
    }

    public function informeGuias(){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
       // $Centros = CentroCosto::where("id_empresa",$_SESSION["id_empresa"])->get();
        return view('informes/guias',["empresa"=>$Empresa]);
    }
    public function DevolucionesXCentro($id_centro){
        $proveedores = Proveedor::all();
        $centroCosto = CentroCosto::find($id_centro);
        $NombreCentro= $centroCosto["desc_cc"];
        $tipo_documento = TipoDocumento::all();
        $unidad_medida = UnidadMedida::all();

        //var_dump($unidad_medida);
        return view('operaciones/recepcionGuia',["id_centro"=>$id_centro,'nombre_centro'=>$NombreCentro,'proveedores'=> $proveedores,'tipo_documento'=>$tipo_documento,"unidadesMedida"=>$unidad_medida]);
    }

    public function operacionFormularios($id_centro){
    
        return view("operaciones/formularios",["id_centro"=>$id_centro]);
    }
    
    public function inventarioHerramientas($id_centro){
    
        $centroCosto = CentroCosto::find($id_centro);
        $NombreCentro= $centroCosto["desc_cc"];
        $ItemGuia = new ItemGuia();
        $Items =$ItemGuia->getItemsByCentro($id_centro);
        return view("formularios/inventarioHerramientas",["id_centro"=>$id_centro,"items"=>$Items,"centro"=>$NombreCentro]);
    }

    public function informeOrdenes(){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
       // $Centros = CentroCosto::where("id_empresa",$_SESSION["id_empresa"])->get();
        return view('informes/ordenes',["empresa"=>$Empresa,"id_empresa"=>$_SESSION["id_empresa"]]);
    }

}
