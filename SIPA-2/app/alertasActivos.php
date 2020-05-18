<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CorreoPHPMailer;
use App\CuerpoCorreo;
use Carbon\Carbon;

class alertasActivos extends Model
{
      // Table Name
      protected $table = 'sipa_alertas_activos';
      // Primary Key
      public $primaryKey = 'sipa_alertas_activos_id';
      // Timestamps
      public $timestamps = false;
  
      public function __construct(){
          
      }
      protected $fillable = [
        'sipa_alertas_activos_id', 'sipa_alertas_activos_reserva', 'sipa_alertas_activos_fechaHoraEnvio'
    ];

    public function reserva()
    {
        return $this->hasone('App\Reserva', 'sipa_reservas_activos_id','sipa_alertas_activos_reserva');
    }
    static public function revisarAlertasReservas(){

        $alertas = alertasActivos::all();
        $hoy = Carbon::now(new \DateTimeZone('America/Managua'));
       
        foreach ($alertas as $key => $alerta) {
            $reserva = $alerta->reserva;
            $arrayActivosNoDevueltos = array(); 
            $enviar_alerta = false;
            $eliminar = false;
            $fecha_alerta = Carbon::createFromFormat('Y-m-d H:i:s',$alerta->sipa_alertas_activos_fechaHoraEnvio,'America/Managua');
    
            if($hoy->isAfter($fecha_alerta)){
                $eliminar = true;
                $activos =  $reserva->activos;
                foreach ($activos as $key2 => $activo) {
                    $estado = $activo->estadoReserva;
                   
                    if($activo->sipa_activos_estadoReserva === 2){
                        // dd('No devueltoooo');
                        $enviar_alerta = true;
                        $eliminar = false;
                        $arrayActivosNoDevueltos[] = $activo;  
                    }
                }
            }
            if($enviar_alerta===true){
                $mailIt = new CorreoPHPMailer();
                $correo = CuerpoCorreo::find(5);
                $user=$reserva->user;
                $correo->prepare_for_alertaActivo($arrayActivosNoDevueltos,$reserva->sipa_reservas_activos_fecha_fin,$reserva->sipa_reservas_activos_hora_fin);
                $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
                // $mailIt->sendMailPHPMailer('atraso','devuelva la vara','bryangarroeduarte@gmail.com');
                
                $fecha_alerta->addHours(3);
                $alerta->sipa_alertas_activos_fechaHoraEnvio= $fecha_alerta;
                $alerta->save();
                
            }else{
                if($eliminar){
                    $alerta->delete();
                   
                //borrar alerta de la base de datos
                }
                
            }
            
        }
        
    }
    
}
