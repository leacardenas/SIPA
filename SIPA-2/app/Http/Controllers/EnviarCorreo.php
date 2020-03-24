<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer;
use Illuminate\Http\Request;

class EnviarCorreo extends Controller
{
    function sendMailPHPMailer(Request $request){
        $correo = $request->input('correo');
        //dd($correo);
        $mail = new PHPMailer\PHPMailer();
        //dd($mail);
            try{
                //dd('Estoy en el try');
                $mail->isSMTP();
                $mail->CharSet = 'utf-8';
                //$mail->SMTPDebug = 3;
                $mail->SMTPAuth =true;
                $mail->IsHTML(true);
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com'; //gmail has host > smtp.gmail.com
                $mail->Port = '587'; //gmail has port > 587 . without double quotes
                $mail->SMTPOptions = array(

                    'ssl' => array(
                    
                        'verify_peer' => false,
                    
                        'verify_peer_name' => false,
                    
                        'allow_self_signed' => true
                    
                    ));
                $mail->Username = 'pruebahoras123@gmail.com'; //your username. actually your email
                $mail->Password = 'pruebas123'; // your password. your mail password
                $mail->setFrom('pruebasHoras123@gmail.com','Fiorella Salgado'); 
                $mail->Subject = "ES UNA PRUEBA";
                $mail->MsgHTML("Si recibes este correo es porque amas a Fiorella y crees que es una crack");
                $mail->addAddress($correo,'Fiorella Salgado'); 
                $mail->send();
            }catch(phpmailerException $e){
                dd($e);
            }catch(Exception $e){
                dd($e);
            }
            if($mail->send()){
                alert('Se envio el correo')->persistent("Close this");
                return view('enviar');
            }else{
                alert('No se envio el correo')->persistent("Close this");
                return view('enviar');
            }
    }
}
