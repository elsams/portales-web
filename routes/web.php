<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\empresaController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\contactoController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\herramientaController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\centroCostoController;
use App\Http\Controllers\tipoItemController;
use App\Http\Controllers\guiaDespachoController;
use App\Http\Controllers\ordenCompraController;
use App\Http\Controllers\controlReportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\documentoController;


use App\Models\CentroCosto;
use App\Models\Empresa;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/mailTest', function () {
    echo  env("MAIL_APP_SERVICE")."testMail";
    //exit();
    $ch = curl_init(env("MAIL_APP_SERVICE")."testMail");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);

   echo "MailEnviado";
});

Route::get('/main', function () {

    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
        if(!isset($_SESSION["id_empresa"]))
        {
            return view('login');
        }
    }
   // $Usuario =  Empresa::where("id_usuario",$_SESSION["id_empresa"])->first();
    $Empresa = Empresa::where("id_empresa",$_SESSION["id_empresa"])->first();
    $CentroCosto = new  CentroCosto();$_SESSION["CodUsuario"];
    $Centros = $CentroCosto->CentrosPorUsuario($_SESSION["CodUsuario"]);
    
    return view('main',["empresa"=>$Empresa,"Centros"=>$Centros]);
});


//Rutas usuario
Route::get('/user/creacion', [usuarioController::class, 'create']);
Route::get('/user/welcomeform/{token}', [usuarioController::class, 'welcomeform']);
Route::post('/user/welcomeformConfirm', [usuarioController::class, 'welcome_confirm']);
//Route::post('/user/welcomeformConfirm',"usuarioController@welcome_confirm");
Route::post('/login/normalLogin/{usuario}/{contrasena}', [usuarioController::class, 'normalLogin']);



//rutas Perfil Menu
Route::get('/mantAsignaPerfil', [usuarioController::class, 'mantAsignaPerfil']);

//Rutas Administracion
Route::get('/menu', function () {
    return view('mantenedores/mantMenu');
});


//Rutas Perfil
Route::get('/mantPerfil', [perfilController::class, 'mantPerfil']);
Route::get('perfil/tablaPerfiles', [perfilController::class, 'tablaPerfiles']);
Route::get('perfil/guardarPerfil', [perfilController::class, 'guardarPerfil']);
Route::get('perfil/tablaMenufiles/{idperfil}', [perfilController::class, 'getRelMenuPerfilfunction']);
Route::get('perfil/tablaMenufilesBase', [perfilController::class, 'getMenuPerfiles']);

//Rutas Contacto
Route::get('/contactoCreacion',  [contactoController::class, 'creacionContacto']);
Route::post('perfil/guardarContacto',  [contactoController::class, 'createContacto']);
Route::get('contacto/getContactos',  [contactoController::class, 'getContactos']);
Route::get('contacto/getContactosXProveedor/{id_proveedor}',  [contactoController::class, 'getContactosXProveedor']);

//asiganción de Contacto
Route::get('mantAsignaProveedorContacto',  [contactoController::class, 'mantAsiganContacto']);
Route::post('/contacto/guardarContactoCliente',  [contactoController::class, 'guardarContactoCliente']);


//Rutas Empresa/Cliente
Route::get('/empresa/creacion',  [empresaController::class, 'mantEmpresa']);
Route::get('/empresa/tablaEmpresas', [empresaController::class, 'tablaEmpresas']);
Route::post('/empresa/GuardarEmpresa',[empresaController::class, 'GuardarEmpresa']);

Route::get('/salir', function () {
    session_start();
    session_destroy();
    $_SESSION = array();
    return view('login');
});


//Acciones de Menu
Route::post('/menu/GuardarMenu',[menuController::class, 'GuardarMenu']);
Route::get('/menu/getMenuTable',[menuController::class, 'getMenuTable']);
Route::get('/menu/getMenuSelect',[menuController::class, 'getMenuSelect']);
Route::get('/menu/getMenuJson/{idPerfil}',[menuController::class, 'getMenuJson']);


Route::get('/user/registrar/{name}/{username}/{mail}/{pass}/{rut}/{empresa}/{rol}/{apellidoM}/{apellidoP}/{hablitado}', [usuarioController::class, 'registrar']);


//Rutas de Mantenedor MArca
Route::get('/mantMarca' ,[marcaController::class, 'mantMarca']);
Route::post('/marca/GuardarMarca' ,[marcaController::class, 'GuardarMarca']);
Route::get('/marca/getTblMarcas' ,[marcaController::class, 'getTblMarcas']);
Route::post('/marca/eliminarMarca' ,[marcaController::class, 'eliminarMarca']);

