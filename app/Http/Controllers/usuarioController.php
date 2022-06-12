<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\Perfil;
use App\Models\CentroCosto;
use App\Models\relCentroUsuario;
use App\Models\Centro_costo_token;

class usuarioController extends Controller
{
    //
    
    public function createToken(){
        $User =new Usuario();
        $token=$User->createToken('auth_token');
        //echo "";
        return ['token' => $token->plainTextToken];
    }

    public function deSerializeUser($userId){
        $Usuario= new Usuario();
        $username =$Usuario->select('id','name')->where('id',$userId)->get();
        
        return $username;
        
    }
    public function create(){
        $empresas = Empresa::all();
        $perfiles = Perfil::all();
        return view("/mantenedores/RegisterUser",["empresas"=>$empresas,"perfiles"=>$perfiles]);
    }

    public function registrar($name,$username, $mail,$pass,$rut,$empresa,$rol,$apellidoM,$apellidop,$habilitado){
        //echo  "userRegister";
        //exit();
        $Usuario= new Usuario();
        $Rol= 2;
        $response = $Usuario-> userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado);
        return $response;
    }
    public function normalLogin($usuario, $contrasena){
        $Usuario= new Usuario();
       // echo "logged";
       // exit();
        $respuesta = $Usuario->normalLogin($usuario, $contrasena);
        $session = $Usuario->userSession($usuario, $contrasena);
        return $respuesta;        
    }

    public function welcomeform($token){

        //$CentroCosto = new CentroCosto();
        $tokens = new Centro_costo_token();
       
        $toke=$tokens->where("cod_token",$token)->get();
       // var_dump($toke[0]);
        //exit();
        $idCentro =$toke[0]->id_centro;
        $status=0;
        if($toke[0]->status == 1)
        {
            $status=1;
        }
        $usuario = new Usuario();
        $usuarios =  $usuario->getUsuariosByCcosto($idCentro);
        return view("mantenedores.welcomeform",["usuarios"=>$usuarios,"token"=>$token,"status"=>$status]);
    }

    public function welcome_confirm(Request $r){
        $usuarios= $r->usuarios;
        //var_dump($usuarios);
        foreach($usuarios as $user){
           // var_dump($user);
            $usuario =  Usuario::find($user["id"]);
            $usuario->password = $usuario->encriptar($user["pass1"]);
            $usuario->email =  $user["email"];
            $usuario->save();
            
        }   
        $tokens = Centro_costo_token::where("cod_token",$r->tokencambio)->get();
        $tokens[0]->status=1;
        $tokens[0]->save();

        return "true";
    }
   
}
