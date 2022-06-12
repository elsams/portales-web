<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\relCentroUsuario;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $secret_iv;
    protected $private_key_id;
    protected $method;
    protected $table="usuario";
    public function __construct()
    {
         $this->secret_iv = "de6a7";
         $this->private_key_id = "2d17cb4fb3c4d37cbc70f8303670a424c60de6a7";
         $this->method ="aes128";
    }

    public function encriptar($string){
        $iv = substr(hash('sha256',$this->secret_iv), 0, 16);
        $encodedval =openssl_encrypt($string, $this->method, $this->private_key_id, 0, $iv);             
        return $encodedval;
    }
    public function desencripar($string){
        
        $iv = substr(hash('sha256',$this->secret_iv), 0, 16);
        $output = openssl_decrypt($string, $this->method,$this->private_key_id, 0, $iv);
        return $output;
    }

    public function normalLogin($usuario, $contrasena){       
        $encodedPass = $this->encriptar($contrasena);
        $existe = $this->where("username",$usuario)->where("password",$encodedPass)->count();
        //echo $existe;
       return $existe;
    }
    public function decript($string){
        $this->desencripar($string);
    }

    public function  userSession($usuario, $contrasena){
        $encodedPass = $this->encriptar($usuario, $contrasena);
        $user = $this->where("username",$usuario)->get();
        $menu = new Menu();
        $menuItems= $menu->getAllMenu();
       // $user_empresa = new  User_admin::find($user[0]->id);
        //$_SESSION["id_empresa"] = $user_empresa->select("id_empresa")->where("id_usuario",$user[0]->id);

       
        if(count($user)>0){
            session_start();
            if( User_admin::where("id_usuario",$user[0]->id)->exists()){
                $user_empresa =  User_admin::where("id_usuario",$user[0]->id)->first();
               // var_dump($user_empresa);
                //exit();
                $_SESSION["id_empresa"] =$user_empresa->id_empresa;
            }else{
                $_SESSION["id_empresa"] =0;
            }
            
           
            $_SESSION["CodUsuario"] = $user[0]->id;
            $_SESSION["username"] = $user[0]->name;
            $_SESSION["emailUsuario"] = $user[0]->email; 
            $_SESSION["role"] = $user[0]->role_id; 
            $_SESSION["menuItems"] = $menuItems;
            //$_SESSION["menuItems"] = $menuItems;
            //echo  $_SESSION["role"];
           // exit();
        }
       
       // exit();
       return false;
    }

    public function userRegister($name,$username, $mail,$pass, $empresa,$rol,$rut,$apellidoM,$apellidop,$habilitado)
    {
        $mailExist =null;
        if($mail!==null){
            $mailExist = Usuario::where('email',$mail)->first();
        }
       
        $msg= "EL usuario no se ha podido crear";
        $sw=0;
        $state = 0;
        if ($mailExist !== null) {  
                  $msg= "Este correo ya fue utilizado , intenta recuperar tu password";$sw=1;$state = 1;
        }
        /*$usernameExist = Usuario::where('username',$username)->first();
        if ($usernameExist !== null) {  
            $msg= "Este nombre de usuario ya fue utilizado , intenta con otro";$sw=1;$state = 2;
        }*/
        $idUsuario=0;
        if($sw==0){
            $user = new Usuario();
            $user->username=$username;
            $user->password= $this->encriptar($pass);
            $user->role_id= $rol;
            $user->email= $mail;
            $user->nombres= $name;
            $user->name= $name;
            $user->rut= $rut;
            $user->apellido_m= $apellidoM;
            $user->apellido_p= $apellidop;
            $user->flg_habilitado=$habilitado;
            
                $user->save();
                $idUsuario=$user->id;
             
           
           
            $msg= "Usuario Creado Exitosamente";
        }

        $response["status"] = $state;
        $response["mensaje"] = $msg;
        $response["id"] = $idUsuario;
        return $response;
       
    }

    public function getUsuariosByCcosto($idCentro){
        $Usuarios = DB::select("select u.*, rccu.id_centro 
        from usuario u 
        join rel_centro_costo_usuario rccu on u.id = rccu.id_usuario 
        where  rccu.id_centro =? ",[$idCentro]);

        return  $Usuarios;

    }

}