//Rutas Herramientas
Route::get('/mantItem' ,[herramientaController::class, 'mantHerramienta']);
Route::get('/item/getTblItem' ,[herramientaController::class, 'getTblHerramientas']);
Route::post('/item/eliminaItem' ,[herramientaController::class, 'eliminaHerramienta']);
Route::post('/item/guardarItem' ,[herramientaController::class, 'guardarherramienta']);
Route::get('/item/getTblItemByProv/{id_proveedor}' ,[herramientaController::class, 'getTblHerramientasXProveedor']);

Route::get('/item/getTblHerramientasCliente/{id_cliente}' ,[herramientaController::class, 'getTblHerramientasCliente']);

//Rutas Proveedor 
Route::get('/mantProveedor' ,[proveedorController::class, 'mantProveedor']);
Route::get('/proveedor/getProveedores' ,[proveedorController::class, 'getProvedores']);
Route::post('/proveedor/guardarProveedor' ,[proveedorController::class, 'guardarProveedor']);

//Rutas Centro Costo
Route::get('/mantCCosto' ,[centroCostoController::class, 'mantCCosto']);
Route::get('/centroCosto/getCCostoByEmpresa/{id_empresa}' ,[centroCostoController::class, 'getCCostoByEmpresa']);
Route::post('/centroCosto/GuardarCentro' ,[centroCostoController::class, 'GuardarCentro']);


Route::get('/mantPlan' ,[tipoItemController::class, 'mantPlanItem']);
Route::post('/tipoItem/guardarPermisosItems' ,[tipoItemController::class, 'guardarPermisosItems']);
Route::get('/tipoItem/getTipoItem/{id_empresa}' ,[tipoItemController::class, 'getTipoItemCliente']);

//Operaciones

//Operacion Recepcion
Route::get('/operaciones/{id_centro}',[centroCostoController::class, 'OperacionesXCentro']);
Route::get('/operaciones/recepcionGuia/{id_centro}',[menuController::class, 'operacionRecepcion']);
Route::post('/recepcion/guardarGuia',[guiaDespachoController::class, 'guardarGuia']);
Route::get('/recepcion/trDetalleGuia/{row}',[guiaDespachoController::class, 'trDetalleGuia']);

//Orden Compra
Route::get('/operaciones/operacionOrden/{id_centro}',[menuController::class, 'operacionOrden']);
Route::get('/operaciones/operacionControl/{id_centro}',[menuController::class, 'operacionControl']);
Route::get('/ordencompra/creaOrden/{id_centro}/{menu}',[ordenCompraController::class , 'creaOrden']);
Route::get('/ordencompra/trDetalleOrden/{row}',[ordenCompraController::class, 'trDetalleOrden']);
Route::post('/ordencompra/guardaOrden',[ordenCompraController::class, 'guardaOrden']);
Route::post('/ordencompra/ListadoOrdenes/{id_centro}',[ordenCompraController::class, 'ListadoOrdenes']);
Route::post('/ordencompra/TraeOrdenRecep/{id_orden}',[ordenCompraController::class, 'TraeOrdenRecep']);
Route::post('/ordencompra/TraeDetalleOrdenRecep/{id_orden}',[ordenCompraController::class, 'TraeDetalleOrdenRecep']);

//Rutas Control Report
Route::post('/report/getControlReport/{id_itemdet}', [controlReportController::class, 'getControlReport']);
Route::post('/report/getHistoryReport/{id_itemdet}', [controlReportController::class, 'getHistoryReport']);

Route::get('/operaciones/devoluciones/{id_centro}',[menuController::class, 'DevolucionesXCentro']);
Route::post('/report/guardarReport/', [controlReportController::class, 'guardarReport']);

//formuarios
Route::get('/operaciones/formularios/{id_centro}',[menuController::class, 'operacionFormularios']);
Route::get('/operaciones/formularios/inventarioHerramientas/{id_centro}',[menuController::class, 'inventarioHerramientas']);
Route::get('/invHerramienta/imprimir/{id_centro}',[documentoController::class, 'imprimeFormularioHerramienta']);


//Rutas Informes
Route::get('informes/Guias', [menuController::class, 'informeGuias']);
Route::get('informes/traeGuias', [guiaDespachoController::class, 'getGuias']);
Route::get('/informes/urlTraeGuiaPdf/{id_guia}', [guiaDespachoController::class, 'urlTraeGuiaPdf']);

Route::get('informes/Ordenes', [menuController::class, 'informeOrdenes']);
Route::get('informes/traeOrdenes/{id_empresa}', [ordenCompraController::class, 'getOrdenes']);
Route::get('/informes/urlTraeOrdenPdf/{id_orden}', [ordenCompraController::class, 'urlTraeOrdenPdf']);

Route::get('/informes/urlTraeReportPdf/{id_report}', [controlReportController::class, 'urlTraeReportPdf']);

Route::get('/testMail/{id_centro}',[MailController::class,'CreaciondeUsuariosMail']);



