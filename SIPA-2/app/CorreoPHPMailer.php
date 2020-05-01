<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer;
use App\Activo;
class CorreoPHPMailer extends Model
{
    public function __construct(){
            
    }
    public function sendMailPHPMailer($subject,$body,$correo){
        
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
                $mail->Subject = $subject;
                $mail->MsgHTML($body);
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
    public function prepareEmailBody_reservaActivos($listaActivosid){
        $listaActivos = array(); 
        foreach($listaActivosid as $id){
            $listaActivos[] = Activo::find($id);  
        }
        // $listaActivos = $listaActivos->intersect(Activo::whereIn('sipa_activos_id', $listaActivosid)->get());
        $body = "
            Este es un demo de un body de correo, necesitamos <br/>
            definir los oficiales con steven. <br/>
            <br/>
            Lista de articulos reservados: <br/>
        ";
        foreach ($listaActivos as $activo) {
            $body = $body."
            Codigo: ".$activo->sipa_activos_codigo." <br/>
            Descripcion: ".$activo->sipa_activos_descripcion." <br/>
            <img src=\"data:image/{{".$activo->tipo_imagen."}};base64,{{".$activo->sipa_activos_foto."}}\" height=\"100\" width=\"100\"> <br/>
            <br/>
            ";
        }
        return $body;
    }
}
