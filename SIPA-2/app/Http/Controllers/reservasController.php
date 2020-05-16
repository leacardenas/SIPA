<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use DOMDocument;
use Illuminate\Http\Request;
use App\Reserva;
use App\User;
use App\Salas;
use App\CorreoPHPMailer;
use App\ReservaSala;
use App\ReservaActivoMatch;
use App\ReservaSalaMatch;
use Carbon\Carbon;
use DateTime;
class reservasController extends Controller
{
    public function passDataToBlade(Request $request){
        
        $fecha_inicial = $request->get('FI');
        $fecha_final = $request->get('FF');
        $hora_inicial = $request->get('HI');
        $hora_final = $request->get('HF');
        $horasSemanales = $request->input('semanasInput');
        $horasMensuales = $request->input('mesesInput');
        $cantidad = null; 
        if($horasSemanales !== null){
            $cantidad = $horasSemanales; 
        }elseif($horasMensuales !== null){
            $cantidad = $horasMensuales * 4; 
        }else{
            $cantidad = 0; 
        }

        // dd($horasMensuales);
        // dd('hola');
        return view('activos.datatable', [
            'fecha_inicial' => $fecha_inicial,
            'fecha_final'=>$fecha_final,
            'hora_inicial'=>$hora_inicial,
            'hora_final' =>$hora_final,
            'cantidad' =>$cantidad
            ]
        );
        // return view('configuraciones.roles');
    }


    public function reservar($fi,$ff,$hi,$hf,$cant,$semanas_meses,$cedula,$archJson){
 
        $fiCarbon = Carbon::parse($fi)->format('Y-m-d');
        $ffCarbon = Carbon::parse($ff)->format('Y-m-d');
        $hiCarbon = Carbon::parse($hi)->format('H:i:s');
        $hfCarbon = Carbon::parse($hf)->format('H:i:s');
        $user = User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
        $lista = json_decode($archJson,true);
        $arrayFechasHoras = array(); 
  

        $fiTEMP = $fi;
        $ffTEMP = $ff;
        for ($i = 0; $i <= $cant; $i++) {
            $reserva = new Reserva();
            $reserva->sipa_reservas_activos_fecha_inicio =  $fiCarbon;
            $reserva->sipa_reservas_activos_fecha_fin =  $ffCarbon;
            $reserva->sipa_reservas_activos_hora_inicio = $hiCarbon;
            $reserva->sipa_reservas_activos_hora_fin = $hfCarbon;
            $reserva->sipa_reservas_activos_funcionario = $user->sipa_usuarios_id;
            $reserva->sipa_reservas_activos_pdf = null;
            $reserva->save(); 
            $reserva->sipa_reservas_activos_id; // completa el ID
            //realizar aumento de fechas
            $arrayFechasHoras[] = [$fiCarbon,$ffCarbon,$hiCarbon,$hfCarbon];

            $fiCarbon = Carbon::parse($fiTEMP);
            $fiCarbon->addWeek();
            $fiTEMP = $fiCarbon->toDateString();
            $fiCarbon = Carbon::parse($fiCarbon->toDateString())->format('Y-m-d');

            $ffCarbon = Carbon::parse($ffTEMP);
            $ffCarbon->addWeek();
            $ffTEMP = $ffCarbon->toDateString();
            $ffCarbon = Carbon::parse($ffCarbon->toDateString())->format('Y-m-d');

            //realizar insert en match de tablas
            foreach($lista as $id){
                $match = new ReservaActivoMatch();
                $match ->sipa_reserva_activo_reservaId = $reserva->sipa_reservas_activos_id;
                $match ->sipa_reserva_activo_activoId = $id;
                $match ->save();
            }

        }
         
        $mailIt = new CorreoPHPMailer();
        $correo = App\CuerpoCorreo::find(1);
        $correo->prepare_for_reservaActivos($lista,$date,$time,$date,$time);
        $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
               return ['respuesta' => $body];
    }
    public function filtrarSalas($fi,$ff,$hi,$hf,$cant){
        
        $salas = Salas:: all();
        
        $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fi)->format('Y-m-d');
        $fecha_final = DateTime::createFromFormat('d-m-Y', $ff)->format('Y-m-d');
        $hora_inicial = Carbon::parse($hi)->format('H:i:s');
        $hora_final = Carbon::parse($hf)->format('H:i:s');
        
        $fiTEMP= $fecha_inicial;
        $ffTEMP=$fecha_final;

        for ($i = 0; $i <= $cant; $i++) {
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
            $fecha_inicial = Carbon::parse($fiTEMP);
            $fecha_inicial->addWeek();
            $fiTEMP = $fecha_inicial->toDateString();
            $fecha_inicial = Carbon::parse($fecha_inicial->toDateString())->format('Y-m-d');

            // $ffTEMP= $fecha_final->toDateString();
            $fecha_final = Carbon::parse($ffTEMP);
            $fecha_final->addWeek();
            $ffTEMP = $fecha_final->toDateString();
            $fecha_final = Carbon::parse($fecha_final->toDateString())->format('Y-m-d');
        }
        $jsonData = json_encode($salas,JSON_PARTIAL_OUTPUT_ON_ERROR );
        // dd('asd');
        return  $jsonData;
    }


    public function reservarSalas($fi,$ff,$hi,$hf,$cant,$idSalap){
 
        $fiCarbon = Carbon::parse($fi)->format('Y-m-d');
        $ffCarbon = Carbon::parse($ff)->format('Y-m-d');
        $hiCarbon = Carbon::parse($hi)->format('H:i:s');
        $hfCarbon = Carbon::parse($hf)->format('H:i:s');
        $cedula = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
        
        $cantidadRepeticionesSemanales = $cant;

  

        $fiTEMP = $fi;
        $ffTEMP = $ff;
        for ($i = 0; $i <= $cantidadRepeticionesSemanales; $i++) {
            $reserva = new ReservaSala();
            $reserva->sipa_reservas_salas_fecha_inicio =  $fiCarbon;
            $reserva->sipa_reservas_salas_fecha_fin =  $ffCarbon;
            $reserva->sipa_reservas_salas_hora_inicio = $hiCarbon;
            $reserva->sipa_reservas_salas_hora_fin = $hfCarbon;
            $reserva->sipa_reservas_salas_funcionario = $user->sipa_usuarios_id;
            $reserva->sipa_reservas_salas_pdf = null;
            $reserva->save(); 
            $reserva->sipa_reservas_activos_id; // completa el ID

            //realizar insert en match de tablas
            $match = new ReservaSalaMatch();
            $match ->sipa_reserva_sala_reservaSalaId = $reserva->sipa_reserva_salas_id;
            $match ->sipa_reserva_sala_salaId = $idSalap;
            $match ->save();
            

            //realizar aumento de fechas
            $fiCarbon = Carbon::parse($fiTEMP);
            $fiCarbon->addWeek();
            $fiTEMP = $fiCarbon->toDateString();
            $fiCarbon = Carbon::parse($fiCarbon->toDateString())->format('Y-m-d');

            $ffCarbon = Carbon::parse($ffTEMP);
            $ffCarbon->addWeek();
            $ffTEMP = $ffCarbon->toDateString();
            $ffCarbon = Carbon::parse($ffCarbon->toDateString())->format('Y-m-d');

        }
         
        
               return ['respuesta' => 'todo bien'];
    }
}


