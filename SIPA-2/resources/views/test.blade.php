<!DOCTYPE html>

@php
    // $cuerpos = App\CuerpoCorreo::all();
    // $date = \Carbon\Carbon::parse('2016-01-23')->format('Y-m-d');
    // $time = \Carbon\Carbon::parse('11:53:20')->format('H:i:s');
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
              
    $alertas = App\alertasActivos::all();
    // dd($alertas->reserva);



    $hoy = \Carbon\Carbon::now(new DateTimeZone('America/Managua'));
    
    foreach ($alertas as $key => $alerta) {
        
        $reserva = $alerta->reserva;
        
        $enviar_alerta = false;

        $fecha_fin_reserva = $reserva ->sipa_reservas_activos_fecha_fin;
        $hora_fin_reserva = $reserva ->sipa_reservas_activos_hora_fin;
        $fecha_reserva = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$fecha_fin_reserva.' '.$hora_fin_reserva);
        
        if($fecha_reserva<$hoy){
            // dd('la reserva ya paso');
            //si ya paso, revisar si los activos estan disponibles
            $activos =  $reserva->activos;
            foreach ($activos as $key2 => $activo) {
                $estado = $activo->estadoReserva;
                
                if($estado->sipa_estado_reservas_estados === 'No devuelto'){
                    // dd('No devueltoooo');
                    $enviar_alerta = true;
                }
                    
            }

        }
        if($enviar_alerta===true){
            $mailIt = new App\CorreoPHPMailer();
           
            $mailIt->sendMailPHPMailer('atraso','devuelva la vara','bryangarroeduarte@gmail.com');
            $fecha_aux = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$alerta->sipa_alertas_activos_fechaHoraEnvio);
            $fecha_aux->addHours(3);
            $alerta->sipa_alertas_activos_fechaHoraEnvio= $fecha_aux;
            $alerta->save();
            dd('alerta enviada');
        }else{
            $alerta->delete();
            dd('alerta borrada');
            //borrar alerta de la base de datos
        }
        
    }
    dd('no action needed');
    //revisar si la fecha final de la reserva ya paso la fecha actual
        //si ya paso, revisar si los activos estan disponibles
        // si no estan, enviar alerta que los devuelva
        // si si estan, borrar alerta
@endphp