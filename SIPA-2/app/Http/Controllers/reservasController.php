<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;
use App;
use DOMDocument;
use App\Reserva;
use App\User;
use App\Salas;
use App\Activo;
use App\CorreoPHPMailer;
use App\CuerpoCorreo;
use App\alertasActivos;
use App\ReservaSala;
use App\AlertaSala;
use App\ReservaActivoMatch;
use App\ReservaSalaMatch;
use App\ActivosOcupados;
use App\SalasOcupados;
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

        // $activo_ocupado = revisarActivos($cant,$lista,$fiCarbon,$ffCarbon,$hiCarbon,$hfCarbon);
        // if($activo_ocupado === false){
        //     return ['respuesta' => 'mal'];
        // }
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
            $reserva->sipa_reserva_estado = 'Pendiente';
            $reserva->save(); 
            $reserva->sipa_reservas_activos_id; // completa el ID
            //realizar aumento de fechas
           
            $fecha_alerta = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ffTEMP.' '.$hf, 'America/Managua');
            $fecha_alerta->addHours(3);

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
                $ActivosOcupado = new ActivosOcupados();
                
                $ActivosOcupado->sipa_activosOcupados_activo = $id;
                $ActivosOcupado->sipa_activosOcupados_fi = $reserva->sipa_reservas_activos_fecha_inicio;
                $ActivosOcupado->sipa_activosOcupados_ff = $reserva->sipa_reservas_activos_fecha_fin;
                $ActivosOcupado->sipa_activosOcupados_hi = $reserva->sipa_reservas_activos_hora_inicio;
                $ActivosOcupado->sipa_activosOcupados_hf = $reserva->sipa_reservas_activos_hora_fin;
    
                $ActivosOcupado ->save();
                
            }

           
            
            $mailIt = new CorreoPHPMailer();
            $alerta = new alertasActivos();
            $correo = CuerpoCorreo::find(1);
            
            $correo->prepare_for_reservaActivos($lista,$fiTEMP,$hi,$ffTEMP,$hf);
            
            $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
            
            $alerta->sipa_alertas_activos_reserva = $reserva->sipa_reservas_activos_id;
            $alerta->sipa_alertas_activos_fechaHoraEnvio = $fecha_alerta;
            
            $alerta->save();
        }       
        return ['respuesta' => 'todo bien'];
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
                $reservas = $sala->fechas_ocupado;
                
                foreach ($reservas as  $reserva ) {
                    
                    $fecha_inicio_temporal = $reserva ->sipa_salasOcupadas_fi;
                    $fecha_fin_temporal = $reserva ->sipa_salasOcupadas_ff;
                    $hora_inicio_temporal = $reserva ->sipa_salasOcupadas_hi;
                    $hora_fin_temporal = $reserva ->sipa_salasOcupadas_hf;

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
                        ($hora_fin_temporal>= $hora_inicial && $hora_fin_temporal <=$hora_final)
                        ||
                        ($hora_inicial=== $hora_inicio_temporal && $hora_final ===$hora_fin_temporal)){ //pregunta si hora final temporal seleccionada esta dentro del rango de la reserva actual
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

        $fiTEMP = DateTime::createFromFormat('d-m-Y', $fi)->format('Y-m-d');
        $ffTEMP = DateTime::createFromFormat('d-m-Y', $ff)->format('Y-m-d');
        
        for ($i = 0; $i <= $cantidadRepeticionesSemanales; $i++) {
            $reserva = new ReservaSala();
            $reserva->sipa_reservas_salas_fecha_inicio =  $fiCarbon;
            $reserva->sipa_reservas_salas_fecha_fin =  $ffCarbon;
            $reserva->sipa_reservas_salas_hora_inicio = $hiCarbon;
            $reserva->sipa_reservas_salas_hora_fin = $hfCarbon;
            $reserva->sipa_reservas_salas_funcionario = $user->sipa_usuarios_id;
            $reserva->sipa_reservas_salas_pdf = null;
            $reserva->sipa_reservas_sala_estado = 'Pendiente';
            $reserva->save(); 
            $reserva->sipa_reservas_activos_id; // completa el ID

            
           
            $fecha_alerta = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ffTEMP.' '.$hf.':00', 'America/Managua');
            $fecha_alerta->addHours(3);
          

            //realizar insert en match de tablas
            $match = new ReservaSalaMatch();
            $match ->sipa_reserva_sala_reservaSalaId = $reserva->sipa_reserva_salas_id;
            $match ->sipa_reserva_sala_salaId = $idSalap;
            $match ->save();

            $SalaOcupado = new SalasOcupados();
            $SalaOcupado->sipa_salasOcupadas_sala = $idSalap;
            $SalaOcupado->sipa_salasOcupadas_fi = $reserva->sipa_reservas_salas_fecha_inicio;
            $SalaOcupado->sipa_salasOcupadas_ff = $reserva->sipa_reservas_salas_fecha_fin;
            $SalaOcupado->sipa_salasOcupadas_hi = $reserva->sipa_reservas_salas_hora_inicio;
            $SalaOcupado->sipa_salasOcupadas_hf = $reserva->sipa_reservas_salas_hora_fin;

            $SalaOcupado ->save();
            
            //realizar aumento de fechas
            $fiCarbon = Carbon::parse($fiTEMP);
            $fiCarbon->addWeek();
            $fiTEMP = $fiCarbon->toDateString();
            $fiCarbon = Carbon::parse($fiCarbon->toDateString())->format('Y-m-d');

            $ffCarbon = Carbon::parse($ffTEMP);
            $ffCarbon->addWeek();
            $ffTEMP = $ffCarbon->toDateString();
            $ffCarbon = Carbon::parse($ffCarbon->toDateString())->format('Y-m-d');

           
            $mailIt = new CorreoPHPMailer();
            $alerta = new AlertaSala();
            $correo = CuerpoCorreo::find(3);

            $correo->prepare_for_devolucionSala($idSalap,$fiTEMP,$hi,$ffTEMP,$hf);
            $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
            
            $alerta->sipa_alertas_salas_reserva = $reserva->sipa_reserva_salas_id;
            $alerta->sipa_alertas_salas_fechaHoraEnvio = $fecha_alerta;
            $alerta->save();

        }
         
        
               return ['respuesta' => 'todo bien'];
    }

   
    public function descargarHistorialActivoFuncionario(){
             $html = view('pdfViews.hitorialActivosFuncionario')->render();
             $pdf = App::make('dompdf.wrapper');
             $pdf->loadHTML($html);
             $pdf->setPaper('landscape');
             return $pdf->download('Historial-Reservas-Activo.pdf');
    }

        public function descargarHistorialActivo(){
            $html = view('pdfViews.historialActivosGeneral')->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('landscape');
            return $pdf->download('Historial-Reservas-Activo.pdf');
        }
    
        public function descargarHistorialSalaFuncionario(){
             $html = view('pdfViews.historialSalasFuncionario')->render();
             $pdf = App::make('dompdf.wrapper');
             $pdf->loadHTML($html);
             $pdf->setPaper('landscape');
             return $pdf->download('Historial-Reservas-Sala.pdf');
        }

        public function descargarHistorialSala(){
            $html = view('pdfViews.historialSalasGeneral')->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('landscape');
            return $pdf->download('Historial-Reservas-Sala.pdf');
         }

        public function devolucionActivos(Request $request){
            $bandera = true;
            $observacion = $request->get('observacion');
            $activos = $request->input('activosDevueltos');
            $reserva = $request->input('reservaId');
            $resDev = Reserva::find($reserva);
            $activosReserva = $resDev->activos;

            foreach($activos as $activo){
                $ocupado = ActivosOcupados::where('sipa_activosOcupados_activo',$activo)
                ->where('sipa_activosOcupados_fi',$resDev->sipa_reservas_activos_fecha_inicio)
                ->where('sipa_activosOcupados_hi',$resDev->sipa_reservas_activos_hora_inicio)->get();
                foreach($ocupado as $act){
                    $act->delete();
                }
            }

            foreach($activosReserva as $activoR){
                $activ = ActivosOcupados::where('sipa_activosOcupados_activo',$activoR->sipa_activos_id)
                ->where('sipa_activosOcupados_fi',$resDev->sipa_reservas_activos_fecha_inicio)
                ->where('sipa_activosOcupados_hi',$resDev->sipa_reservas_activos_hora_inicio)->count();
                if($activ > 0){
                    $bandera = false;
                    break;
                }
            }

            if($resDev->comentario){
                $comentarios = $resDev->comentario . '\r\n' . $observacion;
                $resDev->update(['comentario'=>$comentarios]);
            }
            else{
                $resDev->update(['comentario' => $observacion]);
            }

            if($bandera){
                $resDev->sipa_reserva_estado = "Finalizado";
                $resDev->save();
            }else{
                $resDev->sipa_reserva_estado = "Recurrente";
                $resDev->save();
            }

            return view('reservas.devuelveActivo');
            
        }

        public function devolverSala(Request $request){
            $reservaID = $request->input('reservaID');
            $observacion = $request->get('observacion');
            $reserva = ReservaSala::find($reservaID);
            $salaOcupada = SalasOcupados::where('sipa_salasOcupadas_sala',$reservaID)
                ->where('sipa_salasOcupadas_fi',$reserva->sipa_reservas_salas_fecha_inicio)
                ->where('sipa_salasOcupadas_hi',$reserva->sipa_reservas_salas_hora_inicio)->get();
            $reserva->update([ 'sipa_reservas_sala_estado' => "Finalizado",
                'comentario' => $observacion]);

                foreach($salaOcupada as $salaO){

                    $salaO->delete();
                }

            return view('reserva.devuelveSala');
        }


    public function getReservasActivos(){
        $reservasActivos = ActivosOcupados::all();
        $jsonData = '[';
        $size = sizeof($reservasActivos);
        $count = 0;
        foreach($reservasActivos as $key => $reserva){
            $jsonData .= '{"title":"Reserva de Sala","start":"'.$reserva->sipa_activosOcupados_fi.'T'.$reserva->sipa_activosOcupados_hi.'","end":"'.$reserva->sipa_activosOcupados_ff.'T'.$reserva->sipa_activosOcupados_hf.'"}';
            $count++;
            if ($count<$size){
                $jsonData .= ",";
            }
                
        }
        $jsonData .= "]";
        return $jsonData;
    }
    public function getReservasSalas(){
        $reservasActivos = SalasOcupados::all();
        $jsonData = '[';
        $size = sizeof($reservasActivos);
        $count = 0;
        foreach($reservasActivos as $key => $reserva){
            $jsonData .= '{"title":"Reserva de Sala","start":"'.$reserva->sipa_salasOcupadas_fi.'T'.$reserva->sipa_salasOcupadas_hi.'","end":"'.$reserva->sipa_salasOcupadas_ff.'T'.$reserva->sipa_salasOcupadas_hf.'"}';
            $count++;
            if ($count<$size){
                $jsonData .= ",";
            }
                
        }
        $jsonData .= "]";
        return $jsonData;;
    }

    public function entregarActivos($idReserva){
        $reserva = App\Reserva::find($idReserva);
        $reserva->update(['sipa_reserva_estado' => 'Recurrente']);
        return view('reservas.entregaActivo');
    }

    public function entregarSalas($idReserva){
        $reserva = App\ReservaSala::find($idReserva);
        $reserva->update(['sipa_reservas_sala_estado' => 'Recurrente']);
        return view('reservas.entregaSala');
    }

    public function revisarActivos($cantidad,$activos,$fecha_inicial,$fecha_final,$hora_inicial,$hora_final){
        for ($i = 0; $i <= $cantidad; $i++) {
            foreach ($activos as  $id) {
                $activo = Activo::find($id);
                $activoEnReserva = false;
                $reservas = $activo->fechas_ocupado;
    
                
           
                foreach ($reservas as  $reserva ) {
                    
                    $fecha_inicio_temporal = $reserva ->sipa_activosOcupados_fi;
                    $fecha_fin_temporal = $reserva ->sipa_activosOcupados_ff;
                    $hora_inicio_temporal = $reserva ->sipa_activosOcupados_hi;
                    $hora_fin_temporal = $reserva ->sipa_activosOcupados_hf;
                    //dd($hora_inicial.' vs '.$hora_inicio_temporal.' --- '.$hora_final.' vs '.$hora_fin_temporal);
    
                    if(($fecha_inicial>= $fecha_inicio_temporal && $fecha_inicial <=$fecha_fin_temporal)
                    ||
                    ($fecha_final>= $fecha_inicio_temporal && $fecha_final <=$fecha_fin_temporal)
                    ||
                    ($fecha_inicio_temporal>= $fecha_inicial && $fecha_inicio_temporal <=$fecha_final)
                    ||
                    ($fecha_fin_temporal>= $fecha_inicial && $fecha_fin_temporal <=$fecha_final)){ 
                        
                        if(($hora_inicial>= $hora_inicio_temporal && $hora_inicial <=$hora_fin_temporal)
                        ||
                        ($hora_final>= $hora_inicio_temporal && $hora_final <=$hora_fin_temporal)
                        ||
                        ($hora_inicio_temporal>= $hora_inicial && $hora_inicio_temporal <=$hora_final)
                        ||
                        ($hora_fin_temporal>= $hora_inicial && $hora_fin_temporal <=$hora_final)
                        ||
                        ($hora_inicial=== $hora_inicio_temporal && $hora_final ===$hora_fin_temporal)){ 
                            unset($activos[$k]); 
                            return false;
                        }
                    }
    
                }
                // $fiTEMP= $fecha_inicial->toDateString();
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
        }
        return true;
    }
}


