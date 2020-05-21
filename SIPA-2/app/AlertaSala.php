<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CorreoPHPMailer;
use App\CuerpoCorreo;
use Carbon\Carbon;
class AlertaSala extends Model
{
          // Table Name
          protected $table = 'sipa_alertas_salas';
          // Primary Key
          public $primaryKey = 'sipa_alertas_salas_id';
          // Timestamps
          public $timestamps = false;
      
          public function __construct(){
              
          }
          protected $fillable = [
            'sipa_alertas_salas_id', 'sipa_alertas_salas_reserva', 'sipa_alertas_salas_fechaHoraEnvio'
        ];
    
        public function reservaSala()
        {
            return $this->belongsTo('App\ReservaSala', 'sipa_alertas_salas_reserva','sipa_reserva_salas_id');
        }

        public function revisarAlertasSalas(){
            $alertas = AlertaSala::all();
            $hoy = Carbon::now(new \DateTimeZone('America/Managua'));
            // $hoy = \Carbon\Carbon::now(new \DateTimeZone('America/Managua'));asi va en el model
            
            foreach ($alertas as $key => $alerta) {
                $reserva = $alerta->reservaSala; //reserva null
                $SalaNoDevuelta = null; 
                $enviar_alerta = false;
                $eliminar = false;
                
                $fecha_alerta = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$alerta->sipa_alertas_salas_fechaHoraEnvio,'America/Managua');
         
                if($hoy->isAfter($fecha_alerta)){
                    $eliminar = true;
                    
                    $salas =  $reserva->salas;
                    foreach ($salas as $key2 => $sala) {
                        $estado = $sala->estadoReserva;
                        
                        if($this->revisarSala($reserva,$sala)){
                            // dd('No devueltoooo');
                            $enviar_alerta = true;
                            $eliminar = false;
                            $SalaNoDevuelta = $sala;  
                        }
                    }
                }
                if($enviar_alerta===true){
                    $mailIt = new CorreoPHPMailer();
                    $correo = CuerpoCorreo::find(6);
                    $user=$reserva->user;
                    $correo->prepare_for_alertaSala($SalaNoDevuelta,$reserva->sipa_reservas_salas_fecha_fin,$reserva->sipa_reservas_salas_hora_fin);
                    $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
                    // $mailIt->sendMailPHPMailer('atraso','devuelva la vara','bryangarroeduarte@gmail.com');
                    
                    $fecha_alerta->addHours(3);
                    $alerta->sipa_alertas_salas_fechaHoraEnvio= $fecha_alerta;
                    $alerta->save();
                    // dd('alerta enviada');
                }else{
                    if($eliminar){
                        $alerta->delete();
                        // dd('alerta borrada');
                    //borrar alerta de la base de datos
                    }
                    
                }
                
            }
                // dd('no action needed');
        }
        public function revisarSala($reserva,$sala){
        
            $activosOcupados = $sala->fechas_ocupado;
            foreach($activosOcupados as $key2 => $activoOcupado){
                if(
                    $reserva->sipa_reservas_activos_fecha_inicio === $activoOcupado->sipa_activosOcupados_fi &&
                    $reserva->sipa_reservas_activos_fecha_fin === $activoOcupado->sipa_activosOcupados_ff &&
                    $reserva->sipa_reservas_activos_hora_inicio === $activoOcupado->sipa_activosOcupados_hi &&
                    $reserva->sipa_reservas_activos_hora_fin === $activoOcupado->sipa_activosOcupados_hf
                ){
                    return true;
                }
            }
            
            return false;
        }
}
