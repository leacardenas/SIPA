<!DOCTYPE html>

@php
    $cuerpos = App\CuerpoCorreo::all();
    $date = \Carbon\Carbon::parse('2016-01-23')->format('Y-m-d');
    $time = \Carbon\Carbon::parse('11:53:20')->format('H:i:s');
    $arrayFechasHoras = array(); 
    $arrayFechasHoras[] = [$date,$time,$date,$time];
    $lista = array(); 
    $lista[] = '5';
    $lista[] = '6';
    $mailIt = new App\CorreoPHPMailer();
    $correo = App\CuerpoCorreo::find(1);
        // $body = $mailIt->prepareEmailBody_reservaActivos($lista,$arrayFechasHoras);
    $correo->prepare_for_reservaActivos($lista,$date,$time,$date,$time);
    $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,'lea.cardenas14@gmail.com');
              


@endphp