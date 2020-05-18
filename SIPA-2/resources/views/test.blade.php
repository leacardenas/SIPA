<!DOCTYPE html>

@php
    // $cuerpos = App\CuerpoCorreo::all();
    //  $date = \Carbon\Carbon::parse('2016-01-23')->format('Y-m-d');
    //  $time = \Carbon\Carbon::parse('11:53:20')->format('H:i:s');
    // $arrayFechasHoras = array(); 
    // $arrayFechasHoras[] = [$date,$time,$date,$time];
    // $lista = array(); 
    // $lista[] = '5';
    // $lista[] = '6';
    // $mailIt = new App\CorreoPHPMailer();
    // $correo = App\CuerpoCorreo::find(1);
    //     // $body = $mailIt->prepareEmailBody_reservaActivos($lista,$arrayFechasHoras);
    // $correo->prepare_for_reservaActivos($lista,$date,$time,$date,$time);
    // $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,'lea.cardenas14@gmail.com');
              
    //$alertas = App\alertasActivos::all();
    // dd($alertas->reserva);
   // $hoy = \Carbon\Carbon::now(new DateTimeZone('America/Managua'));
    
    
    //-----------------------------------------------------------------
    // App\alertasActivos::revisarAlertasReservas();
    // App\AlertaSala::revisarAlertasSalas();
   // estas dos lineas son las qu eejecuta el handler de alertas
    //-----------------------------------------------------------------
    $activo = App\Activo::find(0);
    $activoOcupado = $activo->fechas_ocupado[0];
    // dd($activoOcupado);
    dd($activoOcupado->activo);
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BigStore: Shopping Invoice</title>
</head>
<body>


  
@endphp