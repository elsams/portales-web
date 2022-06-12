<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\CentroCosto;

class Mail extends Model
{
    use HasFactory;

    public function sendMail($titulo, $body,$destinatario,$fromMail){

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
            $mail->setFrom($fromMail, 'WebMaster');
            
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
            $mail->addAddress($destinatario,'Daniel Sams');
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

            $mail->Subject = $titulo;
            $mail->Body    =  $body;

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
