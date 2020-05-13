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
              

    $fi='01-05-2020'; //2020-05-01
    $ff='03-05-2020'; //2020-05-03
    $hi='00:20'; //00:06:00
    $hf='00:20'; //00:06:00
    $cant=0;

    $salas = App\Salas:: all();
        
        $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fi)->format('Y-m-d');
        $fecha_final = DateTime::createFromFormat('d-m-Y', $ff)->format('Y-m-d');
        $hora_inicial = \Carbon\Carbon::parse($hi)->format('H:i:s');
        $hora_final = \Carbon\Carbon::parse($hf)->format('H:i:s');
        
        $fiTEMP= $fecha_inicial;
        $ffTEMP=$fecha_final;

        // for ($i = 0; $i <= $cant; $i++) {
            foreach ($salas as $k=> $sala) {
                $reservas = $sala->reservas;
                
                foreach ($reservas as  $reserva ) {
                    
                    $fecha_inicio_temporal = $reserva ->sipa_reservas_salas_fecha_inicio;
                    $fecha_fin_temporal = $reserva ->sipa_reservas_salas_fecha_fin;
                    $hora_inicio_temporal = $reserva ->sipa_reservas_salas_hora_inicio;
                    $hora_fin_temporal = $reserva ->sipa_reservas_salas_hora_fin;
        
                    if(($fecha_inicial>= $fecha_inicio_temporal && $fecha_inicial <=$fecha_fin_temporal)//pregunta si fecha inicial seleccionada esta dentro del rango de la reserva actual
                    ||
                    ($fecha_final>= $fecha_inicio_temporal && $fecha_final <=$fecha_fin_temporal)//pregunta si fecha final seleccionada esta dentro del rango de la reserva actual
                    ||
                    ($fecha_inicio_temporal>= $fecha_inicial && $fecha_inicio_temporal <=$fecha_final)//pregunta si fecha inicial temporal seleccionada esta dentro del rango de la reserva actual
                    ||
                    ($fecha_fin_temporal>= $fecha_inicial && $fecha_fin_temporal <=$fecha_final)){ //pregunta si fecha final temporal seleccionada esta dentro del rango de la reserva actual
                        if(($hora_inicial>= $hora_inicio_temporal && $hora_inicial <=$hora_fin_temporal)//pregunta si hora inicial seleccionada esta dentro del rango de la reserva actual
                        ||
                        ($hora_final>= $hora_inicio_temporal && $hora_final <=$hora_fin_temporal)//pregunta si hora final seleccionada esta dentro del rango de la reserva actual
                        ||
                        ($hora_inicio_temporal>= $hora_inicial && $hora_inicio_temporal <=$hora_final)//pregunta si hora inicial temporal seleccionada esta dentro del rango de la reserva actual
                        ||
                        ($hora_fin_temporal>= $hora_inicial && $hora_fin_temporal <=$hora_final)){ //pregunta si hora final temporal seleccionada esta dentro del rango de la reserva actual
                            unset($salas[$k]); 
                            break;
                        }
                    }
                }
            }
            $fecha_inicial = \Carbon\Carbon::parse($fiTEMP);
            $fecha_inicial->addWeek();
            $fiTEMP = $fecha_inicial->toDateString();
            $fecha_inicial = \Carbon\Carbon::parse($fecha_inicial->toDateString())->format('Y-m-d');

            // $ffTEMP= $fecha_final->toDateString();
            $fecha_final = \Carbon\Carbon::parse($ffTEMP);
            $fecha_final->addWeek();
            $ffTEMP = $fecha_final->toDateString();
            $fecha_final = \Carbon\Carbon::parse($fecha_final->toDateString())->format('Y-m-d');
        // }
        $jsonData = json_encode($salas,JSON_PARTIAL_OUTPUT_ON_ERROR );
        dd($jsonData);
@endphp