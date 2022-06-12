<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\CentroCosto;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Mail;

class MailController extends Controller
{
     //

     public function sendEmail(){

        $details =[
            'title'=>'Mail Title',
            'body'=>'Mail test body'
        ];

        Mail::to("bboyguru2@gmail.com")->send(new formsMailable( $details));
        return "Email Sent";
    }

    public function email() {
        return view("email");
    }

    public function CreaciondeUsuariosMail($id_centro,$token){
        

        $CentroC  = new CentroCosto();
        $usuarios = $CentroC->UsuariosPorCentro($id_centro);
        $decrypter = new Usuario();
        $StringCorreos = "";
      // echo count($usuarios);
       $cnt= 0;
      // var_dump($usuarios);
      
       foreach($usuarios as $user)
       {
           if($cnt>0){ $StringCorreos=$StringCorreos." <br>";}
            $StringCorreos=$StringCorreos." Usuario:  ". $user->username;
            $StringCorreos=$StringCorreos." Password:  ". $decrypter->desencripar($user->password);
            $cnt= $cnt+1;
       }
       // echo $StringCorreos;
        //exit();
       
        $idEmpresa  = $usuarios[0]->id_empresa;
        $Empresa = Empresa::find($idEmpresa);
        $nombreCentro  = $usuarios[0]->desc_cc;
        $url = env("APP_URL")."public/user/welcomeform/".$token;
        //Datos Mail
        $titulo ="Cuenta Creada en Centro de Costo ".strtoupper($nombreCentro);
        $body="Se ha creado Su Centro de Costo ".strtoupper($nombreCentro);
        $body=$body."<br> Se hace entrega de sus usuarios a continuación: <br>".$StringCorreos;
        $body=$body."<br> Para Modificar Las contraseñas de los usuarios ingresar en el siguiente enlace<br>";
        $body=$body."<br> <a href='".$url."'>link</a>";
        $destinatario ='bboyguru2@gmail.com';
        $fromMail = "admin@portalesweb.cl";
        $Mailer = new Mail();
        $Mailer->sendMail($titulo, $body,$destinatario,$fromMail);
     
        return "email Enviado";
    }

    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');           //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');   //  sender username
            $mail->Password =env('MAIL_PASSWORD');       // sender password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');                  // encryption - ssl/tls
            $mail->Port = env('MAIL_PORT');                          // port - 587/465
            $mail->setFrom('admin@portalesweb.cl', 'WebMaster');
            
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

           
           
           /*
            $mail->addAddress($request->emailRecipient);
            $mail->addCC($request->emailCc);
            $mail->addBCC($request->emailBcc);
            */
            $mail->addAddress('bboyguru2@gmail.com','Daniel Sams');
            //$mail->addCC($request->emailCc);
            //$mail->addBCC($request->emailBcc);
            //$mail->addReplyTo('sender-reply-email', 'sender-reply-name');

            /*
            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }
            */


            $mail->isHTML(true);                // Set email content format to HTML

            //$mail->Subject = $request->emailSubject;
            //$mail->Body    = $request->emailBody;

            $mail->Subject = "Prueba Mail Laravel";
            $mail->Body    = "Body Text Test";

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return "Email not sent.";
            }
            
            else {
                return  "Email has been sent.";
            }

        } catch (Exception $e) {
            echo $e;
             return 'Message could not be sent.';
        }
    }
}
