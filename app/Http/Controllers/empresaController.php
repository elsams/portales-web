<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\User_admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CentroCosto;
use App\Models\relCentroUsuario;
use App\Http\Controllers\MailController;
use App\Models\Centro_costo_token;
use App\Models\rel_tipo_item_cliente;

class empresaController extends Controller
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
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
 
    public function mantEmpresa(){
        $usuarios = Usuario::all();
        $empresasObj = new Empresa();
        $empresas = $empresasObj->getTblEmpresas();
        return view("mantenedores/mantEmpresa" , ["empresas"=>$empresas ,"usuarios"=>$usuarios]);
    }
    public function GuardarEmpresa(Request $request){
        DB::beginTransaction();
        $empresa = new Empresa();
        $msg= "true";
        $count = Empresa::where('rut_empresa', $request->inpRut)->count();
        $idEmpresa= 0;



        if($count >0){
            $empresa = new Empresa();
            $empresaedit = $empresa->where('rut_empresa', $request->inpRut)->first();
            $empresaedit->nombre_empresa = $request->inpEmpresa;
            $empresaedit->razon_social_empresa = $request->inpRazon;
            $empresaedit->vigencia = $request->habilitado;
            $empresaedit->email = $request->mail;
            $empresaedit->save();
            $idEmpresa=$empresaedit->id_empresa;
            $msg= "Empresa Actualizada";
        }else{
            $empresa ->nombre_empresa = $request->inpEmpresa;
            $empresa ->razon_social_empresa = $request->inpRazon;
            $empresa ->rut_empresa = $request->inpRut;
            $empresa ->vigencia = $request->habilitado;
            $empresa ->email = $request->mail;
            $empresa ->save();

            $idEmpresa=$empresa->id_empresa;

            $items = new rel_tipo_item_cliente();
            $arrayTipoItem=[19,11,9];
            $items->guardarPermisosItems($idEmpresa, $arrayTipoItem);

            //Creación de Centro de Costo
            $CentroCosto = new CentroCosto();
        
            $vigencia= 1;
            $principal=1;    
           
            $CentroCosto->desc_cc = $request->NombreCentro;
            $CentroCosto->localidad =$request->Localidad;
            $CentroCosto->vigencia = $vigencia;
            $CentroCosto->principal = $principal;
            $CentroCosto->id_empresa = $idEmpresa;
            $CentroCosto->save();
            $idCentro= $CentroCosto->id_centro;
            
            $today = date("Y-m-d");
            $tomorrow = date("Y-m-d", strtotime("+ 1 day"));

            $token = new Centro_costo_token();
            $token->cod_token=Str::random(8);
            $token->id_centro=$idCentro;
            $token->fecha_crea =$today ;
            $token->fecha_expira =$tomorrow ;
            $token->status=0;//0 creado , 1 Ingresado/expirado
            $token->save();
            //

            $this->creaUsuariosEmpresa($idEmpresa,$request->mail, $request->inpEmpresa,$idCentro);
            $Mail =new  MailController();
            $Mail->CreaciondeUsuariosMail($idCentro,$token->cod_token);
        }
        

        return $msg;

    }
    public function tablaEmpresas(){
        $empresasObj = new Empresa();
        $empresas = $empresasObj->getTblEmpresas();
        return view("Components/tblEmpresas",["empresas"=>$empresas]);
    }


    public function creaUsuariosEmpresa($idEmpresa,$email,$nomEmpresa,$idCentro){
        $usuarios = new Usuario();
        //Usuario Admin
        $name=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Admin01".substr($nomEmpresa, -3, 3));
        $username=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Admin01".substr($nomEmpresa, -3, 3));
        $pass = Str::random(8);
        $empresa = $idEmpresa;
        $rol = 12;
        $rut=" ";
        $apellidoM=" ";
        $apellidop=" ";
        $habilitado=1;
        $mail = $email;
       
        $response = $usuarios->userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado);
        
        
        //Crea Relacionador Usuario /Principal Empresa
        $User_admin = new User_admin();
        $User_admin->id_usuario = $response["id"];
        $User_admin->id_empresa = $idEmpresa;
        $User_admin->save();


        //Crea Relacionador Usuario /Centro de costo
        $relCentro = new relCentroUsuario();
        //$relCentro->id_usuario = $response["id"];
        //$relCentro->id_centro = $idCentro;
        //$relCentro->save();
        $relCentro->creaRelacion($idCentro, $response["id"]);

        //Usuario Digitador 1
        $usuarios2 = new Usuario();
        //Usuario Admin
        $name=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Digitador01".substr($nomEmpresa, -3, 3));
        $username=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Digitador01".substr($nomEmpresa, -3, 3));
        $pass = Str::random(8);
        $empresa = $idEmpresa;
        $rol = 13;//13 digitador
        $rut=" ";
        $apellidoM=" ";
        $apellidop=" ";
        $habilitado=1;
        $mail = null;
        $response2= 0;
        
            $response2 = $usuarios2->userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado);
           
       
         //Crea Relacionador Usuario /Centro de costo
         $relCentro2 = new relCentroUsuario();
         //$relCentro2->id_usuario = $response2["id"];
         //$relCentro2->id_centro = $idCentro;
         //$relCentro2->save();
         $relCentro2->creaRelacion($idCentro, $response2["id"]);

         //Consultor 1
         //Usuario Digitador 1
        $usuarios3 = new Usuario();
        //Usuario Admin
        $name=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Consultor01".substr($nomEmpresa, -3, 3));
        $username=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Consultor01".substr($nomEmpresa, -3, 3));
        $pass = Str::random(8);
        $empresa = $idEmpresa;
        $rol = 14;//14 Consultor
        $rut=" ";
        $apellidoM=" ";
        $apellidop=" ";
        $habilitado=1;
        $mail = null;
        $response3= 0;
        
            $response3 = $usuarios3->userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado);
           
       
         //Crea Relacionador Usuario /Centro de costo
         $relCentro3 = new relCentroUsuario();
         //$relCentro3->id_usuario = $response3["id"];
         //$relCentro3->id_centro = $idCentro;
         //$relCentro3->save();
         $relCentro3->creaRelacion($idCentro, $response3["id"]);

         //Consultor 2
         //Usuario Digitador 1
        $usuarios4 = new Usuario();
        //Usuario Admin
        $name=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Consultor02".substr($nomEmpresa, -3, 3));
        $username=  str_replace(' ', '', substr($nomEmpresa, 0, 4)."Consultor02".substr($nomEmpresa, -3, 3));
        $pass = Str::random(8);
        $empresa = $idEmpresa;
        $rol = 14;//14 Consultor
        $rut=" ";
        $apellidoM=" ";
        $apellidop=" ";
        $habilitado=1;
        $mail = null;
        $response4= 0;
        
        $response4 = $usuarios4->userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado);
           
       
         //Crea Relacionador Usuario /Centro de costo
         $relCentro4 = new relCentroUsuario();
         //$relCentro4->id_usuario = $response4["id"];
         //$relCentro4->id_centro = $idCentro;
         //$relCentro4->save();
         $relCentro4->creaRelacion($idCentro, $response4["id"]);
       //var_dump($response);
    }
}
